<?php

namespace App\Models;

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
}
