<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recouvrement;
use App\Models\Credit;
use App\Models\Marche;
use App\Models\User;
use Carbon\Carbon;
use App\Services\Tool;

class EtatRecouvrementController extends Controller
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
            $listes = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::today())->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        } else {
            $listes = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        }


        $recouvrements = null;

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $recouvrements = Recouvrement::selectRaw(
               'user_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('user_id')->whereDate('date', Carbon::today())
            ->get();

          }else {
            $recouvrements = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')->whereDate('date', Carbon::today())
            ->where('user_id', auth()->user()->id)->get();


          }

          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $hier = Recouvrement::selectRaw(
               'user_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('user_id')->whereDate('date', Carbon::yesterday())
            ->get();

          }else {
            $hier = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')->whereDate('date', Carbon::now()->subDays(2))
            ->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $avant_hier = Recouvrement::selectRaw(
               'user_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('user_id')->whereDate('date', Carbon::now()->subDays(2))
            ->get();

          }else {
            $avant_hier = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')->whereDate('date', Carbon::yesterday())
            ->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $j_3 = Recouvrement::selectRaw(
               'user_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('user_id')->whereDate('date', Carbon::now()->subDays(3))
            ->get();

          }else {
            $j_3 = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')->whereDate('date', Carbon::now()->subDays(3))
            ->where('user_id', auth()->user()->id)->get();
          }

          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $j_4 = Recouvrement::selectRaw(
               'user_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('user_id')->whereDate('date', Carbon::now()->subDays(4))
            ->get();

          }else {
            $j_4 = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')->whereDate('date', Carbon::now()->subDays(4))
            ->where('user_id', auth()->user()->id)->get();
          }
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $j_5 = Recouvrement::selectRaw(
               'user_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('user_id')->whereDate('date', Carbon::now()->subDays(5))
            ->get();

          }else {
            $j_5 = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')->whereDate('date', Carbon::now()->subDays(5))
            ->where('user_id', auth()->user()->id)->get();
          }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $j_6 = Recouvrement::selectRaw(
               'user_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('user_id')->whereDate('date', Carbon::now()->subDays(6))
            ->get();

          }else {
            $j_6 = Recouvrement::selectRaw(
            'credit_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('credit_id')->whereDate('date', Carbon::now()->subDays(6))
            ->where('user_id', auth()->user()->id)->get();
          }



          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $par_marche = Recouvrement::selectRaw(
               'marche_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('marche_id')->whereDate('date', Carbon::today())
            ->get();

          }else {
            $par_marche = Recouvrement::selectRaw(
            'marche_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs,
                SUM(retrait) as retrait')
            ->groupBy('marche_id')->whereDate('date', Carbon::today())
            ->where('user_id', auth()->user()->id)->get();
          }






        $credit_j = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->whereDate('date_deblocage', Carbon::today())->get();

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $credits_hier = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::yesterday())->get();
        } else {
            $credits_hier = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->whereDate('date_deblocage', Carbon::yesterday())->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $credits_j_2 = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::now()->subDays(2))->get();
        } else {
            $credits_j_2 = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->whereDate('date_deblocage', Carbon::now()->subDays(2))->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $credits_j_3 = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::now()->subDays(3))->get();
        } else {
            $credits_j_3 = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->whereDate('date_deblocage', Carbon::now()->subDays(3))->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $credits_j_4 = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::now()->subDays(4))->get();
        } else {
            $credits_j_4 = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->whereDate('date_deblocage', Carbon::now()->subDays(4))->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $credits_j_5 = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::now()->subDays(5))->get();
        } else {
            $credits_j_5 = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->whereDate('date_deblocage', Carbon::now()->subDays(5))->get();
        }
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $credits_j_6 = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::now()->subDays(6))->get();
        } else {
            $credits_j_6 = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->whereDate('date_deblocage', Carbon::now()->subDays(6))->get();
        }

        $marches = Marche::get();
        $agents = User::where('role_id', '2')->get();

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $total = Recouvrement::whereDate('date', Carbon::today())->get();
        } else {
            $total = Recouvrement::whereDate('date', Carbon::today())->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $total_hier = Recouvrement::whereDate('date', Carbon::yesterday())->get();
        } else {
            $total_hier = Recouvrement::whereDate('date', Carbon::yesterday())->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $total_j_2 = Recouvrement::whereDate('date', Carbon::now()->subDays(2))->get();
        } else {
            $total_j_2 = Recouvrement::whereDate('date', Carbon::now()->subDays(2))->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $total_j_3 = Recouvrement::whereDate('date', Carbon::now()->subDays(3))->get();
        } else {
            $total_j_3 = Recouvrement::whereDate('date', Carbon::now()->subDays(3))->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $total_j_4 = Recouvrement::whereDate('date', Carbon::now()->subDays(4))->get();
        } else {
            $total_j_4 = Recouvrement::whereDate('date', Carbon::now()->subDays(4))->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $total_j_5 = Recouvrement::whereDate('date', Carbon::now()->subDays(5))->get();
        } else {
            $total_j_5 = Recouvrement::whereDate('date', Carbon::now()->subDays(5))->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $total_j_6 = Recouvrement::whereDate('date', Carbon::now()->subDays(6))->get();
        } else {
            $total_j_6 = Recouvrement::whereDate('date', Carbon::now()->subDays(6))->where('user_id', auth()->user()->id)->get();
        }

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $epargnes = Credit::where('statut', 'Accordé')->get();
        } else {
            $epargnes = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();

        }


        return view('recouvrement.jour', compact('epargnes','j_6','total_j_6','credits_j_6','j_5','total_j_5','credits_j_5','j_4','total_j_4','credits_j_4','j_3','total_j_3','credits_j_3','credits','credit_j','hier','total_hier','total_j_2','credits_hier','credits_j_2','avant_hier','recouvrements','total','marches','agents','par_marche'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recouvrements = null;


          if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $par_marche = Recouvrement::selectRaw(
               'marche_id,
                SUM(encours_actualise) as encours_actualise,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('marche_id')->whereDate('date', Carbon::today())
            ->get();

          }else {
            $par_marche = Recouvrement::selectRaw(
            'marche_id,
                SUM(recouvrement_jrs) as recouvrement_jrs,
                SUM(epargne_jrs) as epargne_jrs,
                SUM(assurance) as assurance,
                SUM(interet_jrs) as interet_jrs')
            ->groupBy('marche_id')->whereDate('date', Carbon::today())
            ->where('user_id', auth()->user()->id)->get();
          }


        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
           $credits = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::today())->get();
        } else {
           $credits = Credit::where('statut', 'Accordé')->whereDate('date_deblocage', Carbon::today())->where('user_id', auth()->user()->id)->get();
        }


        $marches = Marche::get();

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $total = Recouvrement::whereDate('date', Carbon::today())->get();
        } else {
            $total = Recouvrement::whereDate('date', Carbon::today())->where('user_id', auth()->user()->id)->get();
        }

        return view('recouvrement.marche_jr', compact('credits','total','marches','par_marche'));
    }

    public function affiche(Request $request)
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tool = new Tool();
        $credits = [];

        $results_marche = $request['marche_id'];

        $data_marche = explode('|', $results_marche);

        $results_agent = $request['user_id'];

        $data_agent = explode('|', $results_agent);



        $marche_id = $data_marche[0];
        $user_id = $data_agent[0];

        $marche_libelle = $data_marche[1];

        if(auth()->user()->role_id == 1){
            $agent_nom = $data_agent[1];
        }else{
            $agent_nom = auth()->user()->nom;
        }

        if (auth()->user()->role_id == 1) {
            $listes = Credit::where('statut', 'Accordé')->where('marche_id', $marche_id)->where('user_id', $user_id)->where('type_id', '1')->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        } else {
            $listes = Credit::where('statut', 'Accordé')->where('marche_id', $marche_id)->where('user_id', auth()->user()->id)->where('type_id', '1')->get();

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

            $total = Recouvrement::where('marche_id', $marche_id)->where('user_id', $user_id)->get();

        }else{

            $total = Recouvrement::where('marche_id', $marche_id)->where('user_id', auth()->user()->id)->get();

        }



        return view('recouvrement.filtre', compact('credits', 'marches','agents','marche_libelle','agent_nom','total'));
    }

    public function arrete_s()
    {
        $tool = new Tool();
        $credits = [];


        if (auth()->user()->role_id == 1) {
            $listes = Credit::where('statut', 'Accordé')->where('type_id', '2')->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        } else {
            $listes = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->where('type_id', '2')->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id);

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        }



        $marches = Marche::get();
        $agents = User::where('role_id', '2')->get();


        return view('recouvrement.arrete_sugu', compact('credits', 'marches','agents'));
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
