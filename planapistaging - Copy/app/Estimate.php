<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scheme;
use App\BudgetEstimate;
use App\RevisedEstimate;
use Spatie\Activitylog\Traits\LogsActivity;

class Estimate extends Model
{
use LogsActivity;
    

	protected $fillable = [
        'start_date','end_date'
    ];

     public function scheme() {
        return $this->belongsTo(Scheme::class);
    }
    public function budgetEstimates() {
        return $this->hasMany(BudgetEstimate::class);
    }
    public function revisedEstimates() {
        return $this->hasMany(RevisedEstimate::class);
    }
}
