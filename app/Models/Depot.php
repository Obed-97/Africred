<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Depot extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'client_id',
        'type_depot_id',
        'nature',
        'sexe',
        'date',
        'depot',
        'retrait',
        'solde',

    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function depotId()
    {
        return $this->id;
    }

    public function Type_depot()
    {
        return $this->belongsTo(Type_depot::class);
    }

    public function Client()
    {
        return $this->belongsTo(Client::class);
    }
}
