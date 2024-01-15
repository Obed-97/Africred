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


use Carbon\Carbon;

class EtatGlobalController extends Controller
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
         ->groupBy('user_id')
         ->get();

         if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $credits = Credit::where('statut', 'Accordé')->get();
          }else {
            $credits = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $recouvrements = Recouvrement::get();
          }else {
            $recouvrements = Recouvrement::where('user_id', auth()->user()->id)->get();
          }

       
          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $clients = Client::get();
            }else {
            $clients = Client::where('user_id', auth()->user()->id)->get();
            }
        
        $agents = User::where('role_id', '2')->get();
      

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $epargne = Depot::where('type_depot_id', 2)->get();
        }else {
            $epargne = Depot::where('type_depot_id', 2)->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $tontine = Depot::where('type_depot_id', 1)->get();
        }else {
            $tontine = Depot::where('type_depot_id', 1)->where('user_id', auth()->user()->id)->get();
        }

        $encaissements = Encaissement::get();
        $decaissements = Decaissement::get();

        $depots = Banque::where('type','Dépôt')->get();
        $retraits = Banque::where('type','Rétrait')->get();
        
        $marches = Marche::all();
        
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {

        $client_01 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                      ->whereMonth('created_at', '01')
                      ->count();
        $client_02 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                      ->whereMonth('created_at', '02')
                      ->count();
        $client_03 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                      ->whereMonth('created_at', '03')
                      ->count();
        $client_04 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                      ->whereMonth('created_at', '04')
                      ->count();
        $client_05 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                      ->whereMonth('created_at', '05')
                      ->count();
        $client_06 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                      ->whereMonth('created_at', '06')
                      ->count();
        $client_07 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                      ->whereMonth('created_at', '07')
                      ->count();
        $client_08 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                      ->whereMonth('created_at', '08')
                      ->count();
        $client_09 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                      ->whereMonth('created_at', '09')
                      ->count();
        $client_10 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                      ->whereMonth('created_at', '10')
                      ->count();
        $client_11 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                      ->whereMonth('created_at', '11')
                      ->count();
        $client_12 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                      ->whereMonth('created_at', '12')
                      ->count();

        $datas = array($client_01,$client_02,$client_03,$client_04,$client_05,$client_06,$client_07,$client_08,$client_09,$client_10,$client_11,$client_12);
        
        $clientele_01 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '01')
                      ->count();
        $clientele_02 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '02')
                      ->count();
        $clientele_03 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '03')
                      ->count();
        $clientele_04 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '04')
                      ->count();
        $clientele_05 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '05')
                      ->count();
        $clientele_06 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '06')
                      ->count();
        $clientele_07 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '07')
                      ->count();
        $clientele_08 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '08')
                      ->count();
        $clientele_09 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '09')
                      ->count();
        $clientele_10 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '10')
                      ->count();
        $clientele_11 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '11')
                      ->count();
        $clientele_12 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '12')
                      ->count();

        $donnees_client = array($clientele_01,$clientele_02,$clientele_03,$clientele_04,$clientele_05,$clientele_06,$clientele_07,$clientele_08,$clientele_09,$clientele_10,$clientele_11,$clientele_12);

        $deblocage_01 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '01')
                      ->count();
        $deblocage_02 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '02')
                      ->count();
        $deblocage_03 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '03')
                      ->count();
        $deblocage_04 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '04')
                      ->count();
        $deblocage_05 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '05')
                      ->count();
        $deblocage_06 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '06')
                      ->count();
        $deblocage_07 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '07')
                      ->count();
        $deblocage_08 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '08')
                      ->count();
        $deblocage_09 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '09')
                      ->count();
        $deblocage_10 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '10')
                      ->count();
        $deblocage_11 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '11')
                      ->count();
        $deblocage_12 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                      ->where('statut', 'Accordé')
                      ->whereMonth('date_deblocage', '12')
                      ->count();

        $donnes_deblocage = array($deblocage_01,$deblocage_02,$deblocage_03,$deblocage_04,$deblocage_05,$deblocage_06,$deblocage_07,$deblocage_08,$deblocage_09,$deblocage_10,$deblocage_11,$deblocage_12);
        
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

        $donnes_deblocages = array($deblocage_01,$deblocage_02,$deblocage_03,$deblocage_04,$deblocage_05,$deblocage_06,$deblocage_07,$deblocage_08,$deblocage_09,$deblocage_10,$deblocage_11,$deblocage_12);
        
        $interet_recouvre = Recouvrement::sum('interet_jrs');
        
        $capital_recouvre = Recouvrement::sum('recouvrement_jrs');
        
        $deblocage_annee = Credit::where('statut', 'Accordé')->sum('montant');
        
        $enc1 = Credit::where('statut', 'Accordé')->sum('montant_interet') ;
        $enc2 = Recouvrement::sum('recouvrement_jrs') ;
        $enc3 = Recouvrement::sum('interet_jrs') ;
        
        $encours_global = $enc1 - ($enc2 +$enc3);
        
        }else {
            $client_01 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                      ->whereMonth('created_at', '01')->where('user_id', auth()->user()->id)
                      ->count();
            $client_02 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                          ->whereMonth('created_at', '02')->where('user_id', auth()->user()->id)
                          ->count();
            $client_03 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                          ->whereMonth('created_at', '03')->where('user_id', auth()->user()->id)
                          ->count();
            $client_04 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                          ->whereMonth('created_at', '04')->where('user_id', auth()->user()->id)
                          ->count();
            $client_05 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                          ->whereMonth('created_at', '05')->where('user_id', auth()->user()->id)
                          ->count();
            $client_06 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                          ->whereMonth('created_at', '06')->where('user_id', auth()->user()->id)
                          ->count();
            $client_07 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                          ->whereMonth('created_at', '07')->where('user_id', auth()->user()->id)
                          ->count();
            $client_08 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                          ->whereMonth('created_at', '08')->where('user_id', auth()->user()->id)
                          ->count();
            $client_09 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                          ->whereMonth('created_at', '09')->where('user_id', auth()->user()->id)
                          ->count();
            $client_10 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                          ->whereMonth('created_at', '10')->where('user_id', auth()->user()->id)
                          ->count();
            $client_11 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                          ->whereMonth('created_at', '11')->where('user_id', auth()->user()->id)
                          ->count();
            $client_12 = Client::whereYear('created_at', Carbon::create(date('Y'))->subYear())
                          ->whereMonth('created_at', '12')->where('user_id', auth()->user()->id)
                          ->count();
    
            $datas = array($client_01,$client_02,$client_03,$client_04,$client_05,$client_06,$client_07,$client_08,$client_09,$client_10,$client_11,$client_12);
            
            $clientele_01 = Client::whereYear('created_at', date('Y'))
                      ->whereMonth('created_at', '01')->where('user_id', auth()->user()->id)
                      ->count();
            $clientele_02 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '02')->where('user_id', auth()->user()->id)
                          ->count();
            $clientele_03 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '03')->where('user_id', auth()->user()->id)
                          ->count();
            $clientele_04 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '04')->where('user_id', auth()->user()->id)
                          ->count();
            $clientele_05 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '05')->where('user_id', auth()->user()->id)
                          ->count();
            $clientele_06 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '06')->where('user_id', auth()->user()->id)
                          ->count();
            $clientele_07 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '07')->where('user_id', auth()->user()->id)
                          ->count();
            $clientele_08 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '08')->where('user_id', auth()->user()->id)
                          ->count();
            $clientele_09 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '09')->where('user_id', auth()->user()->id)
                          ->count();
            $clientele_10 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '10')->where('user_id', auth()->user()->id)
                          ->count();
            $clientele_11 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '11')->where('user_id', auth()->user()->id)
                          ->count();
            $clientele_12 = Client::whereYear('created_at', date('Y'))
                          ->whereMonth('created_at', '12')->where('user_id', auth()->user()->id)
                          ->count();
    
            $donnees_client = array($clientele_01,$clientele_02,$clientele_03,$clientele_04,$clientele_05,$clientele_06,$clientele_07,$clientele_08,$clientele_09,$clientele_10,$clientele_11,$clientele_12);
    
            $deblocage_01 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '01')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_02 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '02')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_03 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '03')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_04 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '04')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_05 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '05')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_06 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '06')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_07 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '07')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_08 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '08')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_09 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '09')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_10 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '10')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_11 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '11')->where('user_id', auth()->user()->id)
                          ->count();
            $deblocage_12 = Credit::whereYear('date_deblocage', Carbon::create(date('Y'))->subYear())
                          ->where('statut', 'Accordé')
                          ->whereMonth('date_deblocage', '12')->where('user_id', auth()->user()->id)
                          ->count();
    
            $donnes_deblocage = array($deblocage_01,$deblocage_02,$deblocage_03,$deblocage_04,$deblocage_05,$deblocage_06,$deblocage_07,$deblocage_08,$deblocage_09,$deblocage_10,$deblocage_11,$deblocage_12);
            
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
    
            $donnes_deblocages = array($deblocage_01,$deblocage_02,$deblocage_03,$deblocage_04,$deblocage_05,$deblocage_06,$deblocage_07,$deblocage_08,$deblocage_09,$deblocage_10,$deblocage_11,$deblocage_12);
            
            
            $interet_recouvre = Recouvrement::where('user_id', auth()->user()->id)->sum('interet_jrs');
            
            $capital_recouvre = Recouvrement::where('user_id', auth()->user()->id)->sum('recouvrement_jrs');
            
            $deblocage_annee = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->sum('montant');
            
            $enc1 = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->sum('montant_interet') ;
            $enc2 = Recouvrement::where('user_id', auth()->user()->id)->sum('recouvrement_jrs') ;
            $enc3 = Recouvrement::where('user_id', auth()->user()->id)->sum('interet_jrs') ;
            
            $encours_global = $enc1 - ($enc2 +$enc3);
        }

        
        return view('etat_global.index', compact('encours_global','deblocage_annee','interet_recouvre','capital_recouvre','donnes_deblocage','datas','donnes_deblocages','donnees_client','marches','credits', 'recouvrements','agents','clients','agents','epargne','tontine','encaissements','decaissements','depots','retraits'));
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
        $date = $request->date;

        $agents = Recouvrement::selectRaw(
            'user_id',)
         ->groupBy('user_id')->whereDate('date', $request->date)
         ->get();

         if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $credits = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', $request->date)->get();
          }else {
            $credits = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', $request->date)->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
            $recouvrements = Recouvrement::whereDate('date', $request->date)->get();
          }else {
            $recouvrements = Recouvrement::whereDate('date', $request->date)->where('user_id', auth()->user()->id)->get();
          }

       
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
        $clients = Client::whereDate('created_at', $request->date)->get();
        }else {
        $clients = Client::where('user_id', auth()->user()->id)->whereDate('created_at', $request->date)->get();
        }
        
        $agents = User::where('role_id', '2')->get();

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
          $epargne = Depot::where('type_depot_id', 2)->whereDate('created_at', $request->date)->get();
          }else {
          $epargne = Depot::where('type_depot_id', 2)->whereDate('created_at', $request->date)->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
              $tontine = Depot::where('type_depot_id', 1)->whereDate('created_at', $request->date)->get();
          }else {
              $tontine = Depot::where('type_depot_id', 1)->whereDate('created_at', $request->date)->where('user_id', auth()->user()->id)->get();
          }

          $encaissements = Encaissement::whereDate('date', $request->date)->get();
          $decaissements = Decaissement::whereDate('date', $request->date)->get();

          $depots = Banque::where('type','Dépôt')->whereDate('date', $request->date)->get();
          $retraits = Banque::where('type','Rétrait')->whereDate('date', $request->date)->get();
          
          $marches = Marche::all();

       
        
        return view('dashboard.date', compact('marches','credits', 'recouvrements','agents','clients','agents','date','epargne','tontine','encaissements','decaissements','depots','retraits'));
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
