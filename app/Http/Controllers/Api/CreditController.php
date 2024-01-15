<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Credit;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Credit::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Credit::create($request->all())){
            
            return response()->json([
                'success' => 'Credit créé avec succès!'
                ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function show(Credit $credit)
    {
        return $credit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Credit $credit)
    {
        if(Credit::update($request->all())){
            
            return response()->json([
                'success' => 'Credit modifié avec succès!'
                ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Credit $credit)
    {
        if($credit->delete()){
            
            return response()->json([
                'success' => 'Credit supprimé avec succès!'
                ], 200);
        }
    }
}
