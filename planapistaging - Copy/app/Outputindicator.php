<?php

namespace App;

use App\Output;
use App\Outputtarget;
use App\Baseline;
use Illuminate\Database\Eloquent\Model;
use App\IndicatorObject;
use Spatie\Activitylog\Traits\LogsActivity;

class Outputindicator extends Model
{
use LogsActivity;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status','unit_id','respond_to_criteria','remark'
    ];

    public function output() {
        return $this->belongsTo(Output::class);
    }

    public function outputTargets() {
        return $this->hasMany(Outputtarget::class);
    }
    public function baselines() {
        return $this->hasMany(Baseline::class);
    }
    public function indicatorObjects() {
        return $this->hasMany(IndicatorObject::class);
    }
}
