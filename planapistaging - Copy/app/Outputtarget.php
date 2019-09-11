<?php

namespace App;

use App\Outputindicator;
use Illuminate\Database\Eloquent\Model;
use App\Achievement;
use App\Review;
use App\Actionpoint;
use Spatie\Activitylog\Traits\LogsActivity;

class Outputtarget extends Model
{
use LogsActivity;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name','value', 'start_date', 'end_date','remark'
    ];

    public function outputIndicator() {
        return $this->belongsTo(Outputindicator::class);
    } 
     public function achievements() {
        return $this->hasMany(Achievement::class);
    }
     
}
