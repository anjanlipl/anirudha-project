<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class EstablishmentExp extends Model
{
use LogsActivity;
	
    protected $fillable = [
        'sal','benefits','wages','machinery','office_exp','exp_year'
    ];

    public function establishment() {
        return $this->belongsTo(Establishment::class);
    }
}
