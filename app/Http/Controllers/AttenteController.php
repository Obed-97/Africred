<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Credit;
use App\Models\Marche;

use Carbon\Carbon;

class AttenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $credits = Credit::where('statut', 'En attente')->orWhereDate('updated_at', Carbon::now())->get();
        }else {
            $credits = Credit::where('statut', 'En attente')->where('user_id', auth()->user()->id)->get();
        }

        $clients = Client::where('user_id', auth()->user()->id)->get();

        $marches = Marche::get();
        
        return view('credit.attente', compact('clients', 'credits','marches'));
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
        $credit = Credit::where('id', $id)->firstOrFail();

        
        $statut = "Accordé";

        $credit->update([
            
            'statut'=>$statut,
        ]);

        return redirect()->route('attente.index');
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
