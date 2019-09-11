<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scheme;
use Spatie\Activitylog\Traits\LogsActivity;

class Expenditure extends Model
{
use LogsActivity;
	
    protected $fillable = [
        'revenue','capital','loan','exp_year'
    ];

    public function scheme() {
        return $this->belongsTo(Scheme::class);
    }
}
