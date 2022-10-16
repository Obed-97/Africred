<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Credit;
use App\Models\Client;
use App\Models\Recouvrement;

class RecouvrementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recouvrements = null;

        if (auth()->user()->role_id == 1) {
            $recouvrements = Recouvrement::selectRaw(
               'user_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('user_id')
            ->get();


          }else {
            $recouvrements = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('credit_id')
            ->get();
          }

        $credits = Credit::where('user_id', auth()->user()->id)->get();

        return view('recouvrement.index', compact('credits','recouvrements'));
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

        $recouvrement = new Recouvrement;

        $recouInteret = Recouvrement::where('credit_id', $request->credit_id)->sum('interet_jrs');
        $recouCapital = Recouvrement::where('credit_id', $request->credit_id)->sum('recouvrement_jrs');


        $credit = Credit::where('id', $request->credit_id)->first();

        $encours_actualise = abs((intval($credit->montant_interet)) -

        (intval($recouInteret) +
        intval($recouCapital) +
        intval($request->interet_jrs) +
        intval($request->recouvrement_jrs)
        ));

        $recouvrement->create([
            'user_id'=> auth()->user()->id,
            'credit_id'=>$request->credit_id,
            'encours_actualise'=>$encours_actualise,
            'interet_jrs'=>$request->interet_jrs,
            'recouvrement_jrs'=>$request->recouvrement_jrs,
            'epargne_jrs'=>$request->epargne_jrs,
            'assurance'=>$request->assurance,
        ]);

        return redirect()->route('recouvrement.index');
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
