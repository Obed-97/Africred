<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_caisse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'caisse_id',
        'montant',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function caisses()
    {
        return $this->belongsToMany(Caisse::class);
    }
}
