<?php

namespace App\Console\Commands;

use App\Models\Credit;
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

        $credits = Credit::where('statut', 'Accordé')->get();

        foreach($credits as $credit){

            $enDate = $carbon->parse($credit->date_fin);
            $encours =  $tool->encours_actualiser($credit->id);

            if ($encours > 0){
                if($enDate->isPast()){
                    $pr += 1;
                }
            }

            if ($encours == 0){
                $ps += 1;
            }

        }

        $pr = new PushNotif(
            'Prêts en retard',
            'Il y a '. $pr. ' prêts en retard !'
        );
        $tool->pushNotif($tool->managerUsers(), $pr);

        $pr = new PushNotif(
            'Prêts en solder',
            'Il y a '. $ps. ' prêts en solder !'
        );
        $tool->pushNotif($tool->managerUsers(), $pr);


    }
}
