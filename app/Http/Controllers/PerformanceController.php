<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recouvrement;
use App\Models\Credit;

class PerformanceController extends Controller
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
        $date_d = $request->date_d;
        $date_f = $request->date_f;
        
        $id = $request->id;
        
        if($id == 'agent'){
            $recouvrements = Recouvrement::selectRaw(
               'user_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('user_id')->where('type_id','1')->whereBetween('date', [$date_d, $date_f])
            ->get();
            
            $credits = Credit::selectRaw(
               'user_id,
                SUM(frais_deblocage) as frais_deblocage,
                SUM(frais_carte) as frais_carte
                ')
            ->groupBy('user_id')->where('type_id','1')->whereBetween('date_deblocage', [$date_d, $date_f])
            ->get();
            
        }elseif($id == 'marche'){
            $recouvrements = Recouvrement::selectRaw(
               'marche_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('marche_id')->where('type_id','1')->whereBetween('date', [$date_d, $date_f])
            ->get();
            
            $credits = Credit::selectRaw(
               'marche_id,
                SUM(frais_deblocage) as frais_deblocage,
                SUM(frais_carte) as frais_carte
                ')
            ->groupBy('marche_id')->where('type_id','1')->whereBetween('date_deblocage', [$date_d, $date_f])
            ->get();
            
        }elseif($id == 'credit'){
            $recouvrements = Recouvrement::selectRaw(
               'credit_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')->where('type_id','1')->whereBetween('date', [$date_d, $date_f])
            ->get();
            
            $credits = Credit::selectRaw(
               'id,
                SUM(frais_deblocage) as frais_deblocage,
                SUM(frais_carte) as frais_carte
                ')
            ->groupBy('id')->where('type_id','1')->whereBetween('date_deblocage', [$date_d, $date_f])
            ->get();
        }elseif($id == 'ab_sugu'){
            $recouvrements = Recouvrement::selectRaw(
               'credit_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')->where('type_id','2')->whereBetween('date', [$date_d, $date_f])
            ->get();
            
            $credits = Credit::selectRaw(
               'id,
                SUM(frais_deblocage) as frais_deblocage,
                SUM(frais_carte) as frais_carte
                ')
            ->groupBy('id')->where('type_id','2')->whereBetween('date_deblocage', [$date_d, $date_f])
            ->get();
        }
        
        return view('performance.index', compact('recouvrements','credits', 'date_d', 'date_f','id'));
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
