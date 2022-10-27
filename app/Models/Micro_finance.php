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
}
