<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Recouvrement;
use App\Models\Client;
use App\Models\User;


class FiltreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $agents = Recouvrement::selectRaw(
            'user_id',)
         ->groupBy('user_id')->whereBetween('created_at', [$request->fdate, $request->sdate])
         ->get();

         if (auth()->user()->role_id == 1) {
            $credits = Credit::whereBetween('created_at', [$request->fdate, $request->sdate])->get();
          }else {
            $credits = Credit::where('user_id', auth()->user()->id)->whereBetween('created_at', [$request->fdate, $request->sdate])->get();
          }

          if (auth()->user()->role_id == 1) {
            $recouvrements = Recouvrement::whereBetween('created_at', [$request->fdate, $request->sdate])->get();
          }else {
            $recouvrements = Recouvrement::where('user_id', auth()->user()->id)->whereBetween('created_at', [$request->fdate, $request->sdate])->get();
          }

       
        if (auth()->user()->role_id == 1 || auth()->user()->role_id ) {
        $clients = Client::get();
        }else {
        $clients = Client::where('user_id', auth()->user()->id)->whereBetween('created_at', [$request->fdate, $request->sdate])->get();
        }
        
        $agents = User::where('role_id', '2')->get();
       

        return view('filtre.index', compact('credits', 'recouvrements','agents','clients','agents', 'date1', 'date2'));
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
