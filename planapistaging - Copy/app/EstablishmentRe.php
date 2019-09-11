<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Establishment;
use Spatie\Activitylog\Traits\LogsActivity;


class EstablishmentRe extends Model
{
use LogsActivity;
	
	
    protected $fillable = [
        'sal','benefits','wages','machinery','office_exp','start_date','end_date'
    ];

    public function establishment() {
        return $this->belongsTo(Establishment::class);
    }
}
