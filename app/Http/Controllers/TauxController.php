<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taux;

class TauxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taux = Taux::all();
        return view('taux.index', compact('taux'));
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
        $taux = new Taux;
          
        $taux->create([
            'libelle'=>$request->libelle,
            'valeur'=>$request->valeur,
        ]);

        return redirect()->route('taux.index');
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
        $taux = Taux::where('id', $id)->firstOrFail();

        return view('taux.edit', compact('taux'));
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
        $taux = Taux::where('id', $id)->firstOrFail();
        
        $taux->update([
            'libelle'=>$request->libelle,
            'valeur'=>$request->valeur,
         
        ]);
        
        alert()->image('Mise à jour','Le taux a été mis à jour!','assets/images/approved.png','200','200');
        return redirect()->route('taux.index');
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
