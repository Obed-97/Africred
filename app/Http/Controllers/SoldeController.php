<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Credit;
use App\Models\Marche;
use App\Services\Tool;
use Carbon\Carbon;
use Alert;

class SoldeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
          
        $tool = new Tool();
        $credits = [];

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $listes = Credit::where('statut', 'Accordé')->get();
              
            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours == 0 || $encours < 0){
                    array_push($credits, $liste);
                }

            }
        } else {
            $listes = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours == 0 || $encours < 0){
                    array_push($credits, $liste);
                }

            }
        }

        $clients = Client::where('user_id', auth()->user()->id)->get();

        $marches = Marche::get();
        
        return view('credit.solde', compact('clients', 'credits','marches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $credits = Credit::selectRaw(
                'user_id,
                 SUM(montant) as montant,
                 SUM(interet) as interet,
                 SUM(frais_deblocage) as frais_deblocage,
                 SUM(frais_carte) as frais_carte,
                 SUM(montant_interet) as montant_interet,
                 COUNT(id) as id')
             ->groupBy('user_id')
             ->where('statut', 'Accordé')->get();
 
          }else {
            $credits = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();
          }

        $clients = Client::where('user_id', auth()->user()->id)->get();
        
        $marches = Marche::get();
        
        return view('credit.agent', compact('clients', 'credits','marches'));
    }

    public function marche()
    {
         if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $credits = Credit::selectRaw(
                'marche_id,
                 SUM(montant) as montant,
                 SUM(interet) as interet,
                 SUM(frais_deblocage) as frais_deblocage,
                 SUM(frais_carte) as frais_carte,
                 SUM(montant_interet) as montant_interet,
                 COUNT(id) as id')
             ->groupBy('marche_id')
             ->where('statut', 'Accordé')->get();
 
          }else {
            $credits = Credit::selectRaw(
                'marche_id,
                 SUM(montant) as montant,
                 SUM(interet) as interet,
                 SUM(frais_deblocage) as frais_deblocage,
                 SUM(frais_carte) as frais_carte,
                 SUM(montant_interet) as montant_interet,
                 COUNT(id) as id')->where('statut', 'Accordé')->where('user_id', auth()->user()->id)
             ->groupBy('marche_id')
             ->get();
            
          }

        $clients = Client::where('user_id', auth()->user()->id)->get();
        
        $marches = Marche::get();
        
        return view('credit.marche', compact('clients', 'credits','marches'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credit = new Credit;

        $interet = ($request->montant + 0) * ($request->taux + 0);

        $frais_deblocage = 0;

        if ($request->montant <= 100000) {
            $frais_deblocage = ($request->montant + 0) * 0.05;
        }

        if ($request->montant > 100000){
            $frais_deblocage = ($request->montant + 0) * 0.1;
        }

        if ($request->montant < 100000) {
            $nbre_jrs = 40;
        }

        if(100000 <= $request->montant && $request->montant <= 300000){
            $nbre_jrs = 50;
        }

        if(300000 < $request->montant && $request->montant <= 500000){
            $nbre_jrs = 80;
        }

        $montant_interet = ($request->montant + 0) + $interet;
        
        if ($request->montant < 100000) {
            $montant_par_jour = $montant_interet / 40;
        }

        if(100000 <= $request->montant && $request->montant <= 300000){
            $montant_par_jour = $montant_interet / 50;
        }

        if(300000 < $request->montant && $request->montant <= 500000){
            $montant_par_jour = $montant_interet / 80;
        }
       
        $statut = "En attente";

        $credit->create([
            'client_id'=>$request->client_id,
            'marche_id'=>$request->marche_id,
            'user_id'=> auth()->user()->id,
            'montant'=>$request->montant,
            'nbre_jrs'=>$nbre_jrs,
            'interet'=>$interet,
            'frais_deblocage'=>$frais_deblocage,
            'frais_carte'=>$request->frais_carte,
            'montant_interet'=>$montant_interet,
            'montant_par_jour'=>$montant_par_jour,
            'statut'=>$statut,
        ]);

        alert()->image('Demande envoyée!','Patientez que la demande soit accordée!','assets/images/payment.png','175','175');
       
        return redirect()->route('attente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $credits = $credits = Credit::selectRaw(
                'client_id,
                 SUM(montant) as montant,
                 COUNT(id) as id')
             ->groupBy('client_id')
             ->get();
             
        $credit = Credit::where('id', $id)->firstOrFail();

        return view('credit.show', compact('credit','credits'));
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $credit = Credit::where('id', $id)->firstOrFail();

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $clients = Client::get();
          }else {
            $clients = Client::where('user_id', auth()->user()->id)->get();
          }
        
          $marches = Marche::get();

        return view('credit.edit', compact('clients','credit','marches'));
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

        $interet = ($request->montant + 0) * ($request->taux + 0);

        $frais_deblocage = 0;

        if (($request->montant <= 100000)) {
            $frais_deblocage = ($request->montant + 0) * 0.05;
        }

        if ($request->montant > 100000){
            $frais_deblocage = ($request->montant + 0) * 0.1;
        }

        $montant_interet = ($request->montant + 0) + $interet;
        
        $nbjrs = Carbon::createMidnightDate($request->date_deblocage)->diffInDays($request->date_fin);

        $montant_par_jour = $montant_interet / $nbjrs;

        $credit->update([
            'client_id'=>$request->client_id,
            'marche_id'=>$request->marche_id,
            'user_id'=> auth()->user()->id,
            'montant'=>$request->montant,
            'date_deblocage'=>$request->date_deblocage,
            'date_fin'=>$request->date_fin,
            'interet'=>$interet,
            'frais_deblocage'=>$frais_deblocage,
            'frais_carte'=>$request->frais_carte,
            'montant_interet'=>$montant_interet,
            'montant_par_jour'=>$montant_par_jour,
        ]);

        return redirect()->route('credit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $credit = Credit::findOrFail($request->credit);
        $credit->delete();
        alert()->image('Supprimée!','La demande a été supprimée avec succès!','assets/images/recycle.png','150','150');
        return redirect()->route('attente.index');
    }
}
