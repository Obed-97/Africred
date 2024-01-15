<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\Tool;

use Carbon\Carbon;

class Credit extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'client_id',
        'user_id',
        'marche_id',
        'nature',
        'sexe',
        'montant',
        'date_deblocage',
        'date_fin',
        'nbre_jrs',
        'interet',
        'frais_deblocage',
        'frais_carte',
        'montant_interet',
        'montant_par_jour',
        'capital_par_jour',
        'interet_par_jour',
        'epargne_par_jour',
        'statut',
        'motif',
        'n_montant',
        'date_r',
        'n_delai',
        'date_fin_r',
        'motif_r',
        'reecheloner',
        
    ];
    
    
    public function Type()
    {
        return $this->belongsTo(Type::class);
    }


    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Client()
    {
        return $this->belongsTo(Client::class);
    }

    public function Recouvrement()
    {
        return $this->hasMany(Recouvrement::class);
    }
    
    public function Reecheloner()
    {
        return $this->hasMany(Reecheloner::class);
    }

    public function totalRecouv()
    {
        return $this->hasMany(Recouvrement::class)->sum('recouvrement_jrs');
    }
    
    public function totalIntreret()
    {
        return $this->hasMany(Recouvrement::class)->sum('interet_jrs');
    }
    
    public function totalEpargne()
    {
        return $this->hasMany(Recouvrement::class)->sum('epargne_jrs');
    }
    
    public function totalAssurance()
    {
        return $this->hasMany(Recouvrement::class)->sum('assurance');
    }
    
    public function totalRetrait()
    {
        return $this->hasMany(Recouvrement::class)->sum('retrait');
    }

    public function Recouv()
    {
        return $this->hasMany(Recouvrement::class)->whereDate('date', Carbon::now())->sum('recouvrement_jrs');
    }
    
    public function Intreret()
    {
        return $this->hasMany(Recouvrement::class)->whereDate('date', Carbon::now())->sum('interet_jrs');
    }
    
    public function Epargne()
    {
        return $this->hasMany(Recouvrement::class)->whereDate('date', Carbon::now())->sum('epargne_jrs');
    }
    
    public function encours($montant_interet)
    {
       $e = ($montant_interet - ($this->hasMany(Recouvrement::class)->sum('recouvrement_jrs') + $this->hasMany(Recouvrement::class)->sum('interet_jrs')));

       return intval($e);
    }

    public function solde($montant_credit)
    {
       $s = ($montant_credit - $this->hasMany(Recouvrement::class)->sum('recouvrement_jrs'));

       return intval($s);
    }

    public function prevision($montant_par_jour)
    {
       $p = ($montant_par_jour - ($this->hasMany(Recouvrement::class)->whereDate('date', Carbon::now())->sum('recouvrement_jrs') + $this->hasMany(Recouvrement::class)->whereDate('date', Carbon::now())->sum('interet_jrs')));

       return intval($p);
    }

    public function renouvellement($client_id)
    {
        $credits = Credit::where('client_id', $client_id)->count();
        
        return $credits;
    }
    
    public function rotation($client_id)
    {
        $credits = Credit::where('client_id', $client_id)->whereYear('date_deblocage', date('Y'))->count();
        
        return $credits;
    }

    public function Marche()
    {
        return $this->belongsTo(Marche::class);
    }
    
    public function montantParJour()
    {
        $tool = new Tool();

        $total = 1;

        $credits = Credit::where('user_id', $this->montant_par_jour)->get();

        foreach ($credits as $key => $credit) {
            if ($tool->encours_actualiser($credit->id) > 0){
                
                $total = intval($credit->montant_par_jour) + $total;
            }
        }

        return $total;
        
    } 
    
    public function getEpargne($item)
    {
        $epargnes = Recouvrement::where('credit_id', $item)->get();

        $frais_epargne = 0;

        foreach($epargnes as $epargne){

            $frais_epargne = $epargne->epargne_jrs + $frais_epargne ;

        }
        
         $retrait = 0;
        
        foreach($epargnes as $epargne){

            $retrait = $epargne->retrait + $retrait ;

        }
        
        

        return ($frais_epargne - $retrait);
    }

}
