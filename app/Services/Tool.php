<?php

namespace App\Service;

use App\Models\Recouvrement;

class Tool {

    public function sum_encours_actualise($id)
    {
        $recouv = Recouvrement::find($id);

        return $recouv->sum('encours_actualise') ?? 0;
    }

    public function sum_recouvrement_jrs($id)
    {
        $recouv = Recouvrement::find($id);

        return $recouv->sum('recouvrement_jrs') ?? 0;
    }

    public function sum_epargne_jrs($id)
    {
        $recouv = Recouvrement::find($id);

        return $recouv->sum('epargne_jrs') ?? 0;
    }

    public function sum_assurance($id)
    {
        $recouv = Recouvrement::find($id);

        return $recouv->sum('assurance') ?? 0;
    }

    public function sum_interet_jrs($id)
    {
        $recouv = Recouvrement::find($id);

        return $recouv->sum('interet_jrs') ?? 0;
    }

    public function encours_actualiser($value)
    {
        $item = Recouvrement::find($value);

        if (intval($item->Credit->montant_interet) - (intval($this->sum_interet_jrs($item->id)) + intval($this->sum_recouvrement_jrs($item->id))) < 0)
        {
            //

        } elseif(intval($item->Credit->montant_interet) - (intval($this->sum_interet_jrs($item->id)) + intval($this->sum_recouvrement_jrs($item->id))) == 0) {
            //

        } else {
            
            //
        }
    }
}