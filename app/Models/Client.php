<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'marche_id',
        'carte_id',
        'nom_prenom',
        'activite',
        'telephone',
    ];

    
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
}
