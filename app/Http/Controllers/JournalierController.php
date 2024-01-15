<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Services\Tool;
use Carbon\Carbon;


class JournalierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tool = new Tool();
        $liste = [];
        $totalMontantParJour = 0;
       

        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 6){

          $credits = Credit::where('statut', 'Accordé')->where('type_id', '1')->whereDate('date_fin','>', Carbon::today()->subDays(30))->get();
          
        foreach ($credits as $credit) {

            $encours =  $tool->encours_actualiser($credit->id); 

            if ($encours > 0){
                array_push($liste, $credit);
                $totalMontantParJour = $credit->montant_par_jour + $credit->epargne_par_jour + $totalMontantParJour ;
            }

        }

        }else{

          $credits = Credit::where('statut', 'Accordé')->where('type_id', '1')->where('user_id', auth()->user()->id)->whereDate('date_fin','>', Carbon::today()->subDays(30))->get();

          foreach ($credits as $credit) {

            $encours =  $tool->encours_actualiser($credit->id); 

            if ($encours > 0){
                array_push($liste, $credit);
                $totalMontantParJour = $credit->montant_par_jour + $credit->epargne_par_jour  + $totalMontantParJour;
            }

          }
        }
        
        return view('journalier.index', compact('liste', 'totalMontantParJour'));
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
        $results = $request['credit_id'];

        $data_credit = explode('|', $results);
        
        $date_r = $request->date_r;
        $date_fin_r = Carbon::create($date_r)->addDays($request->n_delai);
        
        $n_montant = $data_credit[3];
        
        $montant_par_jour = $n_montant / $request->n_delai;
        
        $credit = Credit::where('id', $data_credit[0])->firstOrFail();
        
        $reecheloner ='oui';
        
        $credit->update([
            'date_r'=>$date_r, 
            'n_montant'=>$n_montant,
            'n_delai'=>$request->n_delai,
            'date_fin_r'=>$date_fin_r,
            'montant_par_jour'=>$montant_par_jour,
            'motif_r'=>$request->motif_r,
            'reecheloner'=>$reecheloner,
        ]);
        
        alert()->image('Crédit réécheloné!','Le crédit a été réécheloner!','assets/images/accept.png','100','100');

        return redirect()->route('journalier.index');

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