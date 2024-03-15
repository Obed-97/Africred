<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Client;
use App\Models\Credit;
use App\Models\User;
use App\Models\Transfert;
use Carbon\Carbon;
use View;
use Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct()
    {
        
        // $this->comptes = Client::all();
        // $this->attentes = Credit::where('statut', 'En attente')->get();
        // $this->deblocages = Credit::where('statut', 'Accordé')->get();
        // $this->transferts = Transfert::where('statut', 'En cours..')->get();
        
        // $this->time = Carbon::now();
        

        // View::Share('comptes', $this->comptes);
        // View::Share('attentes', $this->attentes);
        // View::Share('deblocages', $this->deblocages);
        // View::Share('transferts', $this->transferts);
        
        // View::Share('time', $this->time);
    }
}
