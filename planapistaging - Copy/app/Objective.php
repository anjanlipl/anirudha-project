<?php

namespace App;

use App\Output;
use App\Scheme;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Objective extends Model
{
use LogsActivity;

	protected $fillable = [
        'name','description','scheme_id'
    ];
    
    public function scheme() {
        return $this->belongsTo(Scheme::class);
    }
    public function outputs() {
        return $this->hasMany(Output::class);
    }

}
