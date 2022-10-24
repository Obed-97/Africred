<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Credit;
use App\Models\Marche;
use Carbon\Carbon;

class EtatCreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role_id == 1) {
            $credits = Credit::whereDate('created_at', Carbon::today())->get();
          }else {
            $credits = Credit::where('user_id', auth()->user()->id)->whereDate('created_at', Carbon::today())->get();
          }

        $clients = Client::where('user_id', auth()->user()->id)->get();

        $marches = Marche::get();
        
        return view('credit.jour', compact('clients', 'credits','marches'));
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
             ->groupBy('user_id')->whereDate('created_at', Carbon::today())
             ->get();
           
          }else {
            $credits = Credit::where('user_id', auth()->user()->id)->whereDate('created_at', Carbon::today())->get();
          }

        $clients = Client::where('user_id', auth()->user()->id)->get();

        $marches = Marche::get();
        
        return view('credit.agent_jr', compact('clients', 'credits','marches'));
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
             ->groupBy('marche_id')->whereDate('created_at', Carbon::today())
             ->get();
 
          }else {
            $credits = Credit::selectRaw(
                'marche_id,
                 SUM(montant) as montant,
                 SUM(interet) as interet,
                 SUM(frais_deblocage) as frais_deblocage,
                 SUM(frais_carte) as frais_carte,
                 SUM(montant_interet) as montant_interet,
                 COUNT(id) as id')->whereDate('created_at', Carbon::today())
                ->where('user_id', auth()->user()->id)
                ->groupBy('marche_id')
                ->get();
            
          }

        $clients = Client::where('user_id', auth()->user()->id)->get();
        
        $marches = Marche::get();
        
        return view('credit.marche_jr', compact('clients', 'credits','marches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date1 = $request->fdate;
        $date2 = $request->sdate;

        if (auth()->user()->role_id == 1) {
            $credits = Credit::whereBetween('created_at', [$request->fdate, $request->sdate])->get();
          }else {
            $credits = Credit::where('user_id', auth()->user()->id)->whereBetween('created_at', [$request->fdate, $request->sdate])->get();
          }

        $clients = Client::where('user_id', auth()->user()->id)->get();
        $marches = Marche::get();

        return view('credit.filtre', compact('clients', 'credits', 'date1', 'date2','marches'));
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
