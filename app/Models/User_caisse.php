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

    public function Users()
    {
        return $this->belongsTo(User::class);
    }

    public function Caisses()
    {
        return $this->belongsTo(Caisse::class);
    }
}
