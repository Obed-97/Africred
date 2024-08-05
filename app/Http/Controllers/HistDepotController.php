<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depot;
use App\Models\Client;
use App\Models\Type_depot;
use Carbon\Carbon;

class HistDepotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 8) {
            $depots = Depot::get();
        }else {
            $depots = Depot::where('user_id', auth()->user()->id)->get();
        }

        return view('depot.historique', compact('depots'));
    }

    public function filtre(Request $request)
    {

        $date1 = $request->fdate;
        $date2 = $request->sdate;

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 8) {
            $depots = Depot::whereBetween('created_at', [$request->fdate, $request->sdate])->get();
        }else {
            $depots = Depot::whereBetween('created_at', [$request->fdate, $request->sdate])->where('user_id', auth()->user()->id)->get();
        }


        return view('depot.historique', compact('depots', 'date1', 'date2'));
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

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 8) {
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

        $results = $request['client_id'];

        $data_client = explode('|', $results);

        $depots = Depot::where('client_id', $request->client_id)->sum('depot');
        $retraits = Depot::where('client_id', $request->client_id)->sum('retrait');

        $solde = abs(intval($request->depot) - intval($request->retrait));

        $depot->update([
            'user_id'=>auth()->user()->id,
            'client_id'=>$data_client[0],
            'nature'=>$data_client[1],
            'sexe'=>$data_client[2],
            'type_depot_id'=>$request->type_depot_id,
            'date'=>$request->date,

        ]);

        return redirect()->route('historique_depot.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $depot = Depot::findOrFail($request->depot);
        $depot->delete();

        alert()->image('Supprimé!!!','','assets/images/recycle.png','150','150');
        return redirect()->route('historique_depot.index');
    }
}
