<?php

namespace App\Services;

use App\Jobs\PushJob;
use App\Models\Recouvrement;
use App\Models\Credit;
use App\Models\Marche;
use App\Models\Type;
use App\Models\User;
use App\Notifications\PushRecovery;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;

class Tool
{


    public function sum_montant_par_jour($id)
    {
        $item = Credit::find($id)->get();

        return $item->sum('montant_par_jour') ?? 0;
    }

    public function sum_frais_deblocage($id)
    {
        $item = Credit::find($id)->get();

        return $item->sum('frais_deblocage') ?? 0;
    }


    public function sum_encours_actualise($id)
    {
        $item = Recouvrement::where('credit_id', $id)->get();

        return $item->sum('encours_actualise') ?? 0;
    }

    public function sum_recouvrement_jrs($id)
    {
        $item = Recouvrement::where('credit_id', $id)->get();

        return $item->sum('recouvrement_jrs') ?? 0;
    }

    public function sum_epargne_jrs($id)
    {
        $item = Recouvrement::where('credit_id', $id)->get();

        return $item->sum('epargne_jrs') ?? 0;
    }

    public function sum_assurance($id)
    {
        $item = Recouvrement::where('credit_id', $id)->get();

        return $item->sum('assurance') ?? 0;
    }

    public function sum_interet_jrs($id)
    {
        $item = Recouvrement::where('credit_id', $id)->get();

        return $item->sum('interet_jrs') ?? 0;
    }

    public function encours_actualiser($id)
    {
        $item = Recouvrement::where('credit_id', $id)->first();

        $encours = abs(intval($item->Credit->montant_interet ?? 1000) - (intval($this->sum_interet_jrs($id)) + intval($this->sum_recouvrement_jrs($id))));

        return  $encours;
    }

    public function solde($id)
    {
        $item = Recouvrement::where('credit_id', $id)->first();

        $solde = abs(intval($item->Credit->montant ?? 1000) - (intval($this->sum_recouvrement_jrs($id))));

        return  $solde;
    }


    public function montantParJour($id)
    {
        $total = 0;
        $credits = Credit::where('user_id', $id)->get();
        foreach ($credits as $key => $credit) {
            if ($this->encours_actualiser($credit->id) > 0) {
                $total = intval($credit->montant_par_jour) + $total + $credit->epargne_par_jour;
            }
        }

        return $total;
    }

    public function montant($id)
    {
        $total = 0;
        $credits = Credit::where('user_id', $id)->get();
        foreach ($credits as $key => $credit) {
            if ($this->encours_actualiser($credit->id) > 0) {
                $total = intval($credit->montant) + $total;
            }
        }

        return $total;
    }
    public function interet($id)
    {
        $total = 0;
        $credits = Credit::where('user_id', $id)->get();
        foreach ($credits as $key => $credit) {
            if ($this->encours_actualiser($credit->id) > 0) {
                $total = intval($credit->interet) + $total;
            }
        }

        return $total;
    }

    public function montant_interet($id)
    {
        $total = 0;
        $credits = Credit::where('user_id', $id)->get();
        foreach ($credits as $key => $credit) {
            if ($this->encours_actualiser($credit->id) > 0) {
                $total = intval($credit->montant_interet) + $total;
            }
        }

        return $total;
    }

    public function frais_deblocage($id)
    {
        $total = 0;
        $credits = Credit::where('user_id', $id)->get();
        foreach ($credits as $key => $credit) {
            if ($this->encours_actualiser($credit->id) > 0) {
                $total = intval($credit->frais_deblocage) + $total;
            }
        }

        return $total;
    }

    public function frais_carte($id)
    {
        $total = 0;
        $credits = Credit::where('user_id', $id)->get();
        foreach ($credits as $key => $credit) {
            if ($this->encours_actualiser($credit->id) > 0) {
                $total = intval($credit->frais_carte) + $total;
            }
        }

        return $total;
    }

