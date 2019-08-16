<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Outputtarget;
use App\Review;
use App\ActionUser;
use App\ActionPointRemark;
use Spatie\Activitylog\Traits\LogsActivity;

class Actionpoint extends Model
{
    use LogsActivity;

    protected $fillable = [
    'description','status_id','start_date','end_date'
    ];

    public function review() {
        return $this->belongsTo(Review::class);
    } 
    //  public function actionusers() {
    //     return $this->hasMany(ActionUser::class);
    // }

    public function actionRemarks() {
        return $this->hasMany(ActionPointRemark::class);
    }
}
