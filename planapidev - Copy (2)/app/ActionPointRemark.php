<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ActionPoint;
use Spatie\Activitylog\Traits\LogsActivity;

class ActionPointRemark extends Model
{
	use LogsActivity;

	protected $fillable = [
		'description','user_id'
    ];
    public function actionpoint() {
        return $this->belongsTo(ActionPoint::class);
    } 
}
