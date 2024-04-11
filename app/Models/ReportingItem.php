<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    static public function type()
    {
        return [
            [
                'name' => 'Produits',
                'type' => 'produit'
            ],
            [
                'name' => 'Charges',
                'type' => 'charge'
            ],
            [
                'name' => 'Encaissements',
                'type' => 'encaissement'
            ],
            [
                'name' => 'Decaissements',
                'type' => 'decaissement'
            ],
            [
                'name' => 'Assurances',
                'type' => 'assurance'
            ],
            [
                'name' => 'Investissements',
                'type' => 'investissement'
            ]
        ];
    }
}
