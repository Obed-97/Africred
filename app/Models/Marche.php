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
}
