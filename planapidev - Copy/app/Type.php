<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scheme;
use Spatie\Activitylog\Traits\LogsActivity;

class Type extends Model
{
use LogsActivity;
	
    protected $fillable = [
        'type_variety_id','state_share','central_share'
    ];

    public function scheme() {
        return $this->belongsTo(Scheme::class);
    }
}
