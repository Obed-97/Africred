<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Carbon\Carbon;

class Recouvrement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'credit_id',
        'marche_id',
        'type_id',
        'date',
        'encours_actualise',
        'interet_jrs',
        'recouvrement_jrs',
        'epargne_jrs',
        'assurance',
        'retrait',
    ];


    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Credit()
    {
        return $this->belongsTo(Credit::class);
    }



    public function getFraisDeblocageCredit($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('id', $item)->get();

        $frais_deblocage = 0;

        foreach($credits as $credit){

            $frais_deblocage = $credit->frais_deblocage + $frais_deblocage ;

        }

        return $frais_deblocage;
    }

    public function getFraisDeblocageMarche($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('marche_id', $item)->get();

        $frais_deblocage = 0;

        foreach($credits as $credit){

            $frais_deblocage = $credit->frais_deblocage + $frais_deblocage ;

        }

        return $frais_deblocage;
    }


    public function getFraisDeblocage($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->get();

        $frais_deblocage = 0;

        foreach($credits as $credit){

            $frais_deblocage = $credit->frais_deblocage + $frais_deblocage ;

        }

        return $frais_deblocage;
    }

    public function getFraisDeblocageDayMarche($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('marche_id', $item)->whereDate('date_deblocage', Carbon::today())->get();

        $frais_deblocage = 0;

        foreach($credits as $credit){

            $frais_deblocage = $credit->frais_deblocage + $frais_deblocage ;

        }

        return $frais_deblocage;
    }


    public function getFraisDeblocageDay($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->whereDate('date_deblocage', Carbon::today())->get();

        $frais_deblocage = 0;

        foreach($credits as $credit){

            $frais_deblocage = $credit->frais_deblocage + $frais_deblocage ;

        }

        return $frais_deblocage;
    }

    public function DeblocageHier($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->whereDate('date_deblocage', Carbon::yesterday())->get();

        $frais_deblocage = 0;

        foreach($credits as $credit){

            $frais_deblocage = $credit->frais_deblocage + $frais_deblocage ;

        }

        return $frais_deblocage;
    }

    public function DeblocageJ_2($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->whereDate('date_deblocage', Carbon::now()->subDays(2))->get();

        $frais_deblocage = 0;

        foreach($credits as $credit){

            $frais_deblocage = $credit->frais_deblocage + $frais_deblocage ;

        }

        return $frais_deblocage;
    }

    public function DeblocageJ_3($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->whereDate('date_deblocage', Carbon::now()->subDays(3))->get();

        $frais_deblocage = 0;

        foreach($credits as $credit){

            $frais_deblocage = $credit->frais_deblocage + $frais_deblocage ;

        }

        return $frais_deblocage;
    }

    public function DeblocageJ_4($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->whereDate('date_deblocage', Carbon::now()->subDays(4))->get();

        $frais_deblocage = 0;

        foreach($credits as $credit){

            $frais_deblocage = $credit->frais_deblocage + $frais_deblocage ;

        }

        return $frais_deblocage;
    }

    public function DeblocageJ_5($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->whereDate('date_deblocage', Carbon::now()->subDays(5))->get();

        $frais_deblocage = 0;

        foreach($credits as $credit){

            $frais_deblocage = $credit->frais_deblocage + $frais_deblocage ;

        }

        return $frais_deblocage;
    }

    public function DeblocageJ_6($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->whereDate('date_deblocage', Carbon::now()->subDays(6))->get();

        $frais_deblocage = 0;

        foreach($credits as $credit){

            $frais_deblocage = $credit->frais_deblocage + $frais_deblocage ;

        }

        return $frais_deblocage;
    }

    public function getFraisCarteCredit($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('id', $item)->get();

        $frais_carte = 0;

        foreach($credits as $credit){

            $frais_carte = $credit->frais_carte + $frais_carte ;

        }

        return $frais_carte;
    }

    public function getFraisCarteMarche($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('marche_id', $item)->get();

        $frais_carte = 0;

        foreach($credits as $credit){

            $frais_carte = $credit->frais_carte + $frais_carte ;

        }

        return $frais_carte;
    }

    public function getFraisCarte($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->get();

        $frais_carte = 0;

        foreach($credits as $credit){

            $frais_carte = $credit->frais_carte + $frais_carte ;

        }

        return $frais_carte;
    }

    public function getFraisCarteDayMarche($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('marche_id', $item)->whereDate('date_deblocage', Carbon::today())->get();

        $frais_carte = 0;

        foreach($credits as $credit){

            $frais_carte = $credit->frais_carte + $frais_carte ;

        }

        return $frais_carte;
    }

    public function getFraisCarteDay($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->whereDate('date_deblocage', Carbon::today())->get();

        $frais_carte = 0;

        foreach($credits as $credit){

            $frais_carte = $credit->frais_carte + $frais_carte ;

        }

        return $frais_carte;
    }

    public function CarteHier($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->whereDate('date_deblocage', Carbon::yesterday())->get();

        $frais_carte = 0;

        foreach($credits as $credit){

            $frais_carte = $credit->frais_carte + $frais_carte ;

        }

        return $frais_carte;
    }

    public function CarteJ_2($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->whereDate('date_deblocage', Carbon::now()->subDays(2))->get();

        $frais_carte = 0;

        foreach($credits as $credit){

            $frais_carte = $credit->frais_carte + $frais_carte ;

        }

        return $frais_carte;
    }
    public function CarteJ_3($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->whereDate('date_deblocage', Carbon::now()->subDays(3))->get();

        $frais_carte = 0;

        foreach($credits as $credit){

            $frais_carte = $credit->frais_carte + $frais_carte ;

        }

        return $frais_carte;
    }

    public function CarteJ_4($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->whereDate('date_deblocage', Carbon::now()->subDays(4))->get();

        $frais_carte = 0;

        foreach($credits as $credit){

            $frais_carte = $credit->frais_carte + $frais_carte ;

        }

        return $frais_carte;
    }

    public function CarteJ_5($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->whereDate('date_deblocage', Carbon::now()->subDays(5))->get();

        $frais_carte = 0;

        foreach($credits as $credit){

            $frais_carte = $credit->frais_carte + $frais_carte ;

        }

        return $frais_carte;
    }

    public function CarteJ_6($item)
    {
        $credits = Credit::where('statut', 'Accordé')->where('user_id', $item)->whereDate('date_deblocage', Carbon::now()->subDays(6))->get();

        $frais_carte = 0;

        foreach($credits as $credit){

            $frais_carte = $credit->frais_carte + $frais_carte ;

        }

        return $frais_carte;
    }

    public function encours($marche_id, $dd)
    {
        $dd = Carbon::parse($dd);

        $credits = Credit::where('statut', 'Accordé')->where('marche_id', $marche_id)->get();

        $ti = Recouvrement::whereDate('date', '<=', $dd)->where('marche_id', $marche_id)->sum('interet_jrs');
        $tr = Recouvrement::whereDate('date', '<=', $dd)->where('marche_id', $marche_id)->sum('recouvrement_jrs');

        $tir = $ti + $tr;

        $result = ($credits->sum('interet') + $credits->sum('montant')) - $tir;
        return number_format(($result), 0, ',', ' '). ' FCFA';
    }

    public function encoursClient($credit_id, $dd)
    {
        $dd = Carbon::parse($dd);

        $credits = Credit::where('statut', 'Accordé')->where('id', $credit_id)->first();

        $ti = Recouvrement::whereDate('date', '<=', $dd)->where('credit_id', $credit_id)->sum('interet_jrs') ?? 0;
        $tr = Recouvrement::whereDate('date', '<=', $dd)->where('credit_id', $credit_id)->sum('recouvrement_jrs') ?? 0;

        $tir = $ti + $tr;

        $result = (($credits->interet ?? 0) + ($credits->montant ?? 00)) - $tir;
        return number_format(($result), 0, ',', ' '). ' FCFA';
    }

    public function Client($credit_id)
    {
        $credit = Credit::find($credit_id);

        return $credit->Client['nom_prenom'] ?? '';
    }



    public function Marche()
    {
        return $this->belongsTo(Marche::class);
    }
}
