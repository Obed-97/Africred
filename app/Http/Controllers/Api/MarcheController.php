<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Marche;
use Illuminate\Http\Request;

class MarcheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Marche::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Marche::create($request->all())){
            
            return response()->json([
                'success' => 'Marché créé avec succès!'
                ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marche  $marche
     * @return \Illuminate\Http\Response
     */
    public function show(Marche $marche)
    {
        return $marche;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marche  $marche
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marche $marche)
    {
        if(Marche::update($request->all())){
            
            return response()->json([
                'success' => 'Marché modifié avec succès!'
                ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marche  $marche
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marche $marche)
    {
        if($marche->delete()){
            
            return response()->json([
                'success' => 'Marché supprimé avec succès!'
                ], 200);
        }
    }
}
