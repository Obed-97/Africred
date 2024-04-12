<?php

namespace App\Models;

use App\Services\Tool;
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

    static public function getDataItem($id)
    {
        $tool = new Tool();

        return [
            'fData' => ReportingDataItem::where('id', $id)->whereDate('date', $tool->month()['firstFriday'])->get(),
            'sData' => ReportingDataItem::where('id', $id)->whereDate('date', $tool->month()['secondFriday'])->get(),
            'tData' => ReportingDataItem::where('id', $id)->whereDate('date', $tool->month()['thirdFriday'])->get(),
            'foData' => ReportingDataItem::where('id', $id)->whereDate('date', $tool->month()['fourthFriday'])->get(),
        ];

    }
}
