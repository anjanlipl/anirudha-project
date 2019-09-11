<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EstablishmentBe;
use App\EstablishmentExp;
use App\EstablishmentRe;
use App\Department;
use Spatie\Activitylog\Traits\LogsActivity;


class Establishment extends Model
{
use LogsActivity;

    
	 protected $fillable = [
       'depart_id'
    ];

	public function department() {
        return $this->belongsTo(Department::class);
    }
    public function establishmentBe() {
        return $this->hasMany(EstablishmentBe::class);
    }
    public function establishmentRe() {
        return $this->hasMany(EstablishmentRe::class);
    }
    public function establishmentExp() {
        return $this->hasMany(EstablishmentExp::class);
    }

}

