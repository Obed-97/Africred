<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Marche;
use App\Models\User;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marches = Marche::all();
        $clients = null;

        if (auth()->user()->role_id == 1) {
          $clients = Client::get();
        }else {
          $clients = Client::where('user_id', auth()->user()->id)->get();
        }
      

        return view('client.index', compact('clients', 'marches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marches = Marche::all();

        if (auth()->user()->role_id == 1) {
            $clients = Client::selectRaw(
                'user_id,
                 COUNT(id) as id')
             ->groupBy('user_id')
             ->get();
        }else {
          $clients = Client::where('user_id', auth()->user()->id)->get();
        }
      

        return view('client.agent', compact('clients', 'marches'));
    }

    public function marche()
    {
        $marches = Marche::all();

        if (auth()->user()->role_id == 1) {
            $clients = Client::selectRaw(
                'marche_id,
                 COUNT(id) as id')
             ->groupBy('marche_id')
             ->get();
        }else {
            $clients = Client::selectRaw(
                'marche_id,
                 COUNT(id) as id')
             ->groupBy('marche_id')->where('user_id', auth()->user()->id)
             ->get();
        }
      

        return view('client.marche', compact('clients', 'marches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client;

        $client->create([
            'nom_prenom'=>$request->nom_prenom,
            'activite'=>$request->activite,
            'telephone'=>$request->telephone,
            'marche_id'=>$request->marche_id,
            'user_id'=> auth()->user()->id,
        ]);
 
        return redirect()->route('etat_client.index');
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
        $marches = Marche::all();
        $users = User::where('role_id' , '2')->get();

        $client = Client::where('id', $id)->firstOrFail();

        return view('client.edit', compact('client','marches','users'));
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
        $client = Client::where('id', $id)->firstOrFail();

        $client->update([
            'nom_prenom'=>$request->nom_prenom,
            'activite'=>$request->activite,
            'telephone'=>$request->telephone,
            'marche_id'=>$request->marche_id,
            'user_id'=>$request->user_id,

        ]);

        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('client.index');
    }
}
