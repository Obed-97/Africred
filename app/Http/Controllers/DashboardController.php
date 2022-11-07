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
use App\Models\Banque;

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
         ->groupBy('user_id')->whereDate('date', Carbon::today())
         ->get();

         if (auth()->user()->role_id == 1) {
            $credits = Credit::whereDate('date_deblocage', Carbon::today())->get();
          }else {
            $credits = Credit::whereDate('date_deblocage', Carbon::today())->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1) {
            $credits_hier = Credit::whereDate('date_deblocage', Carbon::yesterday())->get();
          }else {
            $credits_hier = Credit::whereDate('date_deblocage', Carbon::yesterday())->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1) {
            $credits_av_hier = Credit::whereDate('date_deblocage', Carbon::now()->subDays(2))->get();
          }else {
            $credits_av_hier = Credit::whereDate('date_deblocage', Carbon::now()->subDays(2))->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1) {
            $recouvrements = Recouvrement::whereDate('date', Carbon::today())->get();
          }else {
            $recouvrements = Recouvrement::whereDate('date', Carbon::today())->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1) {
            $hier = Recouvrement::whereDate('date', Carbon::yesterday())->get();
          }else {
            $hier = Recouvrement::whereDate('date', Carbon::yesterday())->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1) {
            $avant_hier = Recouvrement::whereDate('date', Carbon::now()->subDays(2))->get();
          }else {
            $avant_hier = Recouvrement::whereDate('date', Carbon::now()->subDays(2))->where('user_id', auth()->user()->id)->get();
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

        $depots = Banque::where('type','Dépôt')->whereDate('date', Carbon::today())->get();
        $retraits = Banque::where('type','Rétrait')->whereDate('date', Carbon::today())->get();


       
        return view('dashboard.index', compact('credits','hier','credits_hier','avant_hier','credits_av_hier', 'recouvrements','agents','clients','agents', 'epargne','tontine','encaissements','decaissements','depots','retraits'));
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
