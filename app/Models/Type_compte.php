<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_compte extends Model
{
    use HasFactory;
    
     protected $fillable = [
        'libelle',
    ];
    
    public function Clients()
    {
        return $this->hasMany(Client::class);
    }
}