    public function getUser($user_id)
    {
        $user = User::find($user_id);

        return $user;
    }

    /**
     * Get the agent users.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection A collection of agent users.
     */
    public function managerUsers()
    {
        $users = User::where('role_id', 1)->get();

        return $users;
    }


    /**
     * Get the agent users.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection A collection of agent users.
     */

    public function agentUsers()
    {
        $users = User::where('role_id', 2)->get();

        return $users;
    }

    /**
     * Send push notification to the users.
     *
     * @param User $users
     * @param object $event
     *
     * @return int
     */
    public function pushNotif($users, $event)
    {
        // PushJob::dispatch(Notification::send($users, $event));
        Notification::send($users, $event);
        return 1;
    }

    /**
     * Get the current week's start and end dates.
     *
     * @return array An associative array containing the current week's start and end dates.
     */

    public function week()
    {
        return [
            'currentWeekStartDate' => Carbon::now()->startOfWeek(),
            'currentWeekEndDate' => Carbon::now()->endOfWeek(),
            'lastWeekStartDate' => Carbon::now()->startOfWeek()->subWeek(),
            'lastWeekEndDate' => Carbon::now()->endOfWeek()->subWeek(),
        ];
    }

    /**
     * Get the current month's first, second, third, and fourth Fridays.
     *
     * @return array An associative array containing the current month's first, second, third, and fourth Fridays.
     */

    public function month()
    {
        $firstDayOfMonth = Carbon::now()->firstOfMonth();
        $fridays = [];
        while (count($fridays) < 4) {
            if ($firstDayOfMonth->dayOfWeek === Carbon::FRIDAY) {
                $fridays[] = $firstDayOfMonth->copy();
            }
            $firstDayOfMonth->addDay();
        }

        return [
            'firstFriday' => $fridays[0],
            'secondFriday' => $fridays[1],
            'thirdFriday' => $fridays[2],
            'fourthFriday' => $fridays[3],
        ];
    }


    /**
     * Get the encours sans interet par marche.
     *
     * @param int $marche_id The ID of the marche.
     * @param string $startDate The start date of the week in Y-m-d format.
     * @param string $endDate The end date of the week in Y-m-d format.
     *
     * @return int The sum of recouvrement_jrs for the specified marche and date range.
     */
    public function encours_sans_interet_par_marche($marche_id, $startDate, $endDate)
    {
        $esipm = Recouvrement::where('marche_id', $marche_id)
            ->whereBetween('date', [$startDate, $endDate])->sum('recouvrement_jrs');

        return $esipm;
    }


    /**
     * Get the encours global par marche.
     *
     * @param int $marche_id The ID of the marche.
     * @param string $startDate The start date of the week in Y-m-d format.
     * @param string $endDate The end date of the week in Y-m-d format.
     *
     * @return int The sum of montant and interet for the specified marche and date range, minus the sum of recouvrement_jrs and interet_jrs.
     */
    public function encours_global_par_marche($marche_id, $startDate, $endDate)
    {
        $mc = Credit::where('marche_id', $marche_id)->first();
        $esipm = Recouvrement::where('marche_id', $marche_id)->whereBetween('date', [$startDate, $endDate])->get();

        return abs((($mc->montant ?? 0) + ($mc->interet ?? 0)) - (($esipm->sum('recouvrement_jrs') ?? 0) + ($esipm->sum('interet_jrs') ?? 0)));
    }


    /**
     * Get the encours sans epargne par marche.
     *
     * @param int $marche_id The ID of the marche.
     * @param string $startDate The start date of the week in Y-m-d format.
     * @param string $endDate The end date of the week in Y-m-d format.
     *
     * @return int The sum of montant and interet for the specified marche and date range, minus the sum of recouvrement_jrs and interet_jrs.
     */
    public function encours_sans_epargne_par_marche($marche_id, $startDate, $endDate)
    {
        $mc = Credit::where('marche_id', $marche_id)->first();
        $esipm = Recouvrement::where('marche_id', $marche_id)->whereBetween('date', [$startDate, $endDate])->get();

        $encoursGloba = abs((($mc->montant ?? 0) + ($mc->interet ?? 0)) - (($esipm->sum('recouvrement_jrs') ?? 0) + ($esipm->sum('interet_jrs') ?? 0)));

        $epargne = ($esipm->sum('recouvrement_jrs') ?? 0) + ($esipm->sum('interet_jrs') ?? 0);

        return $encoursGloba - $epargne;
    }

