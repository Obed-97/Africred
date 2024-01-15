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



class FiltreController extends Controller
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
        $date1 = $request->fdate;
        $date2 = $request->sdate;

        $agents = Recouvrement::selectRaw(
            'user_id',)
         ->groupBy('user_id')->whereBetween('date', [$request->fdate, $request->sdate])
         ->get();

         if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $credits = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [$request->fdate, $request->sdate])->get();
          }else {
            $credits = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->whereBetween('date_deblocage', [$request->fdate, $request->sdate])->get();
          }

          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $recouvrements = Recouvrement::whereBetween('date', [$request->fdate, $request->sdate])->get();
          }else {
            $recouvrements = Recouvrement::where('user_id', auth()->user()->id)->whereBetween('date', [$request->fdate, $request->sdate])->get();
          }

       
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 ) {
        $clients = Client::get();
        }else {
        $clients = Client::where('user_id', auth()->user()->id)->whereBetween('created_at', [$request->fdate, $request->sdate])->get();
        }
        
        $agents = User::where('role_id', '2')->get();

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $epargne = Depot::where('type_depot_id', 2)->whereBetween('created_at', [$request->fdate, $request->sdate])->get();
        }else {
            $epargne = Depot::where('type_depot_id', 2)->whereBetween('created_at', [$request->fdate, $request->sdate])->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $tontine = Depot::where('type_depot_id', 1)->whereBetween('created_at', [$request->fdate, $request->sdate])->get();
        }else {
            $tontine = Depot::where('type_depot_id', 1)->whereBetween('created_at', [$request->fdate, $request->sdate])->where('user_id', auth()->user()->id)->get();
        }

        $encaissements = Encaissement::whereBetween('date', [$request->fdate, $request->sdate])->get();
        $decaissements = Decaissement::whereBetween('date', [$request->fdate, $request->sdate])->get();

        $depots = Banque::where('type','Dépôt')->whereBetween('date', [$request->fdate, $request->sdate])->get();
        $retraits = Banque::where('type','Rétrait')->whereBetween('date', [$request->fdate, $request->sdate])->get();
        
        $marches = Marche::all();
       

        return view('filtre.index', compact('marches','credits', 'recouvrements','agents','clients','agents', 'date1', 'date2', 'epargne','tontine','encaissements','decaissements','depots','retraits'));
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
