<?php

namespace App\Models;

use App\Services\Tool;
use Carbon\Carbon;
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
            'fData' => ReportingDataItem::where('reporting_items_id', $id)->whereBetween('date', [$tool->month()['firstFriday'], Carbon::parse($tool->month()['firstFriday'])->subDays(6)])->get(),
            'sData' => ReportingDataItem::where('reporting_items_id', $id)->whereBetween('date', [$tool->month()['secondFriday'], Carbon::parse($tool->month()['secondFriday'])->subDays(6)])->get(),
            'tData' => ReportingDataItem::where('reporting_items_id', $id)->whereBetween('date', [$tool->month()['thirdFriday'], Carbon::parse($tool->month()['thirdFriday'])->subDays(6)])->get(),
            'foData' => ReportingDataItem::where('reporting_items_id', $id)->whereBetween('date', [$tool->month()['fourthFriday'], Carbon::parse($tool->month()['fourthFriday'])->subDays(6)])->get(),
        ];

    }

    static public function getDataInvest($date)
    {
        $rps = ReportingItem::where('type', 'investissement')->get();

        $totalInvestPrevision = 0;
        $totalInvestRealisation = 0;

        foreach($rps as $rp){
            $totalInvestPrevision = ReportingDataItem::find($rp->id)->whereBetween('date', [$date, Carbon::parse($date)->subDays(6)])->get()->sum('pre');
            $totalInvestRealisation = ReportingDataItem::find($rp->id)->whereBetween('date', [$date, Carbon::parse($date)->subDays(6)])->get()->sum('rea');
        }

        return [
            'totalInvestPrevision' => $totalInvestPrevision,
            'totalInvestRealisation' => $totalInvestRealisation,
        ];

    }
}
