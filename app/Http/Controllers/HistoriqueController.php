<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recouvrement;
use App\Models\Credit;
use App\Models\Marche;

class HistoriqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role_id == 1) {
            $historiques = Recouvrement::get();
          }else {
            $historiques = Recouvrement::where('user_id', auth()->user()->id)->get();
          }

        return view('historique.index', compact('historiques'));
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
        //
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
        $marches = Marche::get();
        $credits = Credit::where('user_id', auth()->user()->id)->get();

        $historique = Recouvrement::where('id', $id)->firstOrFail();

        return view('historique.edit', compact('historique', 'credits','marches'));
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
        $historique = Recouvrement::where('id', $id)->firstOrFail();

        $recouInteret = Recouvrement::where('credit_id', $request->credit_id)->sum('interet_jrs');
        $recouCapital = Recouvrement::where('credit_id', $request->credit_id)->sum('recouvrement_jrs');


        $credit = Credit::where('id', $request->credit_id)->first();
        

        $encours_actualise = abs((intval($credit->montant_interet)) -

        (intval($recouInteret) +
        intval($recouCapital) +
        intval($request->interet_jrs) +
        intval($request->recouvrement_jrs)
        ));

        $historique->update([
            'user_id'=> auth()->user()->id,
            'credit_id'=>$request->credit_id,
            'marche_id'=>$request->marche_id,
            'encours_actualise'=>$encours_actualise,
            'interet_jrs'=>$request->interet_jrs,
            'recouvrement_jrs'=>$request->recouvrement_jrs,
            'epargne_jrs'=>$request->epargne_jrs,
            'assurance'=>$request->assurance,
        ]);

        return redirect()->route('recouvrement.index');
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
