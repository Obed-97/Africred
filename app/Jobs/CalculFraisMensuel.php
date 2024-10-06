<?php
namespace App\Jobs;

use App\Models\Depot;
use App\Models\FraisCompte;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Date;

class CalculFraisMensuel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Récupérer les dépôts et retraits par client
        $depotss = Depot::selectRaw(
            'client_id, SUM(depot) as depot, SUM(retrait) as retrait'
        )
        ->groupBy('client_id')
        ->get();

        // Boucle pour créer les frais de compte pour chaque client
        foreach ($depotss as $depot) {
            FraisCompte::create([
                'client_id' => $depot->client_id,
                'date' => Date::now(),
                'montant' => 500,
            ]);
        }
    }
}
