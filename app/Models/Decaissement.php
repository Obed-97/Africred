<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decaissement extends Model
{
    use HasFactory;

    protected $fillable = [
        'micro_finance_id',
        'user_id',
        'date',
        'motif',
        'montant',
        'observation',
    ];

    public function Micro_finance()
    {
        return $this->belongsTo(Micro_finance::class);
    }
}
