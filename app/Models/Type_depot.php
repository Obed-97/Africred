<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_depot extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
    ];

    public function Depots()
    {
        return $this->hasMany(Depot::class);
    }

}
