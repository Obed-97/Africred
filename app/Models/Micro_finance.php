<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Micro_finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'pays_id',
        'libelle',
    ];

    public function Encaissement()
    {
        return $this->hasMany(Encaissement::class);
    }

    public function Decaissement()
    {
        return $this->hasMany(Decaissement::class);
    }
}
