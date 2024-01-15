<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Client;
use App\Models\Recouvrement;
use App\Models\Marche;

use Carbon\Carbon;

class ControleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recouvrements = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('credit_id')
            ->whereDate('date', Carbon::today())
            ->get();

        
        $total = Recouvrement::whereDate('date', Carbon::today())->get();

        return view('controle.index', compact('recouvrements','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
         $recouvrements = Recouvrement::selectRaw(
            'credit_id,
            SUM(encours_actualise) as encours_actualise,
            SUM(recouvrement_jrs) as recouvrement_jrs,
            SUM(epargne_jrs) as epargne_jrs,
            SUM(assurance) as assurance,
            SUM(interet_jrs) as interet_jrs')
        ->groupBy('credit_id')
        ->get();

         

        $credits = Credit::get();
        $marches = Marche::get();

        if (auth()->user()->role_id == 1) {
            $total = Recouvrement::get();
        } else {
            $total = Recouvrement::where('user_id', auth()->user()->id)->get();
        }

        return view('controle.retard1', compact('credits','recouvrements','marches','total'));
    }

    public function retard2()
    {
        $recouvrements = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('credit_id')
            ->whereDate('date', '!=' ,Carbon::today())
            ->whereDate('date', '!=' ,Carbon::now()->subDays(1))
            ->get();

        
        $total = Recouvrement::whereDate('date', '!=' ,Carbon::today())
                            ->whereDate('date', '!=' ,Carbon::now()->subDays(1))->get();

        return view('controle.retard2', compact('recouvrements','total'));
    }

    public function retard3()
    {
        $recouvrements = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('credit_id')
            ->whereDate('date', '!=' ,Carbon::today())
            ->whereDate('date', '!=' ,Carbon::now()->subDays(1))
            ->whereDate('date', '!=' ,Carbon::now()->subDays(2))
            ->get();

        
        $total = Recouvrement::whereDate('date', '!=' ,Carbon::today())
                            ->whereDate('date', '!=' ,Carbon::now()->subDays(1))
                            ->whereDate('date', '!=' ,Carbon::now()->subDays(2))->get();

        return view('controle.retard3', compact('recouvrements','total'));
    }

    public function retard4()
    {
        $recouvrements = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('credit_id')
            ->whereDate('date', '!=' ,Carbon::today())
            ->whereDate('date', '!=' ,Carbon::now()->subDays(1))
            ->whereDate('date', '!=' ,Carbon::now()->subDays(2))
            ->whereDate('date', '!=' ,Carbon::now()->subDays(3))
            ->get();

        
        $total = Recouvrement::whereDate('date', '!=' ,Carbon::today())
                            ->whereDate('date', '!=' ,Carbon::now()->subDays(1))
                            ->whereDate('date', '!=' ,Carbon::now()->subDays(2))
                            ->whereDate('date', '!=' ,Carbon::now()->subDays(3))
                            ->get();

        return view('controle.retard4', compact('recouvrements','total'));
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
