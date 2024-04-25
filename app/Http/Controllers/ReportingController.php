<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\User;
use App\Models\Depot;
use App\Models\Credit;
use App\Models\ReportingDataItem;
use App\Models\ReportingItem;
use Carbon\Carbon;
use App\Services\Tool;
use Barryvdh\DomPDF\Facade\Pdf;
    use Illuminate\Http\Request;

class ReportingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reporting.reporting', [
            'coom1' => '' ,
            'coom2' => '' ,
            'coom3' => '' ,
            'coom4' => '' ,
            'coom5' => '' ,
            'coom6' => '' ,
            'coom7' => '' ,
            'coom8' => '' ,
            'coom9' => '' ,
            'coom10' => '' ,
            'coom11' => '' ,
            'coom12' => '' ,
            'coom13' => '' ,
            'coom14' => '' ,
            'coom15' => '' ,
        ]);
    }


    public function print(Request $request)
    {
        // dd($request);
        $pdf = Pdf::loadView('reporting.print', [

        // return view('reporting.print', [

            'coom1' => $request->com1,
            'coom2' => $request->com2,
            'coom3' => $request->com3,
            'coom4' => $request->com4,
            'coom5' => $request->com5,
            'coom6' => $request->com6,
            'coom7' => $request->com7,
            'coom8' => $request->com8,
            'coom9' => $request->com9,
            'coom10' => $request->com10,
            'coom11' => $request->com11,
            'coom12' => $request->com12,
            'coom13' => $request->com13,
            'coom14' => $request->com14,
            'coom15' => $request->com15,
        ]);
        return $pdf->download('dddd.pdf');


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reporting.create');
    }


    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        ReportingItem::create([
            'name' => $request->name,
            'type' => $request->type
        ]);

        return back();
    }


    public function add_data(Request $request)
    {
        // $request->validate([
        //     'reporting_items_id' => 'required|exists:reporting_items,id',
        //     'pre' => 'nullable|numeric|min:0',
        //     'rea' => 'require|numeric|min:1',
        //     'date' => 'required|date'
        // ]);

        ReportingDataItem::create([
            'reporting_items_id' => $request->reporting_items_id,
            'pre' => $request->pre,
            'rea' => $request->rea,
            'date' => Carbon::parse($request->date),
        ]);

        return back();
    }


    public function del(Request $request)
    {
        $rep = ReportingDataItem::findOrFail($request->id);

        $rep->delete();

        return back();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trimestre = $request->trimestre;

        $now = Carbon::now();

        $year = $now->year;

        if($trimestre == 'TRIMESTRE 1'){
            $date_debut = Carbon::create($year, 1, 1, 0);
            $date_fin = Carbon::create($year, 3, 31, 0);
            $t_1 = Carbon::create($year, 1, 1, 0)->subday(1);

            $clients = Client::get();

            $clientss = Client::whereYear('created_at',  $year)->get();

            $clientsss = Client::whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $physiques = Client::where('type_compte_id', 1)->get();

            $physiquess = Client::where('type_compte_id', 1)->whereYear('created_at',  $year)->get();

            $physiquesss = Client::where('type_compte_id', 1)->whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();



            $hommes = Client::where('sexe', 'masculin')->get();

            $hommess = Client::where('sexe', 'masculin')->whereYear('created_at',  $year)->get();

            $hommesss = Client::where('sexe', 'masculin')->whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $femmes = Client::where('sexe', 'feminin')->get();

            $femmess = Client::where('sexe', 'feminin')->whereYear('created_at',  $year)->get();

            $femmesss = Client::where('sexe', 'feminin')->whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $morales = Client::where('type_compte_id', 2)->get();

            $moraless = Client::where('type_compte_id', 2)->whereYear('created_at',  $year)->get();

            $moralesss = Client::where('type_compte_id', 2)->whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $ca = User::where('role_id', 1)->get();

            $cas = User::where('role_id', 1)->whereYear('created_at',  $year)->get();

            $cass = User::where('role_id', 1)->whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $surveillant = User::where('role_id', 6)->get();

            $surveillants = User::where('role_id', 6)->whereYear('created_at',  $year)->get();

            $surveillantss = User::where('role_id', 6)->whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $employe = User::get();

            $employes = User::whereYear('created_at',  $year)->get();

            $employess = User::whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $agent = User::where('role_id', 2)->get();

            $agents = User::where('role_id', 2)->whereYear('created_at',  $year)->get();

            $agentss = User::where('role_id', 2)->whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $tool = new Tool();

            $credit = [];
            $credits = [];
            $creditss = [];

            $listes = Credit::where('statut', 'Accordé')->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit, $liste);
                }

            }


            $listess = Credit::where('statut', 'Accordé')->whereYear('date_deblocage',  $year)->get();

            foreach ($listess as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }

            $listesss = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($listesss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($creditss, $liste);
                }

            }

            $credit_p = [];
            $credit_ps = [];
            $credit_pss = [];

            $p = Credit::where('statut', 'Accordé')->where('nature', 1)->get();

            foreach ($p as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_p, $liste);
                }

            }


            $ps = Credit::where('statut', 'Accordé')->where('nature', 1)->whereYear('date_deblocage',  $year)->get();

            foreach ($ps as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_ps, $liste);
                }

            }

            $pss = Credit::where('statut', 'Accordé')->where('nature', 1)->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($pss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_pss, $liste);
                }

            }


            $credit_h = [];
            $credit_hs = [];
            $credit_hss = [];

            $h = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->get();

            foreach ($h as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_h, $liste);
                }

            }


            $hs = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->whereYear('date_deblocage',  $year)->get();

            foreach ($hs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_hs, $liste);
                }

            }

            $hss = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($hss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_hss, $liste);
                }

            }


            $credit_f = [];
            $credit_fs = [];
            $credit_fss = [];

            $f = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->get();

            foreach ($f as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_f, $liste);
                }

            }


            $fs = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->whereYear('date_deblocage',  $year)->get();

            foreach ($fs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_fs, $liste);
                }

            }

            $fss = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($fss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_fss, $liste);
                }

            }

            $credit_m = [];
            $credit_ms = [];
            $credit_mss = [];

            $m = Credit::where('statut', 'Accordé')->where('nature', 2)->get();

            foreach ($m as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_m, $liste);
                }

            }


            $ms = Credit::where('statut', 'Accordé')->where('nature', 2)->whereYear('date_deblocage',  $year)->get();

            foreach ($ms as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_ms, $liste);
                }

            }

            $mss = Credit::where('statut', 'Accordé')->where('nature', 2)->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($mss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_mss, $liste);
                }

            }


            $depot = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')
                ->get();

            $depots = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->whereYear('date',  $year)
                ->get();

            $depotss = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->whereBetween('date', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();


            $depot_p = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 1)
                ->get();

            $depot_ps = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 1)->whereYear('date',  $year)
                ->get();

            $depot_pss = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 1)->whereBetween('date', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();




            $depot_h = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Masculin')
                ->get();

            $depot_hs = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Masculin')->whereYear('date',  $year)
                ->get();

            $depot_hss = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Masculin')->whereBetween('date', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();


            $depot_f = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Féminin')
                ->get();

            $depot_fs = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Féminin')->whereYear('date',  $year)
                ->get();

            $depot_fss = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Féminin')->whereBetween('date', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();


            $depot_m = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 2)
                ->get();

            $depot_ms = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 2)->whereYear('date',  $year)
                ->get();

            $depot_mss = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 2)->whereBetween('date', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();



            $credit_r = [];
            $credit_rs = [];
            $credit_rss = [];

            $r = Credit::where('statut', 'Accordé')->where('date_fin','<', Carbon::now())->get();

            foreach ($r as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_r, $liste);
                }

            }


            $rs = Credit::where('statut', 'Accordé')->where('date_fin','<', Carbon::now())->whereYear('date_deblocage',  $year)->get();

            foreach ($rs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rs, $liste);
                }

            }

            $rss = Credit::where('statut', 'Accordé')->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rss, $liste);
                }

            }



            $credit_rp = [];
            $credit_rps = [];
            $credit_rpss = [];

            $rp = Credit::where('statut', 'Accordé')->where('nature', 1)->where('date_fin','<', Carbon::now())->get();

            foreach ($rp as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rp, $liste);
                }

            }


            $rps = Credit::where('statut', 'Accordé')->where('nature', 1)->where('date_fin','<', Carbon::now())->whereYear('date_deblocage',  $year)->get();

            foreach ($rps as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rps, $liste);
                }

            }

            $rpss = Credit::where('statut', 'Accordé')->where('nature', 1)->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rpss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rpss, $liste);
                }

            }


            $credit_rh = [];
            $credit_rhs = [];
            $credit_rhss = [];

            $rh = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->where('date_fin','<', Carbon::now())->get();

            foreach ($rh as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rh, $liste);
                }

            }


            $rhs = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->where('date_fin','<', Carbon::now())->whereYear('date_deblocage',  $year)->get();

            foreach ($rhs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rhs, $liste);
                }

            }

            $rhss = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rhss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rhss, $liste);
                }

            }


            $credit_rf = [];
            $credit_rfs = [];
            $credit_rfss = [];

            $rf = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->where('date_fin','<', Carbon::now())->get();

            foreach ($rf as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rf, $liste);
                }

            }


            $rfs = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->where('date_fin','<', Carbon::now())->whereYear('date_deblocage',  $year)->get();

            foreach ($rfs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rfs, $liste);
                }

            }

            $rfss = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rfss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rfss, $liste);
                }

            }


            $credit_rm = [];
            $credit_rms = [];
            $credit_rmss = [];

            $rm = Credit::where('statut', 'Accordé')->where('nature', 2)->where('date_fin','<', Carbon::now())->get();

            foreach ($rm as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rm, $liste);
                }

            }


            $rms = Credit::where('statut', 'Accordé')->where('nature', 2)->where('date_fin','<', Carbon::now())->whereYear('date_deblocage',  $year)->get();

            foreach ($rms as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rms, $liste);
                }

            }

            $rmss = Credit::where('statut', 'Accordé')->where('nature', 2)->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rmss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rmss, $liste);
                }

            }

            $montant = [];
            $montants = [];
            $montantss = [];


            $m = Credit::where('statut', 'Accordé')->get();

            foreach ($m as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($montant, $liste);
                }

            }

            $ms = Credit::where('statut', 'Accordé')->whereYear('date_deblocage',  $year)->get();

            foreach ($ms as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($montants, $liste);
                }

            }

            $mss = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($mss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($montantss, $liste);
                }

            }

        }elseif($trimestre == 'TRIMESTRE 2'){

            $date_debut = Carbon::create($year, 4, 1, 0);
            $date_fin = Carbon::create($year, 6, 30, 0);
            $t_1 = Carbon::create($year, 4, 1, 0)->subday(1);

            $clients = Client::get();

            $clientss = Client::whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $clientsss = Client::whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $physiques = Client::where('type_compte_id', 1)->get();

            $physiquess = Client::where('type_compte_id', 1)->whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $physiquesss = Client::where('type_compte_id', 1)->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();



            $hommes = Client::where('sexe', 'masculin')->get();

            $hommess = Client::where('sexe', 'masculin')->whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $hommesss = Client::where('sexe', 'masculin')->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $femmes = Client::where('sexe', 'feminin')->get();

            $femmess = Client::where('sexe', 'feminin')->whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $femmesss = Client::where('sexe', 'feminin')->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $morales = Client::where('type_compte_id', 2)->get();

            $moraless = Client::where('type_compte_id', 2)->whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $moralesss = Client::where('type_compte_id', 2)->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $ca = User::where('role_id', 1)->get();

            $cas = User::where('role_id', 1)->whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $cass = User::where('role_id', 1)->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $surveillant = User::where('role_id', 6)->get();

            $surveillants = User::where('role_id', 6)->whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $surveillantss = User::where('role_id', 6)->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $employe = User::get();

            $employes = User::whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $employess = User::whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $agent = User::where('role_id', 2)->get();

            $agents = User::where('role_id', 2)->whereBetween('created_at', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $agentss = User::where('role_id', 2)->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $tool = new Tool();

            $credit = [];
            $credits = [];
            $creditss = [];

            $listes = Credit::where('statut', 'Accordé')->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit, $liste);
                }

            }


            $listess = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($listess as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }

            $listesss = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($listesss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($creditss, $liste);
                }

            }


            $credit_p = [];
            $credit_ps = [];
            $credit_pss = [];

            $p = Credit::where('statut', 'Accordé')->where('nature', 1)->get();

            foreach ($p as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_p, $liste);
                }

            }


            $ps = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($ps as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_ps, $liste);
                }

            }

            $pss = Credit::where('statut', 'Accordé')->where('nature', 1)->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($pss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_pss, $liste);
                }

            }


            $credit_h = [];
            $credit_hs = [];
            $credit_hss = [];

            $h = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->get();

            foreach ($h as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_h, $liste);
                }

            }


            $hs = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($hs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_hs, $liste);
                }

            }

            $hss = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($hss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_hss, $liste);
                }

            }


            $credit_f = [];
            $credit_fs = [];
            $credit_fss = [];

            $f = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->get();

            foreach ($f as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_f, $liste);
                }

            }


            $fs = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($fs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_fs, $liste);
                }

            }

            $fss = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($fss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_fss, $liste);
                }

            }

            $credit_m = [];
            $credit_ms = [];
            $credit_mss = [];

            $m = Credit::where('statut', 'Accordé')->where('nature', 2)->get();

            foreach ($m as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_m, $liste);
                }

            }


            $ms = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($ms as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_ms, $liste);
                }

            }

            $mss = Credit::where('statut', 'Accordé')->where('nature', 2)->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($mss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_mss, $liste);
                }

            }


            $depot = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')
                ->get();

            $depots = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->whereBetween('date', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $depotss = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->whereBetween('date', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();


            $depot_p = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 1)
                ->get();

            $depot_ps = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 1)->whereBetween('date', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $depot_pss = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 1)->whereBetween('date', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();


            $depot_h = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Masculin')
                ->get();

            $depot_hs = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Masculin')->whereBetween('date', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $depot_hss = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Masculin')->whereBetween('date', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();



            $depot_f = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Féminin')
                ->get();

            $depot_fs = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Féminin')->whereBetween('date', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $depot_fss = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Féminin')->whereBetween('date', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();


            $depot_m = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 2)
                ->get();

            $depot_ms = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 2)->whereBetween('date', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $depot_mss = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 2)->whereBetween('date', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();


            $credit_r = [];
            $credit_rs = [];
            $credit_rss = [];

            $r = Credit::where('statut', 'Accordé')->where('date_fin','<', Carbon::now())->get();

            foreach ($r as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_r, $liste);
                }

            }


            $rs = Credit::where('statut', 'Accordé')->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rs, $liste);
                }

            }

            $rss = Credit::where('statut', 'Accordé')->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rss, $liste);
                }

            }


            $credit_rp = [];
            $credit_rps = [];
            $credit_rpss = [];

            $rp = Credit::where('statut', 'Accordé')->where('nature', 1)->where('date_fin','<', Carbon::now())->get();

            foreach ($rp as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rp, $liste);
                }

            }


            $rps = Credit::where('statut', 'Accordé')->where('nature', 1)->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rps as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rps, $liste);
                }

            }

            $rpss = Credit::where('statut', 'Accordé')->where('nature', 1)->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rpss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rpss, $liste);
                }

            }


            $credit_rh = [];
            $credit_rhs = [];
            $credit_rhss = [];

            $rh = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->where('date_fin','<', Carbon::now())->get();

            foreach ($rh as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rh, $liste);
                }

            }


            $rhs = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rhs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rhs, $liste);
                }

            }

            $rhss = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rhss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rhss, $liste);
                }

            }


            $credit_rf = [];
            $credit_rfs = [];
            $credit_rfss = [];

            $rf = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->where('date_fin','<', Carbon::now())->get();

            foreach ($rf as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rf, $liste);
                }

            }


            $rfs = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rfs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rfs, $liste);
                }

            }

            $rfss = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rfss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rfss, $liste);
                }

            }

            $credit_rm = [];
            $credit_rms = [];
            $credit_rmss = [];

            $rm = Credit::where('statut', 'Accordé')->where('nature', 2)->where('date_fin','<', Carbon::now())->get();

            foreach ($rm as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rm, $liste);
                }

            }


            $rms = Credit::where('statut', 'Accordé')->where('nature', 2)->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rms as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rms, $liste);
                }

            }

            $rmss = Credit::where('statut', 'Accordé')->where('nature', 2)->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rmss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rmss, $liste);
                }

            }


            $montant = [];
            $montants = [];
            $montantss = [];


            $m = Credit::where('statut', 'Accordé')->get();

            foreach ($m as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($montant, $liste);
                }

            }

            $ms = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 4, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($ms as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($montants, $liste);
                }

            }

            $mss = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($mss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($montantss, $liste);
                }

            }




        }elseif($trimestre == 'TRIMESTRE 3'){
            $date_debut = Carbon::create($year, 7, 1, 0);
            $date_fin = Carbon::create($year, 9, 30, 0);
            $t_1 = Carbon::create($year, 7, 1, 0)->subday(1);

            $clients = Client::get();

            $clientss = Client::whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $clientsss = Client::whereBetween('created_at', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $physiques = Client::where('type_compte_id', 1)->get();

            $physiquess = Client::where('type_compte_id', 1)->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $physiquesss = Client::where('type_compte_id', 1)->whereBetween('created_at', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $hommes = Client::where('sexe', 'masculin')->get();

            $hommess = Client::where('sexe', 'masculin')->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $hommesss = Client::where('sexe', 'masculin')->whereBetween('created_at', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $femmes = Client::where('sexe', 'feminin')->get();

            $femmess = Client::where('sexe', 'feminin')->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $femmesss = Client::where('sexe', 'feminin')->whereBetween('created_at', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $morales = Client::where('type_compte_id', 2)->get();

            $moraless = Client::where('type_compte_id', 2)->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $moralesss = Client::where('type_compte_id', 2)->whereBetween('created_at', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();



            $ca = User::where('role_id', 1)->get();

            $cas = User::where('role_id', 1)->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $cass = User::where('role_id', 1)->whereBetween('created_at', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $surveillant = User::where('role_id', 6)->get();

            $surveillants = User::where('role_id', 6)->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $surveillantss = User::where('role_id', 6)->whereBetween('created_at', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $employe = User::get();

            $employes = User::whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $employess = User::whereBetween('created_at', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $agent = User::where('role_id', 2)->get();

            $agents = User::where('role_id', 2)->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            $agentss = User::where('role_id', 2)->whereBetween('created_at', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $tool = new Tool();

            $credit = [];
            $credits = [];
            $creditss = [];

            $listes = Credit::where('statut', 'Accordé')->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit, $liste);
                }

            }


            $listess = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($listess as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }

            $listesss = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($listesss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($creditss, $liste);
                }

            }


            $credit_p = [];
            $credit_ps = [];
            $credit_pss = [];

            $p = Credit::where('statut', 'Accordé')->where('nature', 1)->get();

            foreach ($p as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_p, $liste);
                }

            }


            $ps = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($ps as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_ps, $liste);
                }

            }

            $pss = Credit::where('statut', 'Accordé')->where('nature', 1)->whereBetween('date_deblocage', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($pss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_pss, $liste);
                }

            }


            $credit_h = [];
            $credit_hs = [];
            $credit_hss = [];

            $h = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->get();

            foreach ($h as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_h, $liste);
                }

            }


            $hs = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($hs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_hs, $liste);
                }

            }

            $hss = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->whereBetween('date_deblocage', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($hss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_hss, $liste);
                }

            }


            $credit_f = [];
            $credit_fs = [];
            $credit_fss = [];

            $f = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->get();

            foreach ($f as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_f, $liste);
                }

            }


            $fs = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($fs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_fs, $liste);
                }

            }

            $fss = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->whereBetween('date_deblocage', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($fss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_fss, $liste);
                }

            }

            $credit_m = [];
            $credit_ms = [];
            $credit_mss = [];

            $m = Credit::where('statut', 'Accordé')->where('type_id', 2)->get();

            foreach ($m as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_m, $liste);
                }

            }


            $ms = Credit::where('statut', 'Accordé')->where('type_id', 2)->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($ms as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_ms, $liste);
                }

            }

            $mss = Credit::where('statut', 'Accordé')->where('type_id', 2)->whereBetween('date_deblocage', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($mss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_mss, $liste);
                }

            }


            $depot = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')
                ->get();

            $depots = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->whereBetween('date', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $depotss = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->whereBetween('date', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();



            $depot_p = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 1)
                ->get();

            $depot_ps = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 1)->whereBetween('date', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $depot_pss = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 1)->whereBetween('date', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();


            $depot_h = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Masculin')
                ->get();

            $depot_hs = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Masculin')->whereBetween('date', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $depot_hss = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Masculin')->whereBetween('date', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $depot_f = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Féminin')
                ->get();

            $depot_fs = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Féminin')->whereBetween('date', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $depot_fss = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Féminin')->whereBetween('date', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $depot_m = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 2)
                ->get();

            $depot_ms = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 2)->whereBetween('date', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $depot_mss = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 2)->whereBetween('date', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();


            $credit_r = [];
            $credit_rs = [];
            $credit_rss = [];

            $r = Credit::where('statut', 'Accordé')->where('date_fin','<', Carbon::now())->get();

            foreach ($r as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_r, $liste);
                }

            }


            $rs = Credit::where('statut', 'Accordé')->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rs, $liste);
                }

            }

            $rss = Credit::where('statut', 'Accordé')->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rss, $liste);
                }

            }


            $credit_rp = [];
            $credit_rps = [];
            $credit_rpss = [];

            $rp = Credit::where('statut', 'Accordé')->where('nature', 1)->where('date_fin','<', Carbon::now())->get();

            foreach ($rp as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rp, $liste);
                }

            }


            $rps = Credit::where('statut', 'Accordé')->where('nature', 1)->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rps as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rps, $liste);
                }

            }

            $rpss = Credit::where('statut', 'Accordé')->where('nature', 1)->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rpss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rpss, $liste);
                }

            }

            $credit_rh = [];
            $credit_rhs = [];
            $credit_rhss = [];

            $rh = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->where('date_fin','<', Carbon::now())->get();

            foreach ($rh as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rh, $liste);
                }

            }


            $rhs = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rhs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rhs, $liste);
                }

            }

            $rhss = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rhss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rhss, $liste);
                }

            }

            $credit_rf = [];
            $credit_rfs = [];
            $credit_rfss = [];

            $rf = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->where('date_fin','<', Carbon::now())->get();

            foreach ($rf as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rf, $liste);
                }

            }


            $rfs = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rfs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rfs, $liste);
                }

            }

            $rfss = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rfss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rfss, $liste);
                }

            }

            $credit_rm = [];
            $credit_rms = [];
            $credit_rmss = [];

            $rm = Credit::where('statut', 'Accordé')->where('nature', 2)->where('date_fin','<', Carbon::now())->get();

            foreach ($rm as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rm, $liste);
                }

            }


            $rms = Credit::where('statut', 'Accordé')->where('nature', 2)->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rms as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rms, $liste);
                }

            }

            $rmss = Credit::where('statut', 'Accordé')->where('nature', 2)->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rmss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rmss, $liste);
                }

            }


            $montant = [];
            $montants = [];
            $montantss = [];


            $m = Credit::where('statut', 'Accordé')->get();

            foreach ($m as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($montant, $liste);
                }

            }

            $ms = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($ms as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($montants, $liste);
                }

            }

            $mss = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($mss as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($montantss, $liste);
                }

            }

        }elseif($trimestre == 'TRIMESTRE 4'){
            $date_debut = Carbon::create($year, 10, 1, 0);
            $date_fin = Carbon::create($year, 12, 31, 0);
            $t_1 = Carbon::create($year, 10, 1, 0)->subday(1);

            $clients = Client::get();

            $clientss = Client::whereBetween('created_at', [Carbon::create($year, 10, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $physiques = Client::where('type_compte_id', 1)->get();

            $physiquess = Client::where('type_compte_id', 1)->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $hommes = Client::where('sexe', 'masculin')->get();

            $hommess = Client::where('sexe', 'masculin')->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $femmes = Client::where('sexe', 'feminin')->get();

            $femmess = Client::where('sexe', 'feminin')->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $morales = Client::where('type_compte_id', 2)->get();

            $moraless = Client::where('type_compte_id', 2)->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $cas = User::where('role_id', 1)->get();

            $cass = User::where('role_id', 1)->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $surveillants = User::where('role_id', 6)->get();

            $surveillantss = User::where('role_id', 6)->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $employes = User::get();

            $employess = User::whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $agents = User::where('role_id', 2)->get();

            $agentss = User::where('role_id', 2)->whereBetween('created_at', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();


            $tool = new Tool();

            $credit = [];
            $credits = [];


            $listes = Credit::where('statut', 'Accordé')->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit, $liste);
                }

            }


            $listess = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($listess as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }


            $credit_p = [];
            $credit_ps = [];


            $p = Credit::where('statut', 'Accordé')->where('nature', 1)->get();

            foreach ($p as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_p, $liste);
                }

            }


            $ps = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($ps as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_ps, $liste);
                }

            }




            $credit_h = [];
            $credit_hs = [];


            $h = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->get();

            foreach ($h as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_h, $liste);
                }

            }


            $hs = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($hs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_hs, $liste);
                }

            }



            $credit_f = [];
            $credit_fs = [];

            $f = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->get();

            foreach ($f as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_f, $liste);
                }

            }


            $fs = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($fs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_fs, $liste);
                }

            }



            $credit_m = [];
            $credit_ms = [];


            $m = Credit::where('statut', 'Accordé')->where('nature', 2)->get();

            foreach ($m as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_m, $liste);
                }

            }


            $ms = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($ms as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_ms, $liste);
                }

            }


           $depot = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')
                ->get();

            $depots = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->whereBetween('date', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();


            $depot_p = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 1)
                ->get();

            $depot_ps = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 1)->whereBetween('date', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $depot_h = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Masculin')
                ->get();

            $depot_hs = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Masculin')->whereBetween('date', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $depot_f = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Féminin')
                ->get();

            $depot_fs = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('sexe', 'Féminin')->whereBetween('date', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $depot_m = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 2)
                ->get();

            $depot_ms = Depot::selectRaw(
                'client_id,

                 COUNT(*) as total')
                ->groupBy('client_id')->where('nature', 2)->whereBetween('date', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])
                ->get();

            $credit_r = [];
            $credit_rs = [];


            $r = Credit::where('statut', 'Accordé')->where('date_fin','<', Carbon::now())->get();

            foreach ($r as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_r, $liste);
                }

            }


            $rs = Credit::where('statut', 'Accordé')->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rs, $liste);
                }

            }


            $credit_rp = [];
            $credit_rps = [];


            $rp = Credit::where('statut', 'Accordé')->where('nature', 1)->where('date_fin','<', Carbon::now())->get();

            foreach ($rp as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rp, $liste);
                }

            }


            $rps = Credit::where('statut', 'Accordé')->where('nature', 1)->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rps as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rps, $liste);
                }

            }

            $credit_rh = [];
            $credit_rhs = [];

            $rh = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->where('date_fin','<', Carbon::now())->get();

            foreach ($rh as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rh, $liste);
                }

            }


            $rhs = Credit::where('statut', 'Accordé')->where('sexe', 'Masculin')->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rhs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rhs, $liste);
                }

            }

            $credit_rf = [];
            $credit_rfs = [];


            $rf = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->where('date_fin','<', Carbon::now())->get();

            foreach ($rf as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rf, $liste);
                }

            }


            $rfs = Credit::where('statut', 'Accordé')->where('sexe', 'Féminin')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rfs as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rfs, $liste);
                }

            }

            $credit_rm = [];
            $credit_rms = [];


            $rm = Credit::where('statut', 'Accordé')->where('nature', 2)->where('date_fin','<', Carbon::now())->get();

            foreach ($rm as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rm, $liste);
                }

            }


            $rms = Credit::where('statut', 'Accordé')->where('nature', 2)->where('date_fin','<', Carbon::now())->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($rms as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credit_rms, $liste);
                }

            }

            $montant = [];
            $montants = [];


            $m = Credit::where('statut', 'Accordé')->get();

            foreach ($m as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($montant, $liste);
                }

            }

            $ms = Credit::where('statut', 'Accordé')->whereBetween('date_deblocage', [Carbon::create($year, 7, 1, 0) , Carbon::create($year, 12, 31, 0)])->get();

            foreach ($ms as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($montants, $liste);
                }

            }




        }

        if($trimestre == 'TRIMESTRE 4'){
            return view('reporting.index', compact(
                'date_debut', 'date_fin',
                'clients','clientss',
                'physiques','physiquess',
                'morales','moraless',
                'hommes','hommess',
                'femmes','femmess',
                'cas','cass',
                'surveillants','surveillantss',
                'employes','employess',
                'agents','agentss',
                'credit','credits',
                'credit_p','credit_ps',
                'credit_h','credit_hs',
                'credit_f','credit_fs',
                'credit_m','credit_ms',
                'depot','depots',
                'depot_p','depot_ps',
                'depot_h','depot_hs',
                'depot_f','depot_fs',
                'depot_m','depot_ms',
                'credit_r','credit_rs',
                'credit_rp','credit_rps',
                'credit_rh','credit_rhs',
                'credit_rf','credit_rfs',
                'credit_rm','credit_rms',
                'montant','montants',
                'trimestre','t_1'
                ));
        }else{
             return view('reporting.index', compact(
                'date_debut', 'date_fin',
                'clients','clientss','clientsss',
                'physiques','physiquess','physiquesss',
                'morales','moraless','moralesss',
                'hommes','hommess','hommesss',
                'femmes','femmess','femmesss',
                'ca','cas','cass',
                'surveillant','surveillants','surveillantss',
                'employe','employes','employess',
                'agent','agents','agentss',
                'credit','credits','creditss',
                'credit_p','credit_ps','credit_pss',
                'credit_h','credit_hs','credit_hss',
                'credit_f','credit_fs','credit_fss',
                'credit_m','credit_ms','credit_mss',
                'depot','depots','depotss',
                'depot_p','depot_ps','depot_pss',
                'depot_h','depot_hs','depot_hss',
                'depot_f','depot_fs','depot_fss',
                'depot_m','depot_ms','depot_mss',
                'credit_r','credit_rs','credit_rss',
                'credit_rp','credit_rps','credit_rpss',
                'credit_rh','credit_rhs','credit_rhss',
                'credit_rf','credit_rfs','credit_rfss',
                'credit_rm','credit_rms','credit_rmss',
                'montant','montants','montantss',

                'trimestre','t_1','now'
                ));
        }


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
