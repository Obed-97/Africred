<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recouvrement;
use App\Models\Credit;
use App\Models\Marche;

use Carbon\Carbon;

class HistoriqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $historiques = Recouvrement::whereDate('date', Carbon::today())->get();
          }else {
            $historiques = Recouvrement::whereDate('date', Carbon::today())->where('user_id', auth()->user()->id)->get();
          }
         
          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $credits = Credit::all();
          }else {
            $credits = Credit::where('user_id', auth()->user()->id)->get(); 
          }

        return view('historique.index', compact('historiques','credits'));
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
        $date = $request->date;

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $historiques = Recouvrement::whereDate('date', $request->date)->get();
          }else {
            $historiques = Recouvrement::whereDate('date', $request->date)->where('user_id', auth()->user()->id)->get();
          }

        return view('historique.date', compact('date','historiques'));
    }
    
    public function hist(Request $request)
    {
        $credit_id = $request->credit_id;

        $historiques = Recouvrement::where('credit_id', $credit_id)->get();
        
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $credits = Credit::all();
          }else {
            $credits = Credit::where('user_id', auth()->user()->id)->get(); 
          }
        
        return view('historique.global', compact('historiques','credits'));
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
            
            'credit_id'=>$request->credit_id,
            'marche_id'=>$request->marche_id,
            'date'=>$request->date,
            'encours_actualise'=>$encours_actualise,
            'interet_jrs'=>$request->interet_jrs,
            'recouvrement_jrs'=>$request->recouvrement_jrs,
            'epargne_jrs'=>$request->epargne_jrs,
            'assurance'=>$request->assurance,
        ]);
        
        alert()->image('Modifier','Le recouvrement a été modifié','/assets/images/accept.png','100','100');

        return redirect()->route('etat_recouvrement.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $historique = Recouvrement::findOrFail($request->historique);
        $historique->delete();
        
        alert()->image('Supprimé!!!','','/assets/images/recycle.png','150','150');
        return redirect()->back();
    }
}
