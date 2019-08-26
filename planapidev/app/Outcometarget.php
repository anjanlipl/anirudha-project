<?php

namespace App;

use App\Outcomeindicator;
use App\OutcomeAchievement;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Outcometarget extends Model
{
use LogsActivity;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'value', 'start_date', 'end_date','remark'
    ];

    public function outcomeIndicator() {
        return $this->belongsTo(Outcomeindicator::class);
    }
     public function outcomeAchievements() {
        return $this->hasMany(OutcomeAchievement::class);
    }
}
