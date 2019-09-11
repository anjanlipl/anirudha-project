<?php

namespace App;

use App\Scheme;
use App\Department;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Unit extends Model
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

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function schemes() {
        return $this->hasMany(Scheme::class);
    }
}
