<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marche;
use App\Models\Recouvrement;

class MarcheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marches = Marche::all();

        return view('marche.index', compact('marches'));
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
        $marche = new Marche;

        $marche->create([
            'libelle'=>$request->libelle,
        ]);

        return redirect()->route('les_marches.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marche  = Marche::findOrFail($id);

        $historiques = Recouvrement::where('marche_id', $marche->id)->latest()->paginate(100);

        return view('marche.show', compact('historiques', 'marche'));
    }

    public function filtershow(Request $request)
    {
        $marche  = Marche::findOrFail($request->id);

        $historiques = Recouvrement::where('marche_id', $request->marche_id)->whereDate('date', $request->date)->latest()->paginate(100);

        return view('marche.show', compact('historiques', 'marche'));
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
