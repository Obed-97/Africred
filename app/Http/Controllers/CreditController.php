<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Credit;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credits = Credit::where('user_id', auth()->user()->id)->get();
        $clients = Client::where('user_id', auth()->user()->id)->get();
        return view('credit.index', compact('clients', 'credits'));
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
        $credit = new Credit;
          
        $credit->create([
            'client_id'=>$request->client_id,
            'user_id'=> auth()->user()->id,
            'montant'=>$request->montant,
            'date_deblocage'=>$request->date_deblocage,
            'date_fin'=>$request->date_fin,
            'interet'=>$request->interet,
            'frais_deblocage'=>$request->frais_deblocage,
            'frais_carte'=>$request->frais_carte,
            'montant_interet'=>$request->montant_interet,
        ]);

        return redirect()->route('credit.index');
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
