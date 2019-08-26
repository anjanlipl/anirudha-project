<?php

namespace App;

use App\Subsector;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Sector extends Model
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

    public function subsectors() {
        return $this->hasMany(Subsector::class);
    }
}
