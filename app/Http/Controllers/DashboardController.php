<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Recouvrement;
use App\Models\Client;
use App\Models\User;
use App\Models\Depot;
use App\Models\Encaissement;
use App\Models\Decaissement;

use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Recouvrement::selectRaw(
            'user_id',)
         ->groupBy('user_id')->whereDate('created_at', Carbon::today())
         ->get();

         if (auth()->user()->role_id == 1) {
            $credits = Credit::whereDate('created_at', Carbon::today())->get();
          }else {
            $credits = Credit::whereDate('created_at', Carbon::today())->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1) {
            $recouvrements = Recouvrement::whereDate('created_at', Carbon::today())->get();
          }else {
            $recouvrements = Recouvrement::whereDate('created_at', Carbon::today())->where('user_id', auth()->user()->id)->get();
          }

       
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 4) {
        $clients = Client::whereDate('created_at', Carbon::today())->get();
        }else {
        $clients = Client::where('user_id', auth()->user()->id)->whereDate('created_at', Carbon::today())->get();
        }
        
        $agents = User::where('role_id', '2')->get();


        if (auth()->user()->role_id == 1) {
            $epargne = Depot::where('type_depot_id', 2)->whereDate('created_at', Carbon::today())->get();
        }else {
            $epargne = Depot::where('type_depot_id', 2)->whereDate('created_at', Carbon::today())->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1) {
            $tontine = Depot::where('type_depot_id', 1)->whereDate('created_at', Carbon::today())->get();
        }else {
            $tontine = Depot::where('type_depot_id', 1)->whereDate('created_at', Carbon::today())->where('user_id', auth()->user()->id)->get();
        }

        $encaissements = Encaissement::whereDate('date', Carbon::today())->get();
        $decaissements = Decaissement::whereDate('date', Carbon::today())->get();

       
        return view('dashboard.index', compact('credits', 'recouvrements','agents','clients','agents', 'epargne','tontine','encaissements','decaissements'));
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
