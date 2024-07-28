<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'marche_id',
        'filiere_id',
        'libelle',
    ];

    public function Marche()
    {
        return $this->belongsTo(Marche::class);
    }

    public function Filiere()
    {
        return $this->belongsTo(Filiere::class);
    }
}
