<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ActionPoint;
use App\OutcomeActionpoint;
use Spatie\Activitylog\Traits\LogsActivity;

class ActionUser extends Model
{
    use LogsActivity;
	
    protected $fillable = [
		'user_id','action_type','actionpoint_id'
    ];

    // public function actionpoint() {
    //     return $this->belongsTo(ActionPoint::class);
    // } 
    // public function outcomeactionpoint() {
    //     return $this->belongsTo(OutcomeActionpoint::class);
    // } 
}
