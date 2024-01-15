<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_compte_id',
        'user_id',
        'marche_id',
        'carte_id',
        'nom_prenom',
        'activite',
        'telephone',
        'adresse',
        'ville',
        'date_n',
        'lieu_n',
        'sexe',
        'image',
        'forme_juridique',
        'nif',
    ];
    
    public function Type_compte()
    {
        return $this->belongsTo(Type_compte::class);
    }

    
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Marche()
    {
        return $this->belongsTo(Marche::class);
    }

    public function Credit()
    {
        return $this->hasMany(Credit::class);
    }

    public function Depots()
    {
        return $this->hasMany(Depot::class);
    }
}
