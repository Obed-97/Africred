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
use App\Models\Marche;
use App\Models\Transfert;
use App\Models\Taux;
use App\Models\Type_depot;
use Illuminate\Support\Facades\DB;
use App\Services\Tool;


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
        
        $transferts = Transfert::where('pays_d', auth()->user()->pays['libelle'] )->get();
        
        $frais = Taux::where('libelle', 'Frais de transfert')->first();
        
        $taf = Taux::where('libelle', 'Taxe sur activités financières')->first();
          
        $agents = Recouvrement::selectRaw(
            'user_id',)
         ->groupBy('user_id')->whereDate('date', Carbon::today())
         ->get();

         
         if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $credits = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::today())->get();
          }else {
            $credits = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::today())->where('user_id', auth()->user()->id)->get();
          }
          
          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $prev_credits = Credit::where('statut', 'En attente')->get();
          }else {
            $prev_credits = Credit::where('statut', 'En attente')->where('user_id', auth()->user()->id)->get();
          }
        
        $tool = new Tool();
        $liste = [];
        $totalMontantParJour = 0;
        $totalCapitalParJour = 0;
        $totalInteretParJour = 0;
        $totalEpargneParJour = 0;
       

        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 6){

          $previsions = Credit::where('statut', 'Accordé')->where('type_id', '1')->whereDate('date_fin','>', Carbon::today()->subDays(30))->get();
          
        foreach ($previsions as $credit) {

            $encours =  $tool->encours_actualiser($credit->id); 

            if ($encours > 0){
                array_push($liste, $credit);
                $totalMontantParJour = $credit->montant_par_jour + $credit->epargne_par_jour + $totalMontantParJour;
                $totalCapitalParJour = $credit->capital_par_jour  + $totalCapitalParJour;
                $totalInteretParJour = $credit->interet_par_jour  + $totalInteretParJour;
                $totalEpargneParJour = $credit->epargne_par_jour  + $totalEpargneParJour;
            }

        }

        }else{

          $previsions = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->where('type_id', '1')->whereDate('date_fin','>', Carbon::today()->subDays(30))->get();

          foreach ($previsions as $credit) {

            $encours =  $tool->encours_actualiser($credit->id); 

            if ($encours > 0){
                array_push($liste, $credit);
                $totalMontantParJour = $credit->montant_par_jour + $credit->epargne_par_jour + $totalMontantParJour;
                $totalCapitalParJour = $credit->capital_par_jour  + $totalCapitalParJour;
                $totalInteretParJour = $credit->interet_par_jour  + $totalInteretParJour;
                $totalEpargneParJour = $credit->epargne_par_jour  + $totalEpargneParJour;
            }

          }
        }
          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $credits_hier = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::yesterday())->get();
          }else {
            $credits_hier = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::yesterday())->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $credits_av_hier = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::now()->subDays(2))->get();
          }else {
            $credits_av_hier = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::now()->subDays(2))->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $recouvrements = Recouvrement::whereDate('date', Carbon::today())->where('type_id', '1')->get();
          }else {
            $recouvrements = Recouvrement::whereDate('date', Carbon::today())->where('user_id', auth()->user()->id)->where('type_id', '1')->get();
          }
          
          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $ab_sugu = Recouvrement::whereDate('date', Carbon::today())->where('type_id', '2')->get();
          }else {
            $ab_sugu = Recouvrement::whereDate('date', Carbon::today())->where('user_id', auth()->user()->id)->where('type_id', '2')->get();
          }

          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $hier = Recouvrement::whereDate('date', Carbon::yesterday())->where('type_id', '1')->get();
          }else {
            $hier = Recouvrement::whereDate('date', Carbon::yesterday())->where('user_id', auth()->user()->id)->where('type_id', '1')->get();
          }

          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $avant_hier = Recouvrement::whereDate('date', Carbon::now()->subDays(2))->where('type_id', '1')->get();
          }else {
            $avant_hier = Recouvrement::whereDate('date', Carbon::now()->subDays(2))->where('user_id', auth()->user()->id)->where('type_id', '1')->get();
          }

       
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
        $clients = Client::whereDate('created_at', Carbon::today())->get();
        }else {
        $clients = Client::where('user_id', auth()->user()->id)->whereDate('created_at', Carbon::today())->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
          $clientss = Client::get();
          }else {
          $clientss = Client::where('user_id', auth()->user()->id)->get();
          }
  
        
        $agents = User::where('role_id', '2')->get();


        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $epargne = Depot::where('type_depot_id', 2)->whereDate('date', Carbon::today())->get();
        }else {
            $epargne = Depot::where('type_depot_id', 2)->whereDate('date', Carbon::today())->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $tontine = Depot::where('type_depot_id', 1)->whereDate('date', Carbon::today())->get();
        }else {
            $tontine = Depot::where('type_depot_id', 1)->whereDate('date', Carbon::today())->where('user_id', auth()->user()->id)->get();
        }

        $encaissements = Encaissement::whereDate('date', Carbon::today())->get();
        $decaissements = Decaissement::whereDate('date', Carbon::today())->get();

        $depots = Banque::where('type','Dépôt')->get();
        $retraits = Banque::where('type','Rétrait')->get();
        
        $marches = Marche::all();

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $depotss = Depot::whereDate('date', Carbon::today())->get();
        }else {
            $depotss = Depot::whereDate('date', Carbon::today())->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {

        $client_01 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '01')
                      ->count();
        $client_02 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '02')
                      ->count();
        $client_03 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '03')
                      ->count();
        $client_04 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '04')
                      ->count();
        $client_05 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '05')
                      ->count();
        $client_06 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '06')
                      ->count();
        $client_07 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '07')
                      ->count();
        $client_08 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '08')
                      ->count();
        $client_09 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '09')
                      ->count();
        $client_10 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '10')
                      ->count();
        $client_11 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '11')
                      ->count();
        $client_12 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '12')
                      ->count();

        $datas = array($client_01,$client_02,$client_03,$client_04,$client_05,$client_06,$client_07,$client_08,$client_09,$client_10,$client_11,$client_12);

        $deblocage_01 = Credit::whereYear('date_deblocage', date('Y'))
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '01')
                      ->count();
        $deblocage_02 = Credit::whereYear('date_deblocage', date('Y'))
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '02')
                      ->count();
        $deblocage_03 = Credit::whereYear('date_deblocage', date('Y'))
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '03')
                      ->count();
        $deblocage_04 = Credit::whereYear('date_deblocage', date('Y'))
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '04')
                      ->count();
        $deblocage_05 = Credit::whereYear('date_deblocage', date('Y'))
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '05')
                      ->count();
        $deblocage_06 = Credit::whereYear('date_deblocage', date('Y'))
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '06')
                      ->count();
        $deblocage_07 = Credit::whereYear('date_deblocage', date('Y'))
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '07')
                      ->count();
        $deblocage_08 = Credit::whereYear('date_deblocage', date('Y'))
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '08')
                      ->count();
        $deblocage_09 = Credit::whereYear('date_deblocage', date('Y'))
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '09')
                      ->count();
        $deblocage_10 = Credit::whereYear('date_deblocage', date('Y'))
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '10')
                      ->count();
        $deblocage_11 = Credit::whereYear('date_deblocage', date('Y'))
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '11')
                      ->count();
        $deblocage_12 = Credit::whereYear('date_deblocage', date('Y'))
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '12')
                      ->count();

        $donnes_deblocage = array($deblocage_01,$deblocage_02,$deblocage_03,$deblocage_04,$deblocage_05,$deblocage_06,$deblocage_07,$deblocage_08,$deblocage_09,$deblocage_10,$deblocage_11,$deblocage_12);

        $attente_01 = Credit::whereYear('created_at', date('Y'))
                      ->where('statut', 'En attente')
                      ->whereMonth('created_at', '01')
                      ->count();
        $attente_02 = Credit::whereYear('created_at', date('Y'))
                      ->where('statut', 'En attente')
                      ->whereMonth('created_at', '02')
                      ->count();
        $attente_03 = Credit::whereYear('created_at', date('Y'))
                      ->where('statut', 'En attente')
                      ->whereMonth('created_at', '03')
                      ->count();
        $attente_04 = Credit::whereYear('created_at', date('Y'))
                      ->where('statut', 'En attente')
                      ->whereMonth('created_at', '04')
                      ->count();
        $attente_05 = Credit::whereYear('created_at', date('Y'))
                      ->where('statut', 'En attente')
                      ->whereMonth('created_at', '05')
                      ->count();
        $attente_06 = Credit::whereYear('created_at', date('Y'))
                      ->where('statut', 'En attente')
                      ->whereMonth('created_at', '06')
                      ->count();
        $attente_07 = Credit::whereYear('created_at', date('Y'))
                      ->where('statut', 'En attente')
                      ->whereMonth('created_at', '07')
                      ->count();
        $attente_08 = Credit::whereYear('created_at', date('Y'))
                      ->where('statut', 'En attente')
                      ->whereMonth('created_at', '08')
                      ->count();
        $attente_09 = Credit::whereYear('created_at', date('Y'))
                      ->where('statut', 'En attente')
                      ->whereMonth('created_at', '09')
                      ->count();
        $attente_10 = Credit::whereYear('created_at', date('Y'))
                      ->where('statut', 'En attente')
                      ->whereMonth('created_at', '10')
                      ->count();
        $attente_11 = Credit::whereYear('created_at', date('Y'))
                      ->where('statut', 'En attente')
                      ->whereMonth('created_at', '11')
                      ->count();
        $attente_12 = Credit::whereYear('created_at', date('Y'))
                      ->where('statut', 'En attente')
                      ->whereMonth('created_at', '12')
                      ->count();

        $donnes_attente = array($attente_01,$attente_02,$attente_03,$attente_04,$attente_05,$attente_06,$attente_07,$attente_08,$attente_09,$attente_10,$attente_11,$attente_12);
        
        $interet_recouvre = Recouvrement::whereYear('date', date('Y'))->sum('interet_jrs');
        
        $capital_recouvre = Recouvrement::whereYear('date', date('Y'))->sum('recouvrement_jrs');
        
        $deblocage_annee = Credit::whereYear('date_deblocage', date('Y'))->where('statut', 'Accordé')->sum('montant');
        
        $enc1 = Credit::where('statut', 'Accordé')->sum('montant_interet') ;
        $enc2 = Recouvrement::sum('recouvrement_jrs') ;
        $enc3 = Recouvrement::sum('interet_jrs') ;
        
        $encours_global = $enc1 - ($enc2 +$enc3);
        
        }else {
            $client_01 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '01')->where('user_id', auth()->user()->id)
                      ->count();
            $client_02 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '02')->where('user_id', auth()->user()->id)
                          ->count();
            $client_03 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '03')->where('user_id', auth()->user()->id)
                          ->count();
            $client_04 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '04')->where('user_id', auth()->user()->id)
                          ->count();
            $client_05 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '05')->where('user_id', auth()->user()->id)
                          ->count();
            $client_06 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '06')->where('user_id', auth()->user()->id)
                          ->count();
            $client_07 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '07')->where('user_id', auth()->user()->id)
                          ->count();
            $client_08 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '08')->where('user_id', auth()->user()->id)
                          ->count();
            $client_09 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '09')->where('user_id', auth()->user()->id)
                          ->count();
            $client_10 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '10')->where('user_id', auth()->user()->id)
                          ->count();
            $client_11 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '11')->where('user_id', auth()->user()->id)
                          ->count();
            $client_12 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '12')->where('user_id', auth()->user()->id)
                          ->count();
    
            $datas = array($client_01,$client_02,$client_03,$client_04,$client_05,$client_06,$client_07,$client_08,$client_09,$client_10,$client_11,$client_12);
    
            $deblocage_01 = Credit::whereYear('date_deblocage', date('Y'))
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '01')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_02 = Credit::whereYear('date_deblocage', date('Y'))
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '02')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_03 = Credit::whereYear('date_deblocage', date('Y'))
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '03')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_04 = Credit::whereYear('date_deblocage', date('Y'))
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '04')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_05 = Credit::whereYear('date_deblocage', date('Y'))
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '05')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_06 = Credit::whereYear('date_deblocage', date('Y'))
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '06')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_07 = Credit::whereYear('date_deblocage', date('Y'))
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '07')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_08 = Credit::whereYear('date_deblocage', date('Y'))
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '08')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_09 = Credit::whereYear('date_deblocage', date('Y'))
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '09')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_10 = Credit::whereYear('date_deblocage', date('Y'))
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '10')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_11 = Credit::whereYear('date_deblocage', date('Y'))
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '11')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_12 = Credit::whereYear('date_deblocage', date('Y'))
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '12')->where('user_id', auth()->user()->id)
                          ->count();
    
            $donnes_deblocage = array($deblocage_01,$deblocage_02,$deblocage_03,$deblocage_04,$deblocage_05,$deblocage_06,$deblocage_07,$deblocage_08,$deblocage_09,$deblocage_10,$deblocage_11,$deblocage_12);
    
            $attente_01 = Credit::whereYear('created_at', date('Y'))
                          ->where('statut', 'En attente')
                          ->whereMonth('created_at', '01')->where('user_id', auth()->user()->id)
                          ->count();
            $attente_02 = Credit::whereYear('created_at', date('Y'))
                          ->where('statut', 'En attente')
                          ->whereMonth('created_at', '02')->where('user_id', auth()->user()->id)
                          ->count();
            $attente_03 = Credit::whereYear('created_at', date('Y'))
                          ->where('statut', 'En attente')
                          ->whereMonth('created_at', '03')->where('user_id', auth()->user()->id)
                          ->count();
            $attente_04 = Credit::whereYear('created_at', date('Y'))
                          ->where('statut', 'En attente')
                          ->whereMonth('created_at', '04')->where('user_id', auth()->user()->id)
                          ->count();
            $attente_05 = Credit::whereYear('created_at', date('Y'))
                          ->where('statut', 'En attente')
                          ->whereMonth('created_at', '05')->where('user_id', auth()->user()->id)
                          ->count();
            $attente_06 = Credit::whereYear('created_at', date('Y'))
                          ->where('statut', 'En attente')
                          ->whereMonth('created_at', '06')->where('user_id', auth()->user()->id)
                          ->count();
            $attente_07 = Credit::whereYear('created_at', date('Y'))
                          ->where('statut', 'En attente')
                          ->whereMonth('created_at', '07')->where('user_id', auth()->user()->id)
                          ->count();
            $attente_08 = Credit::whereYear('created_at', date('Y'))
                          ->where('statut', 'En attente')
                          ->whereMonth('created_at', '08')->where('user_id', auth()->user()->id)
                          ->count();
            $attente_09 = Credit::whereYear('created_at', date('Y'))
                          ->where('statut', 'En attente')
                          ->whereMonth('created_at', '09')->where('user_id', auth()->user()->id)
                          ->count();
            $attente_10 = Credit::whereYear('created_at', date('Y'))
                          ->where('statut', 'En attente')
                          ->whereMonth('created_at', '10')->where('user_id', auth()->user()->id)
                          ->count();
            $attente_11 = Credit::whereYear('created_at', date('Y'))
                          ->where('statut', 'En attente')
                          ->whereMonth('created_at', '11')->where('user_id', auth()->user()->id)
                          ->count();
            $attente_12 = Credit::whereYear('created_at', date('Y'))
                          ->where('statut', 'En attente')
                          ->whereMonth('created_at', '12')->where('user_id', auth()->user()->id)
                          ->count();
    
            $donnes_attente = array($attente_01,$attente_02,$attente_03,$attente_04,$attente_05,$attente_06,$attente_07,$attente_08,$attente_09,$attente_10,$attente_11,$attente_12);
            
            $interet_recouvre = Recouvrement::whereYear('date', date('Y'))->where('user_id', auth()->user()->id)->sum('interet_jrs');
            
            $capital_recouvre = Recouvrement::whereYear('date', date('Y'))->where('user_id', auth()->user()->id)->sum('recouvrement_jrs');
            
            $deblocage_annee = Credit::whereYear('date_deblocage', date('Y'))->where('statut', 'Accordé')->where('user_id', auth()->user()->id)->sum('montant');
            
            $enc1 = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->sum('montant_interet') ;
            $enc2 = Recouvrement::where('user_id', auth()->user()->id)->sum('recouvrement_jrs') ;
            $enc3 = Recouvrement::where('user_id', auth()->user()->id)->sum('interet_jrs') ;
            
            $encours_global = $enc1 - ($enc2 +$enc3);
        }

        $types =Type_depot::get();

        
        return view('dashboard.index', compact('ab_sugu','frais','taf','transferts','types','depotss','liste','prev_credits','totalMontantParJour','totalCapitalParJour','totalInteretParJour','totalEpargneParJour','encours_global','deblocage_annee','interet_recouvre','capital_recouvre','donnes_attente','donnes_deblocage','datas','marches','credits','hier','credits_hier','avant_hier','credits_av_hier', 'recouvrements','agents','clients','clientss','agents', 'epargne','tontine','encaissements','decaissements','depots','retraits'));
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
