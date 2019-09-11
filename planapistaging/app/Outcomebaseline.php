<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use  App\Outcomeindicator;
use Spatie\Activitylog\Traits\LogsActivity;

class Outcomebaseline extends Model
{
use LogsActivity;
	
    protected $fillable = [
		'name', 'value', 'start_date', 'end_date'
    ];

    public function outcomeIndicator() {
        return $this->belongsTo(Outcomeindicator::class);
    } 
}