    /**
     * Get the net interest for a given date for a specific credit type and marche
     *
     * @param int $marche_id The ID of the marche
     * @param string $date The date in Y-m-d format
     * @return array An array containing the net interest, previsionnel, remboursement, and frais de deblocage
     */

    public function interet_net_nano($marche_id, $date)
    {
        $mc = Credit::where([
            ['type_id', 2],
            ['marche_id', $marche_id]
        ])->first();

        $esipm = Recouvrement::where('marche_id', $marche_id)->whereDate('date', $date)->get();

        $encoursGloba = abs((($mc->montant ?? 0) + ($mc->interet ?? 0)) - (($esipm->sum('recouvrement_jrs') ?? 0) + ($esipm->sum('interet_jrs') ?? 0)));

        $epargne = ($esipm->sum('recouvrement_jrs') ?? 0) + ($esipm->sum('interet_jrs') ?? 0);
        $inn = $encoursGloba - $epargne;
        $prev = (($encoursGloba * 0.2) / 60) * 30;
        $rea = ($encoursGloba * 0.2) / 30;
        return [
            'inn' => $inn,
            'prev' => $prev,
            'rea' => $rea,
            'fdeblo' => $esipm->sum('frais_deblocage') ?? 0
        ];
    }

    public function renta_by_type_marche($type_id, $startDate, $endDate)
    {
        $esipm = Recouvrement::where('type_id', $type_id)->whereDate('date', [$startDate, $endDate])->get();
        $fd = 0;
        $fc = 0;
        foreach($esipm as $esip){
            $fd += Credit::find($esip->credit_id)->frais_deblocage;
            $fc += Credit::find($esip->credit_id)->frais_carte;
        }

        $renta = ($esipm->sum('interet_jrs') ?? 0) + $fd + $fc;

        return $renta;
    }

    /**
     * Get the rentabilité by market for a specific date range.
     *
     * @param int $marche_id The ID of the marche.
     * @param string $startDate The start date of the week in Y-m-d format.
     * @param string $endDate The end date of the week in Y-m-d format.
     * @return float The rentabilité by market for the specified date range.
     */
    public function rentabli_by_market($marche_id, $startDate, $endDate)
    {
        $mc = Credit::where('marche_id', $marche_id)->first();
        $esipm = Recouvrement::where('marche_id', $marche_id)->whereBetween('date', [$startDate, $endDate])->get();
        $renta = ($esipm->sum('interet_jrs') ?? 0) + ($mc->frais_deblocage ?? 0) + ($mc->frais_carte ?? 0);

        return $renta;
    }


    /**
     * Get the name of the marche associated with the given marche_id.
     *
     * @param int $marche_id The ID of the marche.
     *
     * @return string The name of the marche.
     */
    public function getMarcheName($marche_id)
    {
        return Marche::find($marche_id)->libelle;
    }


    /**
     * Get the name of the type of credit associated with the given type_id.
     *
     * @param int $type_id The ID of the type of credit.
     *
     * @return string The name of the type of credit.
     */

    public function getTypeCreditName($type_id)
    {
        return Type::find($type_id)->libelle;
    }

    /**
     * Formats a number with thousands separator and adds " FCFA" at the end.
     *
     * @param float|int $value The number to be formatted.
     * @return string The formatted number with " FCFA" at the end.
     */
    public function numberFormat($value = 0)
    {
        return number_format($value, 0, ' ', ' ') . ' FCFA';
    }
}
