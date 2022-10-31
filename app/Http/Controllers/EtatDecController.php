<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Micro_finance;
use App\Models\Decaissement;

use Carbon\Carbon;

class EtatDecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $micros = Micro_finance::all();

        $decaissements = Decaissement::whereDate('date', Carbon::today())->get();;

        return view('decaissement.jour', compact('micros','decaissements'));
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

        $micros = Micro_finance::all();

        $decaissements = Decaissement::whereBetween('date', [$request->fdate, $request->sdate])->get();;

        return view('decaissement.filtre', compact('micros','decaissements','date1','date2','micros'));
    }

    public function date(Request $request)
    {
        $date = $request->date;
       

        $micros = Micro_finance::all();

        $decaissements = Decaissement::whereDate('date', $request->date)->get();

        return view('decaissement.date', compact('micros','decaissements','date','micros'));
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
