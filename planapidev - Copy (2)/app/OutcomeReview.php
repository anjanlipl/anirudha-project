<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OutcomeAchievement;
use App\OutcomeActionpoint;
use Spatie\Activitylog\Traits\LogsActivity;

class OutcomeReview extends Model
{
use LogsActivity;
	
     protected $fillable = [
    'description'
    ];

    public function achievements() {
        return $this->belongsTo(OutcomeAchievement::class);
    } 
    public function actionpoints() {
        return $this->hasMany(OutcomeActionpoint::class);
    }
}
