<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recouvrement;
use App\Models\Credit;
use App\Models\Marche;
use Carbon\Carbon;

class DateRecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = $request->date;
      

      $recouvrements = null;


      if (auth()->user()->role_id == 1) {
          $recouvrements = Recouvrement::selectRaw(
             'user_id,
              SUM(encours_actualise) as encours_actualise,
              SUM(recouvrement_jrs) as recouvrement_jrs,
              SUM(epargne_jrs) as epargne_jrs,
              SUM(assurance) as assurance,
              SUM(interet_jrs) as interet_jrs')
          ->groupBy('user_id')->whereDate('date', $request->date)
          ->get();

        }else {
          $recouvrements = Recouvrement::selectRaw(
          'credit_id,
              SUM(recouvrement_jrs) as recouvrement_jrs,
              SUM(epargne_jrs) as epargne_jrs,
              SUM(assurance) as assurance,
              SUM(interet_jrs) as interet_jrs')
          ->groupBy('credit_id')->whereDate('date', $request->date)
          ->where('user_id', auth()->user()->id)->get();
        }
        
        if (auth()->user()->role_id == 1) {
          $hier = Recouvrement::selectRaw(
             'user_id,
              SUM(encours_actualise) as encours_actualise,
              SUM(recouvrement_jrs) as recouvrement_jrs,
              SUM(epargne_jrs) as epargne_jrs,
              SUM(assurance) as assurance,
              SUM(interet_jrs) as interet_jrs')
          ->groupBy('user_id')->whereDate('date', Carbon::createMidnightDate($request->date)->subDays(1))
          ->get();

        }else {
          $hier = Recouvrement::selectRaw(
          'credit_id,
              SUM(recouvrement_jrs) as recouvrement_jrs,
              SUM(epargne_jrs) as epargne_jrs,
              SUM(assurance) as assurance,
              SUM(interet_jrs) as interet_jrs')
          ->groupBy('credit_id')->whereDate('date', Carbon::createMidnightDate($request->date)->subDays(1))
          ->where('user_id', auth()->user()->id)->get();
        }
        
         if (auth()->user()->role_id == 1) {
          $avant_hier = Recouvrement::selectRaw(
             'user_id,
              SUM(encours_actualise) as encours_actualise,
              SUM(recouvrement_jrs) as recouvrement_jrs,
              SUM(epargne_jrs) as epargne_jrs,
              SUM(assurance) as assurance,
              SUM(interet_jrs) as interet_jrs')
          ->groupBy('user_id')->whereDate('date', Carbon::createMidnightDate($request->date)->subDays(2))
          ->get();

        }else {
          $avant_hier = Recouvrement::selectRaw(
          'credit_id,
              SUM(recouvrement_jrs) as recouvrement_jrs,
              SUM(epargne_jrs) as epargne_jrs,
              SUM(assurance) as assurance,
              SUM(interet_jrs) as interet_jrs')
          ->groupBy('credit_id')->whereDate('date', Carbon::createMidnightDate($request->date)->subDays(2))
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
          ->groupBy('marche_id')->whereDate('date', $request->date)
          ->get();

        }else {
          $par_marche = Recouvrement::selectRaw(
          'marche_id,
              SUM(recouvrement_jrs) as recouvrement_jrs,
              SUM(epargne_jrs) as epargne_jrs,
              SUM(assurance) as assurance,
              SUM(interet_jrs) as interet_jrs')
          ->groupBy('marche_id')->whereDate('date', $request->date)
          ->where('user_id', auth()->user()->id)->get();
        }

      $credits = Credit::where('user_id', auth()->user()->id)->get();
      $marches = Marche::get();

      if (auth()->user()->role_id == 1) {
          $total = Recouvrement::whereDate('date', $request->date)->get();
      } else {
          $total = Recouvrement::whereDate('date', $request->date)->where('user_id', auth()->user()->id)->get();
      }
      
      if (auth()->user()->role_id == 1) {
          $total_hier = Recouvrement::whereDate('date', Carbon::createMidnightDate($request->date)->subDays(1))->get();
      } else {
          $total_hier = Recouvrement::whereDate('date', Carbon::createMidnightDate($request->date)->subDays(1))->where('user_id', auth()->user()->id)->get();
      }
      
      if (auth()->user()->role_id == 1) {
          $total_j_2 = Recouvrement::whereDate('date', Carbon::createMidnightDate($request->date)->subDays(2))->get();
      } else {
          $total_j_2 = Recouvrement::whereDate('date', Carbon::createMidnightDate($request->date)->subDays(2))->where('user_id', auth()->user()->id)->get();
      }

      return view('recouvrement.date', compact('credits','recouvrements','hier','avant_hier', 'total_hier','total_j_2', 'date', 'total','marches','par_marche'));
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
