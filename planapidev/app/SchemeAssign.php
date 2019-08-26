<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scheme;
use Spatie\Activitylog\Traits\LogsActivity;


class SchemeAssign extends Model
{
use LogsActivity;

	protected $fillable = [
        'user_id','scheme_id'
    ];
    
     public function scheme() {
        return $this->belongsTo(Scheme::class);
    }
}
