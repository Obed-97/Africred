<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Tool;
use App\Models\Credit;
use App\Models\Recouvrement;
use Carbon\Carbon;


class IndicateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tool = new Tool();
       
        $clients = [];
        $totalMontantParJour = 0;
       
       
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $listes = Credit::where('statut', 'Accordé')->get();
              
            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($clients, $liste);
                   
                }

            }
        } else {
            $listes = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($clients, $liste);
                   
                }

            }
        }

        $recouvrements = null;

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $recouvrements = Recouvrement::selectRaw(
               'credit_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')->whereDate('date', Carbon::today())
            ->get();

        }else {
            $recouvrements = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')->whereDate('date', Carbon::today())
            ->where('user_id', auth()->user()->id)->get();


        }
        
         if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $recouvrement = Recouvrement::whereDate('date', Carbon::today())->get();
          }else {
            $recouvrement = Recouvrement::whereDate('date', Carbon::today())->where('user_id', auth()->user()->id)->get();
          }
            
          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $credit = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::today())->get();
          }else {
            $credit = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::today())->where('user_id', auth()->user()->id)->get();
          }


        return view("indicateur.index", compact('clients','totalMontantParJour','recouvrements', 'recouvrement','credit'));
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
    
    public function dates(Request $request)
    {
        $date1 = $request->date1;
        $date2 = $request->date2;
        
        $tool = new Tool();
       
        $clients = [];
        $totalMontantParJour = 0;
       
       
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $listes = Credit::where('statut', 'Accordé')->get();
              
            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($clients, $liste);
                   
                }

            }
        } else {
            $listes = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($clients, $liste);
                   
                }

            }
        }

        $recouvrements = null;

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $recouvrements = Recouvrement::selectRaw(
               'credit_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')->whereBetween('date', [$request->date1, $request->date2])
            ->get();

        }else {
            $recouvrements = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')->whereBetween('date', [$request->date1, $request->date2])
            ->where('user_id', auth()->user()->id)->get();


        }
        
         if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $recouvrement = Recouvrement::whereBetween('date', [$request->date1, $request->date2])->get();
          }else {
            $recouvrement = Recouvrement::whereBetween('date', [$request->date1, $request->date2])->where('user_id', auth()->user()->id)->get();
          }
            
          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $credit = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [$request->date1, $request->date2])->get();
          }else {
            $credit = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [$request->date1, $request->date2])->where('user_id', auth()->user()->id)->get();
          }


        return view("indicateur.deux_date", compact('date1','date2','clients','totalMontantParJour','recouvrements', 'recouvrement','credit'));
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
        
        $tool = new Tool();
       
        $clients = [];
        $totalMontantParJour = 0;
       
       
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $listes = Credit::where('statut', 'Accordé')->get();
              
            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($clients, $liste);
                   
                }

            }
        } else {
            $listes = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($clients, $liste);
                   
                }

            }
        }

        $recouvrements = null;

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $recouvrements = Recouvrement::selectRaw(
               'credit_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')->whereDate('date', $date)
            ->get();

        }else {
            $recouvrements = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')->whereDate('date', $date)
            ->where('user_id', auth()->user()->id)->get();


        }
        
         if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $recouvrement = Recouvrement::whereDate('date', $date)->get();
          }else {
            $recouvrement = Recouvrement::whereDate('date', $date)->where('user_id', auth()->user()->id)->get();
          }
            
          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $credit = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', $date)->get();
          }else {
            $credit = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', $date)->where('user_id', auth()->user()->id)->get();
          }


        return view("indicateur.date", compact('date','clients','totalMontantParJour','recouvrements', 'recouvrement','credit'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $credit = Credit::where('id', $id)->firstOrFail();
        
        $credits = Credit::where('client_id', $credit->client_id)->where('type_id', 1)->count();

        $recouvrements = Recouvrement::where('credit_id', $credit->id)->get();

        return view('indicateur.show', compact('credit','credits', 'recouvrements'));
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
