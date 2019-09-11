<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Outputtarget;
use App\Review;
use Spatie\Activitylog\Traits\LogsActivity;


class Achievement extends Model
{
use LogsActivity;

	
      protected $fillable = [
    	'description', 'start_date', 'end_date', 'remarks'
    ];

    public function outputtarget() {
        return $this->belongsTo(Outputtarget::class);
    } 
    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
