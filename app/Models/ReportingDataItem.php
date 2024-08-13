<?php

namespace App\Models;

use App\Services\Tool;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportingDataItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'reporting_items_id',
        'date',
        'pre',
        'rea',
    ];

    public function getElementName(){
        return ReportingItem::find($this->reporting_items_id)->name;
    }

    public function getElementType(){
        return ReportingItem::find($this->reporting_items_id)->type;
    }

    public function getDate()
    {
        return Carbon::parse($this->date)->format('d/m/Y');
    }

    public function pre()
    {
        $tool = new Tool();
        return $tool->numberFormat($this->pre);
    }

    public function rea()
    {
        $tool = new Tool();
        return $tool->numberFormat($this->rea);
    }
}
