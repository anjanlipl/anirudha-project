<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ActionUser;
use App\OutcomeReview;
use App\OutcomeActionPointRemark;
use Spatie\Activitylog\Traits\LogsActivity;

class OutcomeActionpoint extends Model
{
use LogsActivity;
    
    
    protected $fillable = [
    'description','status_id','start_date','end_date'
    ];

    public function review() {
        return $this->belongsTo(OutcomeReview::class);
    } 
    public function actionRemarks() {
        return $this->hasMany(OutcomeActionPointRemark::class);
    }
    // public function actionusers() {
    //     return $this->hasMany(ActionUser::class);
    // }
}
