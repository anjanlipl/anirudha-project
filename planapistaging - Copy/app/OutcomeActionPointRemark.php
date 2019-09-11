<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OutcomeActionpoint;
use Spatie\Activitylog\Traits\LogsActivity;

class OutcomeActionPointRemark extends Model
{
use LogsActivity;
	
	
    protected $fillable = [
		'description','user_id'
    ];
    public function actionpoint() {
        return $this->belongsTo(OutcomeActionpoint::class);
    } 
}
