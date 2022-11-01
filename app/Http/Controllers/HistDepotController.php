<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depot;
use App\Models\Client;
use App\Models\Type_depot;

class HistDepotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role_id == 1) {
            $depots = Depot::get();
        }else {
            $depots = Depot::where('user_id', auth()->user()->id)->get();
        }

        return view('depot.historique', compact('depots'));
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
        //
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
        $clients = null;

        if (auth()->user()->role_id == 1) {
          $clients = Client::get();
        }else {
          $clients = Client::where('user_id', auth()->user()->id)->get();
        }

        $types = Type_depot::all();
        
        $depot = Depot::where('id', $id)->firstOrFail();

        return view('depot.edit', compact('depot','clients','types'));
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
        $depot = Depot::where('id', $id)->firstOrFail();

        $depots = Depot::where('client_id', $request->client_id)->sum('depot');
        $retraits = Depot::where('client_id', $request->client_id)->sum('retrait');

        $solde = abs((intval($depots) + intval($request->depot)) - (intval($retraits) + intval($request->retrait)));

        $depot->update([
            'user_id'=>auth()->user()->id,
            'client_id'=>$request->client_id,
            'type_depot_id'=>$request->type_depot_id,
            'depot'=>$request->depot,
            'retrait'=>$request->retrait,
            'solde'=>$solde,
        ]);

        return redirect()->route('depot.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $depot = Depot::findOrFail($id);
        $depot->delete();
        
        return redirect()->route('historique_depot.index');
    }
}
