<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use  App\Outcomeindicator;
use Spatie\Activitylog\Traits\LogsActivity;


class OutcomeIndicatorObject extends Model
{
use LogsActivity;
	
	
    protected $fillable = [
		'value', 'latitude', 'longitude','ward', 'district','remark','outcomeindicator_id','vidhanshabha'
    ];

    public function indicator() {
        return $this->belongsTo(Outcomeindicator::class);
    }
}
