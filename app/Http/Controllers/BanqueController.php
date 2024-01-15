<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banque;
use App\Models\Micro_finance;
use Carbon\Carbon;
use Alert;

class BanqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $micros = Micro_finance::all();

        $banques = Banque::where('motif','!=','Solde')->orderBy('date','DESC')->get();

        $depots = Banque::where('type','Dépôt')->get();
        $retraits = Banque::where('type','Rétrait')->get();
        
        $depots_j = Banque::where('type','Dépôt')->where('date', Carbon::today())->get();
        $retraits_j = Banque::where('type','Rétrait')->where('date', Carbon::today())->get();
        
        $ecobank_d = Banque::where('type','Dépôt')->where('nom_banque','ECOBANK')->get();
        $ecobank_r = Banque::where('type','Rétrait')->where('nom_banque','ECOBANK')->get();
        
        $bicim_d = Banque::where('type','Dépôt')->where('nom_banque','BICIM')->get();
        $bicim_r = Banque::where('type','Rétrait')->where('nom_banque','BICIM')->get();
        
        $uba_d = Banque::where('type','Dépôt')->where('nom_banque','UBA')->get();
        $uba_r = Banque::where('type','Rétrait')->where('nom_banque','UBA')->get();
        
        $bdm_d = Banque::where('type','Dépôt')->where('nom_banque','BDM')->get();
        $bdm_r = Banque::where('type','Rétrait')->where('nom_banque','BDM')->get();
        
        $bnda_d = Banque::where('type','Dépôt')->where('nom_banque','BNDA')->get();
        $bnda_r = Banque::where('type','Rétrait')->where('nom_banque','BNDA')->get();

        return view('banque.index',compact('micros','banques','depots','retraits','depots_j','retraits_j','ecobank_d','ecobank_r','bicim_d','bicim_r','uba_d','uba_r','bdm_d','bdm_r','bnda_d','bnda_r'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $micros = Micro_finance::all();

        $banques = Banque::where('motif','!=','Solde')->where('date', Carbon::today())->get();

        $depots = Banque::where('type','Dépôt')->get();
        $retraits = Banque::where('type','Rétrait')->get();
        
        $depots_j = Banque::where('type','Dépôt')->where('date', Carbon::today())->get();
        $retraits_j = Banque::where('type','Rétrait')->where('date', Carbon::today())->get();
        
        $ecobank_d = Banque::where('type','Dépôt')->where('nom_banque','ECOBANK')->get();
        $ecobank_r = Banque::where('type','Rétrait')->where('nom_banque','ECOBANK')->get();
        
        $bicim_d = Banque::where('type','Dépôt')->where('nom_banque','BICIM')->get();
        $bicim_r = Banque::where('type','Rétrait')->where('nom_banque','BICIM')->get();
        
        $uba_d = Banque::where('type','Dépôt')->where('nom_banque','UBA')->get();
        $uba_r = Banque::where('type','Rétrait')->where('nom_banque','UBA')->get();
        
        $bdm_d = Banque::where('type','Dépôt')->where('nom_banque','BDM')->get();
        $bdm_r = Banque::where('type','Rétrait')->where('nom_banque','BDM')->get();
        
        $bnda_d = Banque::where('type','Dépôt')->where('nom_banque','BNDA')->get();
        $bnda_r = Banque::where('type','Rétrait')->where('nom_banque','BNDA')->get();

        return view('banque.jour',compact('micros','banques','depots','retraits','depots_j','retraits_j','ecobank_d','ecobank_r','bicim_d','bicim_r','uba_d','uba_r','bdm_d','bdm_r','bnda_d','bnda_r'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banque = new Banque;
          
        $banque->create([
            'micro_finance_id'=>$request->micro_finance_id,
            'user_id'=>auth()->user()->id,
            'date'=>$request->date,
            'nom_banque'=>$request->nom_banque,
            'montant'=>$request->montant,
            'type'=>$request->type,
            'motif'=>$request->motif,
        ]);
        
       
        alert()->image('Enregistré!','La transaction est enregistrée!','/assets/images/accept.png','100','100');

        return redirect()->route('banque.index');
    }
    
    public function date(Request $request)
    {
        $micros = Micro_finance::all();
        
        $date_j = $request->fdate;

        $banques = Banque::where('motif','!=','Solde')->where('date', $request->fdate)->get();

        $depots = Banque::where('type','Dépôt')->get();
        $retraits = Banque::where('type','Rétrait')->get();
        
        $depots_j = Banque::where('type','Dépôt')->where('date', $request->fdate)->get();
        $retraits_j = Banque::where('type','Rétrait')->where('date', $request->fdate)->get();
        
        $ecobank_d = Banque::where('type','Dépôt')->where('nom_banque','ECOBANK')->get();
        $ecobank_r = Banque::where('type','Rétrait')->where('nom_banque','ECOBANK')->get();
        
        $bicim_d = Banque::where('type','Dépôt')->where('nom_banque','BICIM')->get();
        $bicim_r = Banque::where('type','Rétrait')->where('nom_banque','BICIM')->get();
        
        $uba_d = Banque::where('type','Dépôt')->where('nom_banque','UBA')->get();
        $uba_r = Banque::where('type','Rétrait')->where('nom_banque','UBA')->get();
        
        $bdm_d = Banque::where('type','Dépôt')->where('nom_banque','BDM')->get();
        $bdm_r = Banque::where('type','Rétrait')->where('nom_banque','BDM')->get();
        
        $bnda_d = Banque::where('type','Dépôt')->where('nom_banque','BNDA')->get();
        $bnda_r = Banque::where('type','Rétrait')->where('nom_banque','BNDA')->get();

        return view('banque.date',compact('date_j','micros','banques','depots','retraits','depots_j','retraits_j','ecobank_d','ecobank_r','bicim_d','bicim_r','uba_d','uba_r','bdm_d','bdm_r','bnda_d','bnda_r'));
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
        $micros = Micro_finance::all();

        $banque = Banque::where('id', $id)->firstOrFail();

        return view('banque.edit', compact('banque', 'micros'));
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
        $banque = Banque::where('id', $id)->firstOrFail();

        $banque->update([
            'micro_finance_id'=>$request->micro_finance_id,
            'user_id'=>auth()->user()->id,
            'date'=>$request->date,
            'nom_banque'=>$request->nom_banque,
            'montant'=>$request->montant,
            'type'=>$request->type,
            'motif'=>$request->motif,
        ]);

        return redirect()->route('banque.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banque = Banque::findOrFail($id);
        $banque->delete();

        return redirect()->route('banque.index');
    }
}
