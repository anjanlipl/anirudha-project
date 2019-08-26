<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Outcometarget;
use App\OutcomeReview;
use Spatie\Activitylog\Traits\LogsActivity;

class OutcomeAchievement extends Model
{
use LogsActivity;
    
	
     protected $fillable = [
    'description', 'start_date', 'end_date', 'remarks'
    ];

    public function outcometarget() {
        return $this->belongsTo(Outcometarget::class);
    } 
    public function reviews() {
        return $this->hasMany(OutcomeReview::class);
    }
}
