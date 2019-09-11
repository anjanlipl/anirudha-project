<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use  App\Outputindicator;
use Spatie\Activitylog\Traits\LogsActivity;


class Baseline extends Model
{
use LogsActivity;
	
    protected $fillable = [
		'name', 'value', 'start_date', 'end_date'
    ];

    public function outputIndicator() {
        return $this->belongsTo(Outputindicator::class);
    } 
}
