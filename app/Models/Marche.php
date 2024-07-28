<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marche extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
    ];

    public function Client()
    {
        return $this->hasMany(Client::class);
    }

    public function Recouvrement()
    {
        return $this->hasMany(Recouvrement::class);
    }

    
    public function Credits()
    {
        return $this->hasMany(Credit::class);
    }

    public function Filieres()
    {
        return $this->hasMany(Filiere::class);
    }

    public function Secteurs()
    {
        return $this->hasMany(Secteur::class);
    }

    public function tous_filieres($marche_id)
    {
        $filieres = Filiere::where('marche_id', $marche_id)->get();

        return $filieres;
    }

    public function tous_clients($marche_id)
    {
        $clients = Client::where('marche_id', $marche_id)->count();
        
        return $clients;
    }

   
}
