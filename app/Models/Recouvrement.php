<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recouvrement extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'user_id',
        'credit_id',
        'marche_id',
        'encours_actualise',
        'interet_jrs',
        'recouvrement_jrs',
        'epargne_jrs',
        'assurance',
    ];

    
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Credit()
    {
        return $this->belongsTo(Credit::class);
    }

    public function Marche()
    {
        return $this->belongsTo(Marche::class);
    }
}
