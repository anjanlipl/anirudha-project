<?php

namespace App;

use App\Output;
use App\Outcomeindicator;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Outcome extends Model
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

    public function output() {
        return $this->belongsTo(Output::class);
    }

    public function outcomeIndicators() {
        return $this->hasMany(Outcomeindicator::class);
    }
}
