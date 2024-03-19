<?php

namespace App\Services;

use App\Jobs\PushJob;
use App\Models\Recouvrement;
use App\Models\Credit;
use App\Models\User;
use App\Notifications\PushRecovery;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;

class Tool {


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
            if ($this->encours_actualiser($credit->id) > 0){
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
            if ($this->encours_actualiser($credit->id) > 0){
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
            if ($this->encours_actualiser($credit->id) > 0){
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
            if ($this->encours_actualiser($credit->id) > 0){
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
            if ($this->encours_actualiser($credit->id) > 0){
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
            if ($this->encours_actualiser($credit->id) > 0){
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

    public function managerUsers()
    {
        $users = User::where('role_id', 1)->get();

        return $users;
    }

    public function agentUsers()
    {
        $users = User::where('role_id', 2)->get();

        return $users;
    }

    public function pushNotif($users, $event)
    {
        PushJob::dispatch(Notification::send($users, $event));
        return 1;
    }
}
