<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Micro_finance;
use App\Models\Encaissement;

class EncaissementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $micros = Micro_finance::all();

        $encaissements = Encaissement::all();

        return view('encaissement.index', compact('micros','encaissements'));
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
        $encaissement = new Encaissement;
          
        $encaissement->create([
            'micro_finance_id'=>$request->micro_finance_id,
            'user_id'=>auth()->user()->id,
            'date'=>$request->date,
            'nature'=>$request->nature,
            'montant'=>$request->montant,
            'observation'=>$request->observation,
        ]);

        return redirect()->route('encaissement.index');
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

        $encaissement = Encaissement::where('id', $id)->firstOrFail();

        return view('encaissement.edit', compact('encaissement', 'micros'));
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
        $encaissement = Encaissement::where('id', $id)->firstOrFail();

        $encaissement->update([
            'micro_finance_id'=>$request->micro_finance_id,
            'user_id'=>auth()->user()->id,
            'date'=>$request->date,
            'nature'=>$request->nature,
            'montant'=>$request->montant,
            'observation'=>$request->observation,
        ]);

        return redirect()->route('encaissement.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $encaissement = Encaissement::findOrFail($id);
        $encaissement->delete();

        return redirect()->route('encaissement.index');
    }
}
