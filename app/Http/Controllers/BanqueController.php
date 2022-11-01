<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banque;
use App\Models\Micro_finance;

class BanqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $micros = Micro_finance::all();

        $banques = Banque::all();

        $depots = Banque::where('type','Dépôt');
        $retraits = Banque::where('type','Rétrait');

        return view('banque.index',compact('micros','banques','depots','retraits'));
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
        $banque = new Banque;
          
        $banque->create([
            'micro_finance_id'=>$request->micro_finance_id,
            'user_id'=>auth()->user()->id,
            'date'=>$request->date,
            'nom_banque'=>$request->nom_banque,
            'montant'=>$request->montant,
            'type'=>$request->type,
        ]);

        return redirect()->route('banque.index');
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

        $banque = Banque::where('id', $id)->firstOrFail();

        return view('banque.edit', compact('banque', 'micros'));
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
        $banque = Banque::where('id', $id)->firstOrFail();

        $banque->update([
            'micro_finance_id'=>$request->micro_finance_id,
            'user_id'=>auth()->user()->id,
            'date'=>$request->date,
            'nom_banque'=>$request->nom_banque,
            'montant'=>$request->montant,
            'type'=>$request->type,
        ]);

        return redirect()->route('banque.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banque = Banque::findOrFail($id);
        $banque->delete();

        return redirect()->route('banque.index');
    }
}
