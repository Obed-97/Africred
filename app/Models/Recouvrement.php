<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Carbon\Carbon;

class Recouvrement extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'user_id',
        'credit_id',
        'marche_id',
        'date',
        'encours_actualise',
        'interet_jrs',
        'recouvrement_jrs',
        'epargne_jrs',
        'assurance',
    ];

    
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Credit()
    {
        return $this->belongsTo(Credit::class);
    }
    
  
    public function getFraisDeblocage($item)
    {
        $credits = Credit::where('user_id', $item)->get();

        $frais_deblocage = 0;

        foreach($credits as $credit){

            $frais_deblocage = $credit->frais_deblocage + $frais_deblocage ;

        }

        return $frais_deblocage;
    }
    
    public function getFraisDeblocageDay($item)
    {
        $credits = Credit::where('user_id', $item)->whereDate('date_deblocage', Carbon::today())->get();

        $frais_deblocage = 0;

        foreach($credits as $credit){

            $frais_deblocage = $credit->frais_deblocage + $frais_deblocage ;

        }

        return $frais_deblocage;
    }
    
    public function DeblocageHier($item)
    {
        $credits = Credit::where('user_id', $item)->whereDate('date_deblocage', Carbon::yesterday())->get();

        $frais_deblocage = 0;

        foreach($credits as $credit){

            $frais_deblocage = $credit->frais_deblocage + $frais_deblocage ;

        }

        return $frais_deblocage;
    }
    
    public function DeblocageJ_2($item)
    {
        $credits = Credit::where('user_id', $item)->whereDate('date_deblocage', Carbon::now()->subDays(2))->get();

        $frais_deblocage = 0;

        foreach($credits as $credit){

            $frais_deblocage = $credit->frais_deblocage + $frais_deblocage ;

        }

        return $frais_deblocage;
    }

    public function getFraisCarte($item)
    {
        $credits = Credit::where('user_id', $item)->get();

        $frais_carte = 0;

        foreach($credits as $credit){

            $frais_carte = $credit->frais_carte + $frais_carte ;

        }

        return $frais_carte;
    }
    
    public function getFraisCarteDay($item)
    {
        $credits = Credit::where('user_id', $item)->whereDate('date_deblocage', Carbon::today())->get();

        $frais_carte = 0;

        foreach($credits as $credit){

            $frais_carte = $credit->frais_carte + $frais_carte ;

        }

        return $frais_carte;
    }
    
    public function CarteHier($item)
    {
        $credits = Credit::where('user_id', $item)->whereDate('date_deblocage', Carbon::yesterday())->get();

        $frais_carte = 0;

        foreach($credits as $credit){

            $frais_carte = $credit->frais_carte + $frais_carte ;

        }

        return $frais_carte;
    }
    
    public function CarteJ_2($item)
    {
        $credits = Credit::where('user_id', $item)->whereDate('date_deblocage', Carbon::now()->subDays(2))->get();

        $frais_carte = 0;

        foreach($credits as $credit){

            $frais_carte = $credit->frais_carte + $frais_carte ;

        }

        return $frais_carte;
    }
    
   
    
    public function Marche()
    {
        return $this->belongsTo(Marche::class);
    }
}
