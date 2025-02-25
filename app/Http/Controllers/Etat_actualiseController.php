<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Client;
use App\Models\Recouvrement;
use App\Models\Marche;
use App\Services\Tool;
use Carbon\Carbon;



class Etat_actualiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $tool = new Tool();
        $credits = [];

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $listes = Credit::where('statut', 'Accordé')->orWhere('type_id', '2')->get();
              
            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        } else {
            $listes = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->whereDate('date_fin','>', Carbon::today()->subDays(70))->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $encours = Credit::where('statut', 'Accordé')->get();
        } else {
            $encours = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();
        }

        $marches = Marche::get();

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $total = Recouvrement::get();
        } else {
            $total = Recouvrement::where('user_id', auth()->user()->id)->get();
        }

        return view('recouvrement.actualise', compact('credits','encours','marches','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tool = new Tool();
        $credits = [];

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $listes = Credit::where('statut', 'Accordé')->where('marche_id', '!=' , 14)->whereDate('date_fin','<', Carbon::today()->subDays(30))->where('type_id', '1')->get();
              
            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        } else {
            $listes = Credit::where('statut', 'Accordé')->where('marche_id', '!=' , 14)->where('user_id', auth()->user()->id)->whereDate('date_fin','<', Carbon::today()->subDays(30))->where('type_id', '1')->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $encours = Credit::where('statut', 'Accordé')->get();
        } else {
            $encours = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();
        }

        $marches = Marche::get();

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $total = Recouvrement::get();
        } else {
            $total = Recouvrement::where('user_id', auth()->user()->id)->get();
        }

        return view('recouvrement.impayer', compact('credits','encours','marches','total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $results = $request['credit_id'];

        $data_credit = explode('|', $results);
        
        $date_r = $request->date_r;
        $date_fin_r = Carbon::create($date_r)->addDays($request->n_delai);
        
        $n_montant = $data_credit[3];
        
        $montant_par_jour = $n_montant / $request->n_delai;
        
        $credit = Credit::where('id', $data_credit[0])->firstOrFail();
        
        $reecheloner ='oui';
        
        $credit->update([
            'date_r'=>$date_r, 
            'n_montant'=>$n_montant,
            'n_delai'=>$request->n_delai,
            'date_fin_r'=>$date_fin_r,
            'montant_par_jour'=>$montant_par_jour,
            'motif_r'=>$request->motif_r,
            'reecheloner'=>$reecheloner,
        ]);
        
        alert()->image('Crédit réécheloné!','Le crédit a été réécheloner!','assets/images/accept.png','100','100');

        return redirect()->route('etat_actualise.index');

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

