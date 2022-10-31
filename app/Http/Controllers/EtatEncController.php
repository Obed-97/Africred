<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Micro_finance;
use App\Models\Encaissement;

use Carbon\Carbon;

class EtatEncController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $micros = Micro_finance::all();

        $encaissements = Encaissement::whereDate('date', Carbon::today())->get();;

        return view('encaissement.jour', compact('micros','encaissements'));
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

        $encaissements = Encaissement::whereBetween('date', [$request->fdate, $request->sdate])->get();;

        return view('encaissement.filtre', compact('micros','encaissements','date1','date2','micros'));
    }

    public function date(Request $request)
    {
        $date = $request->date;

        $micros = Micro_finance::all();

        $encaissements = Encaissement::whereDate('date', $request->date)->get();

        return view('encaissement.date', compact('micros','encaissements','date','micros'));
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
