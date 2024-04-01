<?php

namespace App\View\Components;

use App\Models\Credit;
use App\Services\Tool;
use Illuminate\View\Component;

class ReportingComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

    //eg

    public function currentTotalMarket()
    {

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
            'lastTotalWeekTypeCredits' => $this->lastTotalWeekTypeCredit()
        ]);
    }
}
