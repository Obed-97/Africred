<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Recouvrement;
use App\Models\Client;
use App\Models\User;
use App\Models\Depot;
use App\Models\Encaissement;
use App\Models\Decaissement;
use App\Models\Banque;
use App\Models\Marche;


use Carbon\Carbon;

class EtatGlobalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Recouvrement::selectRaw(
            'user_id',)
         ->groupBy('user_id')
         ->get();

         if (auth()->user()->role_id == 1) {
            $credits = Credit::where('statut', 'Accordé')->get();
          }else {
            $credits = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1) {
            $recouvrements = Recouvrement::get();
          }else {
            $recouvrements = Recouvrement::where('user_id', auth()->user()->id)->get();
          }

       
          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 4) {
            $clients = Client::get();
            }else {
            $clients = Client::where('user_id', auth()->user()->id)->get();
            }
        
        $agents = User::where('role_id', '2')->get();
      

        if (auth()->user()->role_id == 1) {
            $epargne = Depot::where('type_depot_id', 2)->get();
        }else {
            $epargne = Depot::where('type_depot_id', 2)->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1) {
            $tontine = Depot::where('type_depot_id', 1)->get();
        }else {
            $tontine = Depot::where('type_depot_id', 1)->where('user_id', auth()->user()->id)->get();
        }

        $encaissements = Encaissement::get();
        $decaissements = Decaissement::get();

        $depots = Banque::where('type','Dépôt')->get();
        $retraits = Banque::where('type','Rétrait')->get();
        
        $marches = Marche::all();


        
        return view('etat_global.index', compact('marches','credits', 'recouvrements','agents','clients','agents','epargne','tontine','encaissements','decaissements','depots','retraits'));
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

        $agents = Recouvrement::selectRaw(
            'user_id',)
         ->groupBy('user_id')->whereDate('date', $request->date)
         ->get();

         if (auth()->user()->role_id == 1) {
            $credits = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', $request->date)->get();
          }else {
            $credits = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', $request->date)->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1) {
            $recouvrements = Recouvrement::whereDate('date', $request->date)->get();
          }else {
            $recouvrements = Recouvrement::whereDate('date', $request->date)->where('user_id', auth()->user()->id)->get();
          }

       
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 4) {
        $clients = Client::whereDate('created_at', $request->date)->get();
        }else {
        $clients = Client::where('user_id', auth()->user()->id)->whereDate('created_at', $request->date)->get();
        }
        
        $agents = User::where('role_id', '2')->get();

        if (auth()->user()->role_id == 1) {
          $epargne = Depot::where('type_depot_id', 2)->whereDate('created_at', $request->date)->get();
          }else {
          $epargne = Depot::where('type_depot_id', 2)->whereDate('created_at', $request->date)->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1) {
              $tontine = Depot::where('type_depot_id', 1)->whereDate('created_at', $request->date)->get();
          }else {
              $tontine = Depot::where('type_depot_id', 1)->whereDate('created_at', $request->date)->where('user_id', auth()->user()->id)->get();
          }

          $encaissements = Encaissement::whereDate('date', $request->date)->get();
          $decaissements = Decaissement::whereDate('date', $request->date)->get();

          $depots = Banque::where('type','Dépôt')->whereDate('date', $request->date)->get();
          $retraits = Banque::where('type','Rétrait')->whereDate('date', $request->date)->get();
          
          $marches = Marche::all();

       
        
        return view('dashboard.date', compact('marches','credits', 'recouvrements','agents','clients','agents','date','epargne','tontine','encaissements','decaissements','depots','retraits'));
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
