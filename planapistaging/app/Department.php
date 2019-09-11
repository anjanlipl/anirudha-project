<?php

namespace App;

use App\Unit;
use App\Subsector;
use App\DepartAssign;
use App\Establishment;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Department extends Model
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

    public function subsector() {
        return $this->belongsTo(Subsector::class);
    }

    public function units() {
        return $this->hasMany(Unit::class);
    }
    public function departAssign() {
        return $this->hasMany(DepartAssign::class);
    }
     public function establishmentExpenditure() {
        return $this->hasMany(Establishment::class);
    }
}
