<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'montant',
        'date_deblocage',
        'date_fin',
        'interet',
        'frais_deblocage',
        'frais_carte',
        'montant_interet'
    ];


    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Client()
    {
        return $this->belongsTo(Client::class);
    }

    public function Recouvrement()
    {
        return $this->hasMany(Recouvrement::class);
    }

    public function totalRecouv()
    {
        return $this->hasMany(Recouvrement::class)->sum('recouvrement_jrs');
    }
}
