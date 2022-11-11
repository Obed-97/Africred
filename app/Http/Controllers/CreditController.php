<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Credit;
use App\Models\Marche;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role_id == 1) {
            $credits = Credit::get();

          }else {
            $credits = Credit::where('user_id', auth()->user()->id)->get();
          }

        

        $clients = Client::where('user_id', auth()->user()->id)->get();

        $marches = Marche::get();
        
        return view('credit.index', compact('clients', 'credits','marches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if (auth()->user()->role_id == 1) {
            $credits = Credit::selectRaw(
                'user_id,
                 SUM(montant) as montant,
                 SUM(interet) as interet,
                 SUM(frais_deblocage) as frais_deblocage,
                 SUM(frais_carte) as frais_carte,
                 SUM(montant_interet) as montant_interet,
                 COUNT(id) as id')
             ->groupBy('user_id')
             ->get();
 
          }else {
            $credits = Credit::where('user_id', auth()->user()->id)->get();
          }

        $clients = Client::where('user_id', auth()->user()->id)->get();
        
        $marches = Marche::get();
        
        return view('credit.agent', compact('clients', 'credits','marches'));
    }

    public function marche()
    {
         if (auth()->user()->role_id == 1) {
            $credits = Credit::selectRaw(
                'marche_id,
                 SUM(montant) as montant,
                 SUM(interet) as interet,
                 SUM(frais_deblocage) as frais_deblocage,
                 SUM(frais_carte) as frais_carte,
                 SUM(montant_interet) as montant_interet,
                 COUNT(id) as id')
             ->groupBy('marche_id')
             ->get();
 
          }else {
            $credits = Credit::selectRaw(
                'marche_id,
                 SUM(montant) as montant,
                 SUM(interet) as interet,
                 SUM(frais_deblocage) as frais_deblocage,
                 SUM(frais_carte) as frais_carte,
                 SUM(montant_interet) as montant_interet,
                 COUNT(id) as id')->where('user_id', auth()->user()->id)
             ->groupBy('marche_id')
             ->get();
            
          }

        $clients = Client::where('user_id', auth()->user()->id)->get();
        
        $marches = Marche::get();
        
        return view('credit.marche', compact('clients', 'credits','marches'));
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

        $interet = ($request->montant + 0) * 0.2;

        $frais_deblocage = 0;

        if (($request->montant <= 100000)) {
            $frais_deblocage = ($request->montant + 0) * 0.05;
        }

        if ($request->montant > 100000){
            $frais_deblocage = ($request->montant + 0) * 0.1;
        }

        $montant_interet = ($request->montant + 0) + $interet;

        $credit->create([
            'client_id'=>$request->client_id,
            'marche_id'=>$request->marche_id,
            'user_id'=> auth()->user()->id,
            'montant'=>$request->montant,
            'date_deblocage'=>$request->date_deblocage,
            'date_fin'=>$request->date_fin,
            'interet'=>$interet,
            'frais_deblocage'=>$frais_deblocage,
            'frais_carte'=>$request->frais_carte,
            'montant_interet'=>$montant_interet,
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
        $credit = Credit::where('id', $id)->firstOrFail();

        if (auth()->user()->role_id == 1) {
            $clients = Client::get();
          }else {
            $clients = Client::where('user_id', auth()->user()->id)->get();
          }
        
          $marches = Marche::get();

        return view('credit.edit', compact('clients','credit','marches'));
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
        $credit = Credit::where('id', $id)->firstOrFail();

        $interet = ($request->montant + 0) * 0.2;

        $frais_deblocage = 0;

        if (($request->montant <= 100000)) {
            $frais_deblocage = ($request->montant + 0) * 0.05;
        }

        if ($request->montant > 100000){
            $frais_deblocage = ($request->montant + 0) * 0.1;
        }

        $montant_interet = ($request->montant + 0) + $interet;

        $credit->update([
            'client_id'=>$request->client_id,
            'marche_id'=>$request->marche_id,
            'user_id'=> auth()->user()->id,
            'montant'=>$request->montant,
            'date_deblocage'=>$request->date_deblocage,
            'date_fin'=>$request->date_fin,
            'interet'=>$interet,
            'frais_deblocage'=>$frais_deblocage,
            'frais_carte'=>$request->frais_carte,
            'montant_interet'=>$montant_interet,
        ]);

        return redirect()->route('credit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $credit = Credit::findOrFail($id);
        $credit->delete();

        return redirect()->route('credit.index');
    }
}
