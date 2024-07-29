<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Image;
use App\Models\User;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entreprises = null;

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6) {
          $entreprises = Client::where('type_compte_id', 2)->get();
        }else {
          $entreprises = Client::where('type_compte_id', 2)->where('user_id', auth()->user()->id)->get();
        }

        return view('entreprise.index', compact('entreprises'));
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
        $filename = 'avatar.png';

        if($request->hasFile('image')){

            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $location = '/htdocs/app.africa-africred.com/assets/images/'.$filename;
            Image::make($image)->save($location);
        }


        $client = new Client;

        $client->create([
            'type_compte_id'=>$request->type_compte_id,
            'nom_prenom'=>$request->nom_prenom,
            'activite'=>$request->activite,
            'telephone'=>$request->telephone,
            'adresse'=>$request->adresse,
            'forme_juridique'=>$request->forme_juridique,
            'ville'=>$request->ville,
            'date_n'=>$request->date_n,
            'lieu_n'=>$request->lieu_n,
            'nif'=>$request->nif,
            'user_id'=> auth()->user()->id,
            'image'=> $filename,
        ]);
        alert()->image('Compte ouvert!','Le compte a été ouvert avec succès!',asset('assets/images/approved.png'),'200','200');
        return redirect()->route('entreprise.index');
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
        $filename = 'avatar.png';

        if($request->hasFile('image')){

            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $location = '/htdocs/app.africa-africred.com/assets/images/'.$filename;
            Image::make($image)->save($location);
        }

        $client = Client::where('id', $id)->firstOrFail();

        $client->update([
            'type_compte_id'=>$request->type_compte_id,
            'nom_prenom'=>$request->nom_prenom,
            'activite'=>$request->activite,
            'telephone'=>$request->telephone,
            'adresse'=>$request->adresse,
            'forme_juridique'=>$request->forme_juridique,
            'ville'=>$request->ville,
            'date_n'=>$request->date_n,
            'lieu_n'=>$request->lieu_n,
            'nif'=>$request->nif,

            'image'=> $filename,

        ]);

        alert()->image('Mise à jour','Le compte a été mis à jour!',asset('assets/images/approved.png'),'200','200');
        return redirect()->route('entreprise.index');
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
        return redirect()->route('entreprise.index');
    }
}
