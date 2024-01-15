<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Recouvrement;
use Illuminate\Http\Request;

class RecouvrementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Recouvrement::selectRaw(
               'credit_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')
            ->get();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Recouvrement::create($request->all())){
            
            return response()->json([
                'success' => 'Recouvrement créé avec succès!'
                ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recouvrement  $recouvrement
     * @return \Illuminate\Http\Response
     */
    public function show(Recouvrement $recouvrement)
    {
        return $recouvrement;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recouvrement  $recouvrement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recouvrement $recouvrement)
    {
        if(Recouvrement::update($request->all())){
            
            return response()->json([
                'success' => 'Recouvrement modifié avec succès!'
                ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recouvrement  $recouvrement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recouvrement $recouvrement)
    {
        if($recouvrement->delete()){
            
            return response()->json([
                'success' => 'Recouvrement supprimé avec succès!'
                ], 200);
        }
    }
}
