<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use  App\Outputindicator;
use Spatie\Activitylog\Traits\LogsActivity;

class IndicatorObject extends Model
{
use LogsActivity;
	
    protected $fillable = [
		'value', 'latitude', 'longitude','ward', 'district','remark','vidhanshabha','outputindicator_id'
    ];

    public function indicator() {
        return $this->belongsTo(Outputindicator::class);
    }
}
