<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use Image;
use Auth;
use Hash;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index');
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
    public function update_password(Request $request)
    {
        $current_user = auth()->user();
        
        if(Hash::check($request->old_password, $current_user->password)){
            
            $current_user->update([
                
                'password'=> bcrypt($request->new_password)
                
                ]);
                
            alert()->image('Mot de passe!','Votre mot de passe a été modifié!','assets/images/accept.png','100','100');
                
            return redirect()->back();
            
        }else{
            alert::error('Erreur!','Mot de passe incorrect');
            return redirect()->back();
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
        
        $filename = auth()->user()->image;

        if($request->hasFile('image')){

            $image = $request->file('image');
            $filename = $image->getClientOriginalName();    
            $location = '/htdocs/app.africa-africred.com/assets/images/users/'.$filename;
            Image::make($image)->save($location);   
        }
        
        $profile = auth()->user();
        
        $profile->update([
            'nom'=>$request->nom,
            'sexe'=>$request->sexe,
            'email'=>$request->email,
            'telephone'=>$request->telephone,
            'adresse'=>$request->adresse,
            'date_n'=>$request->date_n,
            'lieu_n'=>$request->lieu_n,
            'ville'=>$request->ville,
            'image'=> $filename,
        ]);

        alert()->image('Informations mises à jour!','Vos données sont mises à jour!','assets/images/accept.png','100','100');

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
