<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Filiere;
use App\Models\Marche;
use App\Models\Secteur;
use App\Models\User;
use Image;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marches = Marche::all();
        $filieres = Filiere::all();
        $secteurs = Secteur::all();
        $clients = null;

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
          $clients = Client::where('type_compte_id', 1)->get();
        }else {
          $clients = Client::where('type_compte_id', 1)->where('user_id', auth()->user()->id)->get();
        }
      

        return view('client.index', compact('clients', 'marches', 'filieres', 'secteurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marches = Marche::all();

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $clients = Client::selectRaw(
                'user_id,
                 COUNT(id) as id')
             ->groupBy('user_id')
             ->get();
        }else {
          $clients = Client::where('user_id', auth()->user()->id)->get();
        }
      

        return view('client.agent', compact('clients', 'marches'));
    }

    public function marche()
    {
        $marches = Marche::all();

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $clients = Client::selectRaw(
                'marche_id,
                 COUNT(id) as id')
             ->groupBy('marche_id')
             ->get();
        }else {
            $clients = Client::selectRaw(
                'marche_id,
                 COUNT(id) as id')
             ->groupBy('marche_id')->where('user_id', auth()->user()->id)
             ->get();
        }
      

        return view('client.marche', compact('clients', 'marches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filename = 'avatar.png';

        if($request->hasFile('image')){

            $image = $request->file('image');
            $filename = $image->getClientOriginalName();    
            $location = '/htdocs/app.africa-africred.com/assets/images/users/'.$filename;
            Image::make($image)->save($location);   
        }
        
        
        $client = new Client;
        
        $client->create([
            'nom_prenom'=>$request->nom_prenom,
            'activite'=>$request->activite,
            'telephone'=>$request->telephone,
            'adresse'=>$request->adresse,
            'marche_id'=>$request->marche_id,
            'filiere_id'=>$request->filiere_id,
            'secteur_id'=>$request->secteur_id,
            'ville'=>$request->ville,
            'date_n'=>$request->date_n,
            'lieu_n'=>$request->lieu_n,
            'sexe'=>$request->sexe,
            'user_id'=> auth()->user()->id,
            'image'=> $filename,
        ]);
        alert()->image('Compte ouvert!','Le compte a été ouvert avec succès!','assets/images/approved.png','200','200');
        return redirect()->route('etat_client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::where('id', $id)->firstOrFail();

        return view('client.carte', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marches = Marche::all();
        $users = User::where('role_id' , '2')->get();

        $client = Client::where('id', $id)->firstOrFail();

        return view('client.edit', compact('client','marches','users'));
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
        $filename = 'avatar.png';

        if($request->hasFile('image')){

            $image = $request->file('image');
            $filename = $image->getClientOriginalName();    
            $location = '/htdocs/app.africa-africred.com/assets/images/users/'.$filename;
            Image::make($image)->save($location);   
        }
        
        $client = Client::where('id', $id)->firstOrFail();
        
        $client->update([
            'nom_prenom'=>$request->nom_prenom,
            'activite'=>$request->activite,
            'telephone'=>$request->telephone,
            'adresse'=>$request->adresse,
            'marche_id'=>$request->marche_id,
            'ville'=>$request->ville,
            'date_n'=>$request->date_n,
            'lieu_n'=>$request->lieu_n,
            'sexe'=>$request->sexe,
            'image'=> $filename,
         
        ]);
        
        alert()->image('Mise à jour','Le compte a été mis à jour!','assets/images/approved.png','200','200');
        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $client = Client::findOrFail($request->client);
        $client->delete();
        alert()->image('Supprimée!','Le compte a été supprimé avec succès!','assets/images/recycle.png','150','150');
        return redirect()->route('client.index');
    }
    
    public function demande(Request $request)
    {
        $client_id = $request->client_id;
        
        $info = Client::where('id', $request->client_id)->first();
        
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $client = Client::get();
        }else {
            $client = Client::where('user_id', auth()->user()->id)->get();
        }
   

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $demande = Client::where('id', $request->client_id)->get();
        }else {
            $demande = Client::where('id', $request->client_id)->where('user_id', auth()->user()->id)->get();
        }

        return view('client.demande', compact('demande','client_id','info','client'));
    }

}
