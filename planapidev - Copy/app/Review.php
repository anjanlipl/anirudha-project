<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Achievement;
use App\Actionpoint;
use Spatie\Activitylog\Traits\LogsActivity;

class Review extends Model
{
use LogsActivity;
	
    protected $fillable = [
    'description'
    ];

    public function achievements() {
        return $this->belongsTo(Achievement::class);
    } 
    public function actionpoints() {
        return $this->hasMany(Actionpoint::class);
    }
}
