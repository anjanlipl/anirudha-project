<?php

namespace App;

use App\Objective;
use App\Outputindicator;
use App\Outcomes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Output extends Model
{
use LogsActivity;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
    
    public function objective() {
        return $this->belongsTo(Objective::class);
    }

    public function outputIndicators() {
        return $this->hasMany(Outputindicator::class);
    }

    public function outcomes() {
        return $this->hasMany(Outcome::class);
    }
}
