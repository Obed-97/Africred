<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pays;
use App\Models\Transfert;
use App\Models\Taux;
use Alert;

class TransfertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role_id == 1){
            $transferts = Transfert::all(); 
        }else{
            $transferts = Transfert::where('pays_d', auth()->user()->pays['libelle'])->get();
        }
        
        $frais = Taux::where('libelle', 'Frais de transfert')->first();
        
        $taf = Taux::where('libelle', 'Taxe sur activités financières')->first();
        
        return view('transfert.index', compact('transferts','frais','taf'));
    }
    
    public function envois()
    {
        $transferts = Transfert::where('pays_e', auth()->user()->pays['libelle'])->where('user_id', auth()->user()->id)->get();
        
        $frais = Taux::where('libelle', 'Frais de transfert')->first();
        
        $taf = Taux::where('libelle', 'Taxe sur activités financières')->first();
        
        return view('transfert.envois', compact('transferts','frais','taf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pays_e = Pays::where('libelle', auth()->user()->pays['libelle'] )->get();
        
        $pays_d = Pays::where('libelle', '!=', auth()->user()->pays['libelle'] )->get();
        
        $frais = Taux::where('libelle', 'Frais de transfert')->first();
        
        $taf = Taux::where('libelle', 'Taxe sur activités financières')->first();

        
        return view('transfert.create', compact('pays_e','pays_d','frais','taf'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $transfert = new Transfert;
        
        $taux_frais = ($request->frais + 0) / 100;
        
        $taux_taf = ($request->taf + 0) / 100;
        
        $frais = ($request->montant + 0) * $taux_frais;
        
        $taf = $frais * $taux_taf;
        
        $montant_p = ($request->montant + 0) - $frais;
          
        $transfert->create([
            'user_id'=> auth()->user()->id,
            'pays_e'=>$request->pays_e,
            'pays_d'=>$request->pays_d,
            'nom_e'=>$request->nom_e,
            'prenom_e'=>$request->prenom_e,
            'tel_e'=>$request->tel_e,
            'email_e'=>$request->email_e,
            'nom_d'=>$request->nom_d,
            'prenom_d'=>$request->prenom_d,
            'tel_d'=>$request->tel_d,
            'email_d'=>$request->email_d,
            'montant'=>$request->montant,
            'frais'=>$frais,
            'taf'=>$taf,
            'montant_p'=>$montant_p,
        ]);

        alert()->image('Transfert effectué!','Le tranfert a été effectué!','assets/images/accept.png','100','100');
        
        return redirect()->route('transfert.envois');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transfert = Transfert::where('id', $id)->firstOrFail();
        
        $frais = Taux::where('libelle', 'Frais de transfert')->first();
        
        $taf = Taux::where('libelle', 'Taxe sur activités financières')->first();

        return view('transfert.show', compact('transfert','frais','taf'));
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
        $transfert = Transfert::where('id', $id)->firstOrFail();

        $statut = 'Terminé';
        

        $transfert->update([
            'recepteur'=>auth()->user()->nom,
            'statut'=>$statut,
        ]);

        alert()->image('Terminé!','Le tranfert est terminé!','/assets/images/accept.png','100','100');

        return redirect()->back();
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
