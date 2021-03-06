<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Estimate;
use Spatie\Activitylog\Traits\LogsActivity;


class RevisedEstimate extends Model
{
use LogsActivity;
	
     protected $fillable = [
        'revenue','capital','loan','start_date','end_date'
    ];

    public function estimate() {
        return $this->belongsTo(Estimate::class);
    }
}
