<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Credit;
use App\Models\Marche;
use App\Models\Type;
use App\Models\Recouvrement;
use Carbon\Carbon;
use Alert;
use App\Notifications\PushNotif;
use App\Services\Tool;

class AttenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $credits = Credit::where('statut', 'En attente')->orWhereDate('date_deblocage', Carbon::now())->orWhereDate('date_deblocage', Carbon::now()->subDays(3))->get();
        }else {
            $credits = Credit::where('statut', 'En attente')->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $clients = Client::get();
        }else {
            $clients = Client::where('user_id', auth()->user()->id)->get();
        }


        $marches = Marche::get();
        $types = Type::get();

        return view('credit.attente', compact('clients', 'credits','marches','types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $credits = Credit::selectRaw(
               'client_id,
                SUM(montant) as montant,
                SUM(interet) as interet,
                SUM(frais_deblocage) as frais_deblocage,
                SUM(frais_carte) as frais_carte')
            ->groupBy('client_id')->where('statut', 'Accordé')->whereYear('date_deblocage', date('Y'))
            ->get();

        }else {
            $credits = Credit::selectRaw(
               'client_id,
                SUM(montant) as montant,
                SUM(interet) as interet,
                SUM(frais_deblocage) as frais_deblocage,
                SUM(frais_carte) as frais_carte')
            ->groupBy('client_id')->where('statut', 'Accordé')->whereYear('date_deblocage', date('Y'))->where('user_id', auth()->user()->id)
            ->get();

        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $clients = Client::get();
        }else {
            $clients = Client::where('user_id', auth()->user()->id)->get();
        }


        $marches = Marche::get();
        $types = Type::get();

        return view('credit.rotation', compact('clients', 'credits','marches','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client_id = $request->client_id;

        $client = Client::where('id', $client_id)->first();

        $credits = Credit::where('client_id', $client_id)->where('statut', 'Accordé')->get();

        $credits_attente = Credit::where('client_id', $client_id)->where('statut', 'En attente')->get();

        $renouvellement = Credit::where('client_id', $client_id)->get();


        return view('credit.dossier_credit', compact('client','credits','credits_attente','renouvellement'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $tool = new Tool();
        $credit = Credit::where('id', $request->deblocage)->firstOrFail();

        $date_deblocage = $request->date_deblocage;
        $date_fin = Carbon::create($date_deblocage)->addDays($credit->nbre_jrs);

        $statut = "Accordé";

        $credit->update([
            'date_deblocage'=>$date_deblocage,
            'date_fin'=>$date_fin,
            'note'=>$request->note,
            'statut'=>$statut,
        ]);

        alert()->image('Crédit accordé!','La demande de crédit a été accordée!','assets/images/accept.png','100','100');

        $pr = new PushNotif(
            'Validation de prêt',
            auth()->user()->nom.' a confirmé le prêt du client '.$credit->Client['nom_prenom']. ', pour le '.$credit->date_deblocage. ' !',
        );

        $tool->pushNotif($tool->agentUsers(), $pr);

        return redirect()->route('attente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $credit = Credit::findOrFail($request->credit);
        $credit->delete();
        alert()->image('Supprimée!!!','','assets/images/recycle.png','150','150');
        return redirect()->route('attente.index');
    }
}
