<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'type_depot_id',
        'date',
        'depot',
        'retrait',
        'solde',
        
    ]; 

    public function User()
    {
        return $this->belongsTo(User::class);
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
