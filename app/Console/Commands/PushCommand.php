<?php

namespace App\Console\Commands;

use App\Models\Credit;
use App\Models\Recouvrement;
use App\Notifications\PushNotif;
use App\Services\Tool;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PushCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:push_notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tool = new Tool();
        $carbon = new Carbon();

        $pr = 0;
        $ps = 0;

        $credits = Credit::where('statut', 'Accordé')->whereYear('created_at', date('Y'))->get();

        foreach($credits as $credit){

            // $enDate = $carbon->parse($credit->date_fin);
            $encours =  $tool->encours_actualiser($credit->id);

            $today = Carbon::today();

            if ($encours > 0){
                $recouv = Recouvrement::where('date', Carbon::today())->where('credit_id', $credit->id)->latest()->first();
                $recouvDate = $carbon->parse($recouv?->date);
                $diffInDays = $today->diffInDays($recouvDate);
                if($diffInDays >= 5){
                    $pr = $pr + 1;
                }

                if($diffInDays == 1){
                    $ps = $ps + 1;
                }

            }
        }

        $pr = new PushNotif(
            'Recouvrements en retards',
            'Il y a '. $pr. ' prêts en retards de 5 jours !'
        );

        $tool->pushNotif($tool->managerUsers(), $pr);

        $pr = new PushNotif(
            'Recouvrements en retards',
            'Il y a '. $ps. ' prêts en retards de 1 jours !'
        );

        $tool->pushNotif($tool->managerUsers(), $pr);

    }
}
