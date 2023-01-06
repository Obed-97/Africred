<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depot;
use App\Models\Type_depot;
use App\Models\Client;

class DepotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role_id == 1) {
            $tout_depot = Depot::get();
        }else {
            $tout_depot = Depot::where('user_id', auth()->user()->id)->get();
        }
        
        $depots = null;

        if (auth()->user()->role_id == 1) {
            $depots = Depot::selectRaw(
                'client_id,
                 SUM(depot) as depot,
                 SUM(retrait) as retrait')
                ->groupBy('client_id')
                ->get();

        }else {
            $depots = Depot::selectRaw(
                'client_id,
                 SUM(depot) as depot,
                 SUM(retrait) as retrait')
                ->groupBy('client_id')->where('user_id', auth()->user()->id)
                ->get();
        }




        if (auth()->user()->role_id == 1) {
            $clients = Client::get();
        }else {
            $clients = Client::where('user_id', auth()->user()->id)->get();
        }


        if (auth()->user()->role_id == 1) {
            $tontine = Depot::where('type_depot_id', 1)->get();
        }else {
            $tontine = Depot::where('type_depot_id', 1)->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1) {
            $epargne = Depot::where('type_depot_id', 2)->get();
        }else {
            $epargne = Depot::where('type_depot_id', 2)->where('user_id', auth()->user()->id)->get();
        }

        $types =Type_depot::get();

        return view('depot.index', compact('depots','clients','types','tontine','epargne','tout_depot'));
    }
    
    public function livret(Request $request)
    {
        $client_id = $request->client_id;

        $info = Depot::where('client_id', $request->client_id)->first();
        
        if (auth()->user()->role_id == 1) {
            $client = Client::get();
        }else {
            $client = Client::where('user_id', auth()->user()->id)->get();
        }
   

        if (auth()->user()->role_id == 1) {
            $livret = Depot::where('client_id', $request->client_id)->get();
        }else {
            $livret = Depot::where('client_id', $request->client_id)->where('user_id', auth()->user()->id)->get();
        }

        return view('depot.show', compact('livret','client_id','info','client'));
    }


    public function tontine()
    {
        $depots = null;

        if (auth()->user()->role_id == 1) {
            $depots = Depot::selectRaw(
                'client_id,
                 SUM(depot) as depot,
                 SUM(retrait) as retrait')
                ->groupBy('client_id')->where('type_depot_id', 1)
                ->get();

        }else {
            $depots = Depot::selectRaw(
                'client_id,
                 SUM(depot) as depot,
                 SUM(retrait) as retrait')
                ->groupBy('client_id')->where('type_depot_id', 1)->where('user_id', auth()->user()->id)
                ->get();
        }

        if (auth()->user()->role_id == 1) {
            $clients = Client::get();
        }else {
            $clients = Client::where('user_id', auth()->user()->id)->get();
        }


        if (auth()->user()->role_id == 1) {
            $tontine = Depot::where('type_depot_id', 1)->get();
        }else {
            $tontine = Depot::where('type_depot_id', 1)->where('user_id', auth()->user()->id)->get();
        }

        

        $types =Type_depot::get();

        return view('depot.tontine', compact('depots','clients','types','tontine'));
    }

    public function epargne()
    {
        $depots = null;

        if (auth()->user()->role_id == 1) {
            $depots = Depot::selectRaw(
                'client_id,
                 SUM(depot) as depot,
                 SUM(retrait) as retrait')
                ->groupBy('client_id')->where('type_depot_id', 2)
                ->get();

        }else {
            $depots = Depot::selectRaw(
                'client_id,
                 SUM(depot) as depot,
                 SUM(retrait) as retrait')
                ->groupBy('client_id')->where('type_depot_id', 2)->where('user_id', auth()->user()->id)
                ->get();
        }

        if (auth()->user()->role_id == 1) {
            $clients = Client::get();
        }else {
            $clients = Client::where('user_id', auth()->user()->id)->get();
        }


       

        if (auth()->user()->role_id == 1) {
            $epargne = Depot::where('type_depot_id', 2)->get();
        }else {
            $epargne = Depot::where('type_depot_id', 2)->where('user_id', auth()->user()->id)->get();
        }

        $types =Type_depot::get();

        return view('depot.epargne', compact('depots','clients','types','epargne'));
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
        $depot = new Depot;

        $depots = Depot::where('client_id', $request->client_id)->sum('depot');
        $retraits = Depot::where('client_id', $request->client_id)->sum('retrait');

        $solde = abs((intval($depots) + intval($request->depot)) - intval($retraits));

        $depot->create([
            'user_id'=>auth()->user()->id,
            'client_id'=>$request->client_id,
            'type_depot_id'=>$request->type_depot_id,
            'date'=>$request->date,
            'depot'=>$request->depot,
            'solde'=>$solde,
        ]);
 
        return redirect()->route('depot.index');
    }

    public function retrait(Request $request)
    {
        $depot = new Depot;

        $depots = Depot::where('client_id', $request->client_id)->sum('depot');
        $retraits = Depot::where('client_id', $request->client_id)->sum('retrait');

        $solde = abs((intval($depots) - (intval($retraits) + intval($request->retrait))) );

        $depot->create([
            'user_id'=>auth()->user()->id,
            'client_id'=>$request->client_id,
            'type_depot_id'=>$request->type_depot_id,
            'date'=>$request->date,
            'retrait'=>$request->retrait,
            'solde'=>$solde,
        ]);
 
        return redirect()->route('depot.index');
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
