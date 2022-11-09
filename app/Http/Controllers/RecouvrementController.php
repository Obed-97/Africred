<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Credit;
use App\Models\Client;
use App\Models\Recouvrement;
use App\Models\Marche;

use Carbon\Carbon;


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


        if (auth()->user()->role_id == 1) {
            $recouvrements = Recouvrement::selectRaw(
               'user_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('user_id')
            ->get();

          }else {
            $recouvrements = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('credit_id')
            ->where('user_id', auth()->user()->id)->get();
          }

          $jour = null;

          if (auth()->user()->role_id == 1) {
            $jour = Recouvrement::selectRaw(
               'user_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('user_id')->whereDate('date', Carbon::today())
            ->get();

          }else {
            $jour = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('credit_id')->whereDate('date', Carbon::today())
            ->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1) {
            $par_marche = Recouvrement::selectRaw(
               'marche_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('marche_id')
            ->get();

          }else {
            $par_marche = Recouvrement::selectRaw(
            'marche_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('marche_id')
            ->where('user_id', auth()->user()->id)->get();
          }


        $credits = Credit::where('user_id', auth()->user()->id)->get();
        $marches = Marche::get();

        if (auth()->user()->role_id == 1) {
            $total = Recouvrement::get();
        } else {
            $total = Recouvrement::where('user_id', auth()->user()->id)->get();
        }
        
       

        return view('recouvrement.index', compact('credits','jour','recouvrements','marches','total','par_marche'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recouvrements = null;

          if (auth()->user()->role_id == 1) {
            $par_marche = Recouvrement::selectRaw(
               'marche_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('marche_id')
            ->get();

          }else {
            $par_marche = Recouvrement::selectRaw(
            'marche_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('marche_id')
            ->where('user_id', auth()->user()->id)->get();
          }


        $credits = Credit::where('user_id', auth()->user()->id)->get();
        $marches = Marche::get();

        if (auth()->user()->role_id == 1) {
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

        $recouvrement = new Recouvrement;

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
            'credit_id'=>$request->credit_id,
            'marche_id'=>$request->marche_id,
            'date'=>$request->date,
            'encours_actualise'=>$encours_actualise,
            'interet_jrs'=>$request->interet_jrs,
            'recouvrement_jrs'=>$request->recouvrement_jrs,
            'epargne_jrs'=>$request->epargne_jrs,
            'assurance'=>$request->assurance,
        ]);

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
}
