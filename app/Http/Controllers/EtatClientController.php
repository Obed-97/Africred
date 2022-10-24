<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Marche;
use App\Models\User;
use Carbon\Carbon;

class EtatClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marches = Marche::all();
        $clients = null;

        if (auth()->user()->role_id == 1) {
          $clients = Client::whereDate('created_at', Carbon::today())->get();
        }else {
          $clients = Client::whereDate('created_at', Carbon::today())->where('user_id', auth()->user()->id)->get();
        }
      

        return view('client.jour', compact('clients', 'marches'));
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
        $date1 = $request->fdate;
        $date2 = $request->sdate;

        $marches = Marche::all();
        $clients = null;

        if (auth()->user()->role_id == 1) {
          $clients = Client::whereBetween('created_at', [$request->fdate, $request->sdate])->get();
        }else {
          $clients = Client::whereBetween('created_at', [$request->fdate, $request->sdate])->where('user_id', auth()->user()->id)->get();
        }
      

        return view('client.filtre', compact('clients', 'marches','date1','date2'));
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
