<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfert extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pays_e',
        'pays_d',
        'nom_e',
        'prenom_e',
        'tel_e',
        'email_e',
        'nom_d',
        'prenom_d',
        'tel_d',
        'email_d',
        'montant',
        'frais',
        'taf',
        'montant_p',
        'recepteur',
        'statut',

    ];
    
    public function pays()
    { 
        return $this->belongsToMany(Pays::class);
    }
    
    public function User()
    { 
        return $this->belongsTo(User::class);
    }
}
