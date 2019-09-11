<?php

namespace App;

use App\Sector;
use App\Department;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Subsector extends Model
{
use LogsActivity;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','is_default'
    ];

    public function sector() {
        return $this->belongsTo(Sector::class);
    }

    public function departments() {
        return $this->hasMany(Department::class);
    }
}
