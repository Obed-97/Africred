<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;

    protected $fillable = [
        'marche_id',
        'libelle',
        'description',
    ];

    public function Marche()
    {
        return $this->belongsTo(Marche::class);
    }

    public function Secteurs()
    {
        return $this->hasMany(Secteur::class);
    }
}
