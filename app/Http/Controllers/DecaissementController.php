<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Micro_finance;
use App\Models\Decaissement;

class DecaissementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $micros = Micro_finance::all();
        $decaissements = Decaissement::all();
        
        return view('decaissement.index', compact('micros','decaissements'));
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
        $decaissements = new Decaissement;
          
        $decaissements->create([
            'micro_finance_id'=>$request->micro_finance_id,
            'user_id'=>auth()->user()->id,
            'date'=>$request->date,
            'motif'=>$request->motif,
            'montant'=>$request->montant,
            'observation'=>$request->observation,
        ]);

        return redirect()->route('decaissement.index');
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
        $micros = Micro_finance::all();

        $decaissement = Decaissement::where('id', $id)->firstOrFail();

        return view('decaissement.edit', compact('decaissement', 'micros'));
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
        $decaissement = Decaissement::where('id', $id)->firstOrFail();

        $decaissement->update([
            'micro_finance_id'=>$request->micro_finance_id,
            'user_id'=>auth()->user()->id,
            'date'=>$request->date,
            'motif'=>$request->motif,
            'montant'=>$request->montant,
            'observation'=>$request->observation,
        ]);

        return redirect()->route('decaissement.index');
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
