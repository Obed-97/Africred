<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Caisse;
use App\Models\User_caisse;

class DepotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role_id' , '2')->get();
        $caisses = Caisse::all();

        $depots = User_caisse::selectRaw(
               'caisse_id,
                SUM(montant) as montant',)
            ->groupBy('caisse_id')
            ->get();

        
        $depots_agents = User_caisse::selectRaw(
            'user_id,
            SUM(montant) as montant',)
        ->groupBy('user_id')
        ->get();

        $total = User_caisse::get();

        return view('encaissement.index', compact('users','caisses','depots','depots_agents','total'));
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
        $depot = new User_caisse;

        $depot->create([
            'user_id'=>$request->user_id,
            'caisse_id'=>$request->caisse_id,
            'montant'=>$request->montant,
        ]);

        return redirect()->route('depot_caisse.index');
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
