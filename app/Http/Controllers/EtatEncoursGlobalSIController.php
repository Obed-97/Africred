<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Recouvrement;
use App\Models\Client;
use App\Services\Tool;
use Carbon\Carbon;


class EtatEncoursGlobalSIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       

        $tool = new Tool();
        $credits = [];

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $listes = Credit::where('statut', 'Accordé')->get();
              
            foreach ($listes as $liste) {

                $solde =  $tool->solde($liste->id); 

                if ($solde > 0){
                    array_push($credits, $liste);
                }

            }
        } else {
            $listes = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();

            foreach ($listes as $liste) {

                $solde =  $tool->solde($liste->id); 

                if ($solde > 0){
                    array_push($credits, $liste);
                }

            }
        }
        
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $encours = Credit::where('statut', 'Accordé')->get();
        } else {
            $encours = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $total = Recouvrement::get();
        } else {
            $total = Recouvrement::where('user_id', auth()->user()->id)->get();
        }
        
        $clients = Client::where('user_id', auth()->user()->id)->get();

        return view('etat_encours_si.index', compact('clients','encours','credits','total'));
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
