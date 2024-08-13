<?php

namespace App\View\Components;

use App\Models\Credit;
use App\Models\Marche;
use App\Models\Type;
use App\Services\Tool;
use Illuminate\View\Component;

class ReportingComponent extends Component
{

    public $com1, $com2, $com3, $com4, $com5, $com6, $com7, $com8, $com9, $com10, $com11, $com12, $com13, $com14, $com15;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
     $com1, $com2, $com3, $com4, $com5, $com6, $com7, $com8, $com9, $com10, $com11, $com12, $com13, $com14, $com15
    )
    {
        $this->com1 = $com1;
        $this->com2 = $com2;
        $this->com3 = $com3;
        $this->com4 = $com4;
        $this->com5 = $com5;
        $this->com6 = $com6;
        $this->com7 = $com7;
        $this->com8 = $com8;
        $this->com9 = $com9;
        $this->com10 = $com10;
        $this->com11 = $com11;
        $this->com12 = $com12;
        $this->com13 = $com13;
        $this->com14 = $com14;
        $this->com15 = $com15;

    }

    //esi
    //currentWeek
    public function currentWeekCreditByMarket()
    {
        $tool = new Tool();

        $week = $tool->week();

        $currentDataCreditByMarkets = Credit::selectRaw(
            'marche_id,
             SUM(montant) as montant'
        )
            ->groupBy('marche_id')
            ->where('statut', 'Accordé')
            ->whereBetween('created_at', [
                $week['currentWeekStartDate'],
                $week['currentWeekEndDate']
            ])->get();

        return $currentDataCreditByMarkets;
    }

    public function lastWeekCreditByMarket()
    {
        $tool = new Tool();

        $week = $tool->week();

        $lastDataCreditByMarkets = Credit::selectRaw(
            'marche_id,
             SUM(montant) as montant'
        )
            ->groupBy('marche_id')
            ->where('statut', 'Accordé')
            ->whereBetween('created_at', [
                $week['lastWeekStartDate'],
                $week['lastWeekEndDate']
            ])->get();

        return $lastDataCreditByMarkets;
    }

    public function lastTotalWeekTypeCredit()
    {
        $tool = new Tool();

        $week = $tool->week();

        $lastDataCreditByMarkets = Credit::selectRaw(
            'type_id,
             SUM(montant) as montant',
        )
            ->groupBy('type_id')
            ->where('statut', 'Accordé')
            ->whereBetween('created_at', [
                $week['lastWeekStartDate'],
                $week['lastWeekEndDate']
            ])->get();

        return $lastDataCreditByMarkets;
    }


    public function currentTotalWeekTypeCredit()
    {
        $tool = new Tool();

        $week = $tool->week();

        $currentDataCreditByMarkets = Credit::selectRaw(
            'type_id,
             SUM(montant) as montant',
        )
            ->groupBy('type_id')
            ->where('statut', 'Accordé')
            ->whereBetween('created_at', [
                $week['currentWeekStartDate'],
                $week['currentWeekEndDate']
            ])->get();

        return $currentDataCreditByMarkets;
    }

    //eglobal

    public function market()
    {
        $markets = Marche::get();

        return $markets;
    }

    public function month()
    {
        $tool = new Tool();

        $day = $tool->month();

        return $day;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // dd($this->lastTotalWeekTypeCredit());
        return view('components.reporting-component', [
            'currentWeekCredits' => $this->currentWeekCreditByMarket(),
            'lastWeekCredits' => $this->lastWeekCreditByMarket(),
            'currentTotalWeekTypeCredits' => $this->currentTotalWeekTypeCredit(),
            'lastTotalWeekTypeCredits' => $this->lastTotalWeekTypeCredit(),
            'markets' => $this->market(),
            'day' => $this->month(),
            'marketTypes' => Type::get(),
            'coom1' => $this->com1,
            'coom2' => $this->com2,
            'coom3' => $this->com3,
            'coom4' => $this->com4,
            'coom5' => $this->com5,
            'coom6' => $this->com6,
            'coom7' => $this->com7,
            'coom8' => $this->com8,
            'coom9' => $this->com9,
            'coom10' => $this->com10,
            'coom11' => $this->com11,
            'coom12' => $this->com12,
            'coom13' => $this->com13,
            'coom14' => $this->com14,
            'coom15' => $this->com15,
        ]);
    }
}
