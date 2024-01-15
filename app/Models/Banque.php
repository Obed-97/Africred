<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banque extends Model
{
    use HasFactory;

    protected $fillable = [
        'micro_finance_id',
        'user_id',
        'type',
        'date',
        'nom_banque',
        'montant',
        'motif',
    ];

    public function Micro_finance()
    {
        return $this->belongsTo(Micro_finance::class);
    }
}
