<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Credit;
use App\Models\Client;
use App\Models\Recouvrement;
use App\Models\Marche;
use App\Services\Tool;
use App\Models\User;
use Alert;
use App\Notifications\PushNotif;

class RecouvrementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recouvrements = null;


        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $recouvrements = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')
            ->get();

          }else {
            $recouvrements = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')
            ->where('user_id', auth()->user()->id)->get();
          }


        $tool = new Tool();
        $credits = [];

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $listes = Credit::where('statut', 'Accordé')->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        } else {
            $listes = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        }


        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $epargnes = Credit::where('statut', 'Accordé')->get();
        } else {
            $epargnes = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();

        }


        $marches = Marche::get();

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $total = Recouvrement::get();
        } else {
            $total = Recouvrement::where('user_id', auth()->user()->id)->get();

        }

       $agents = User::where('role_id', '2')->get();

       return view('recouvrement.index', compact('epargnes','credits','recouvrements','marches','total','agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recouvrements = null;

          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $par_marche = Recouvrement::selectRaw(
               'marche_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('marche_id')
            ->get();

          }else {
            $par_marche = Recouvrement::selectRaw(
            'marche_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('marche_id')
            ->where('user_id', auth()->user()->id)->get();
          }


        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $credits = Credit::where('statut', 'Accordé')->get();
        } else {
            $credits = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();
        }



        $marches = Marche::get();

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $total = Recouvrement::get();
        } else {
            $total = Recouvrement::where('user_id', auth()->user()->id)->get();
        }



        return view('recouvrement.marche', compact('credits','marches','total','par_marche'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tool = new Tool();
        $recouvrement = new Recouvrement;

        $results = $request['credit_id'];

        $data_credit = explode('|', $results);

        $recouInteret = Recouvrement::where('credit_id', $request->credit_id)->sum('interet_jrs');
        $recouCapital = Recouvrement::where('credit_id', $request->credit_id)->sum('recouvrement_jrs');


        $credit = Credit::where('id', $request->credit_id)->first();

        $encours_actualise = abs((intval($credit->montant_interet)) -

        (intval($recouInteret) +
        intval($recouCapital) +
        intval($request->interet_jrs) +
        intval($request->recouvrement_jrs)
        ));

        $recouvrement->create([
            'user_id'=> auth()->user()->id,
            'credit_id'=>$data_credit[0],
            'marche_id'=>$data_credit[1],
            'type_id'=>$data_credit[3],
            'date'=>$request->date,
            'encours_actualise'=>$encours_actualise,
            'interet_jrs'=>$request->interet_jrs,
            'recouvrement_jrs'=>$request->recouvrement_jrs,
            'epargne_jrs'=>$request->epargne_jrs,
            'assurance'=>$request->assurance,
        ]);

        alert()->image('Recouvrement réussi','Le recouvrement a été effectué!','assets/images/money.png','175','175');

        $pr = new PushNotif(
            'Recouvrement',
            auth()->user()->nom,
            $credit->Client['nom_prenom']
        );

        $tool->pushNotif($tool->managerUsers(), $pr);

        return redirect()->route('etat_recouvrement.index');
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

    public function retrait(Request $request)
    {
        $retrait = new Recouvrement;

        $results = $request['credit_id'];

        $data_credit = explode('|', $results);

        $retrait->create([
            'user_id'=>auth()->user()->id,
            'credit_id'=>$data_credit[0],
            'marche_id'=>$data_credit[1],
            'type_id'=>$data_credit[3],
            'date'=>$request->date,

            'retrait'=>$request->retrait,
        ]);
        alert()->image('Retrait effectué!','Le retrait a été effectué avec succès!','assets/images/salary.png','125','125');
        return redirect()->back();
    }
}
