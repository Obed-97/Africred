<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_caisses');
    }

    public function User_caisse()
    {
        return $this->belongsToMany(User_caisse::class);
    }
}
