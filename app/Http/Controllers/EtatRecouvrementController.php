<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recouvrement;
use App\Models\Credit;
use App\Models\Marche;
use Carbon\Carbon;

class EtatRecouvrementController extends Controller
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
            ->groupBy('user_id')->whereDate('date', Carbon::today())
            ->get();

          }else {
            $recouvrements = Recouvrement::selectRaw(
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
            ->groupBy('marche_id')->whereDate('date', Carbon::today())
            ->get();

          }else {
            $par_marche = Recouvrement::selectRaw(
            'marche_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('marche_id')->whereDate('date', Carbon::today())
            ->where('user_id', auth()->user()->id)->get();
          }

        $credits = Credit::where('user_id', auth()->user()->id)->get();
        $marches = Marche::get();

        if (auth()->user()->role_id == 1) {
            $total = Recouvrement::whereDate('date', Carbon::today())->get();
        } else {
            $total = Recouvrement::whereDate('date', Carbon::today())->where('user_id', auth()->user()->id)->get();
        }

        return view('recouvrement.jour', compact('credits','recouvrements','total','marches','par_marche'));
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
            ->groupBy('marche_id')->whereDate('date', Carbon::today())
            ->get();

          }else {
            $par_marche = Recouvrement::selectRaw(
            'marche_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('marche_id')->whereDate('date', Carbon::today())
            ->where('user_id', auth()->user()->id)->get();
          }

        $credits = Credit::where('user_id', auth()->user()->id)->get();
        $marches = Marche::get();

        if (auth()->user()->role_id == 1) {
            $total = Recouvrement::whereDate('date', Carbon::today())->get();
        } else {
            $total = Recouvrement::whereDate('date', Carbon::today())->where('user_id', auth()->user()->id)->get();
        }

        return view('recouvrement.marche_jr', compact('credits','total','marches','par_marche'));
    }

    public function affiche(Request $request)
    {
        $date1 = $request->fdate;
        $date2 = $request->sdate;

        $recouvrements = null;




          if (auth()->user()->role_id == 1) {
            $par_marche = Recouvrement::selectRaw(
               'marche_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('marche_id')->whereBetween('date', [$request->fdate, $request->sdate])
            ->get();

          }else {
            $par_marche = Recouvrement::selectRaw(
            'marche_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('marche_id')->whereBetween('date', [$request->fdate, $request->sdate])
            ->where('user_id', auth()->user()->id)->get();
          }

        $credits = Credit::where('user_id', auth()->user()->id)->get();
        $marches = Marche::get();

        if (auth()->user()->role_id == 1) {
            $total = Recouvrement::whereBetween('date', [$request->fdate, $request->sdate])->get();
        } else {
            $total = Recouvrement::whereBetween('date', [$request->fdate, $request->sdate])->where('user_id', auth()->user()->id)->get();
        }

        return view('recouvrement.filtre_marche', compact('credits', 'date1', 'date2', 'total','marches','par_marche'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $date1 = $request->fdate;
        $date2 = $request->sdate;

        $recouvrements = null;


        if (auth()->user()->role_id == 1) {
            $recouvrements = Recouvrement::selectRaw(
               'user_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('user_id')->whereBetween('date', [$request->fdate, $request->sdate])
            ->get();

          }else {
            $recouvrements = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('credit_id')->whereBetween('date', [$request->fdate, $request->sdate])
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
            ->groupBy('marche_id')->whereBetween('date', [$request->fdate, $request->sdate])
            ->get();

          }else {
            $par_marche = Recouvrement::selectRaw(
            'marche_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('marche_id')->whereBetween('date', [$request->fdate, $request->sdate])
            ->where('user_id', auth()->user()->id)->get();
          }

        $credits = Credit::where('user_id', auth()->user()->id)->get();
        $marches = Marche::get();

        if (auth()->user()->role_id == 1) {
            $total = Recouvrement::whereBetween('date', [$request->fdate, $request->sdate])->get();
        } else {
            $total = Recouvrement::whereBetween('date', [$request->fdate, $request->sdate])->where('user_id', auth()->user()->id)->get();
        }

        return view('recouvrement.filtre', compact('credits','recouvrements', 'date1', 'date2', 'total','marches','par_marche'));
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
