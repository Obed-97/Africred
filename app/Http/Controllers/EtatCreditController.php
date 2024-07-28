<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Credit;
use App\Models\Marche;
use App\Models\User;
use App\Models\Recouvrement;
use Carbon\Carbon;
use App\Services\Tool;


class EtatCreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8 ) {
            $credits = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::today())->get();
          }else {
            $credits = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->whereDate('date_deblocage', Carbon::today())->get();
          }

        $clients = Client::where('user_id', auth()->user()->id)->get();

        $marches = Marche::get();
        
        return view('credit.jour', compact('clients', 'credits','marches'));
    }

    public function perte()
    {
        $tool = new Tool();
        $credits = [];
        
    
        if (auth()->user()->role_id == 1) {
            $listes = Credit::where('statut', 'Accordé')->where('perte', 'oui')->where('type_id', '1')->get();
              
            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        } else {
            $listes = Credit::where('statut', 'Accordé')->where('perte', 'oui')->where('user_id', auth()->user()->id)->where('type_id', '1')->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        }
        
        

        $marches = Marche::get();
        $agents = User::where('role_id', '2')->get();
        
        
        
        if(auth()->user()->role_id == 1){
            
            $total = Recouvrement::get();
            
        }else{
            
            $total = Recouvrement::where('user_id', auth()->user()->id)->get(); 
            
        }

       

        return view('credit.perte', compact('credits', 'marches','agents','total'));
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
             ->groupBy('user_id')->where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::today())
             ->get();
           
          }else {
            $credits = Credit::where('user_id', auth()->user()->id)->where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::today())->get();
          }

        $clients = Client::where('user_id', auth()->user()->id)->get();

        $marches = Marche::get();
        
        return view('credit.agent_jr', compact('clients', 'credits','marches'));
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
             ->groupBy('marche_id')->where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::today())
             ->get();
 
          }else {
            $credits = Credit::selectRaw(
                'marche_id,
                 SUM(montant) as montant,
                 SUM(interet) as interet,
                 SUM(frais_deblocage) as frais_deblocage,
                 SUM(frais_carte) as frais_carte,
                 SUM(montant_interet) as montant_interet,
                 COUNT(id) as id')->where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::today())
                ->where('user_id', auth()->user()->id)
                ->groupBy('marche_id')
                ->get();
            
          }

        $clients = Client::where('user_id', auth()->user()->id)->get();
        
        $marches = Marche::get();
        
        return view('credit.marche_jr', compact('clients', 'credits','marches'));
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
        
        $tool = new Tool();
        $credits = [];
        

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $listes = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [$request->fdate, $request->sdate])->get();
            
            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }

                
          }else {
            $listes = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->whereBetween('date_deblocage', [$request->fdate, $request->sdate])->get();
            
            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }

         }

       
        return view('credit.filtre', compact('credits', 'date1', 'date2'));
    }
    
    public function filtre_solde(Request $request)
    {
        $date1 = $request->fdate;
        $date2 = $request->sdate;
        
        $tool = new Tool();
        $credits = [];
        

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $listes = Credit::where('statut', 'Accordé')->whereBetween('date_fin', [$request->fdate, $request->sdate])->get();
            
            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours == 0 || $encours < 0){
                    array_push($credits, $liste);
                }

            }

                
          }else {
            $listes = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->whereBetween('date_fin', [$request->fdate, $request->sdate])->get();
            
            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours == 0 || $encours < 0){
                    array_push($credits, $liste);
                }

            }

         }

       
        return view('credit.filtre_solde', compact('credits', 'date1', 'date2'));
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

        $statut = "oui";

        $credit->update([
            'perte'=>$statut,
            
        ]);

        alert()->image('Crédit en perte!','Ce prêt a été mis en perte!','assets/images/payment.png','175','175');
       
        return redirect()->route('credit.index');
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
