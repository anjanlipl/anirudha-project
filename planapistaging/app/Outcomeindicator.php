<?php

namespace App;

use App\Outcome;
use App\Outcometarget;
use App\Outcomebaseline;
use Illuminate\Database\Eloquent\Model;
use App\OutcomeIndicatorObject;
use Spatie\Activitylog\Traits\LogsActivity;


class Outcomeindicator extends Model
{
use LogsActivity;
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status','unit_id','output_indicator_id','respond_to_criteria','remark'
    ];

    public function outcome() {
        return $this->belongsTo(Outcome::class);
    }

    public function outcomeTargets() {
        return $this->hasMany(Outcometarget::class);
    }
    public function outcomeBaselines() {
        return $this->hasMany(Outcomebaseline::class);
    }
    public function indicatorObjects() {
        return $this->hasMany(OutcomeIndicatorObject::class);
    }
}
