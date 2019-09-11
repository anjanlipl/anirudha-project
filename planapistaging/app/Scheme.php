<?php

namespace App;

use App\Objective;
use App\Unit;
// use App\Tag;
use App\BudgetEstimate;
use App\RevisedEstimate;
use App\Expenditure;
use App\Type;
use App\Tag;
use App\Estimate;
use App\SchemeAssign;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;



class Scheme extends Model
{
    
    use LogsActivity;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sno','name', 'budget', 'start_date', 'account_head', 'demand_no', 'end_date', 'tag_ids','code','scheme_monitoring_type_ids', 'remarks','latitude','longitude','is_capital','unit_id'
    ];

    public function unit() {
        return $this->belongsTo(Unit::class);
    }
    public function objectives() {
        return $this->hasMany(Objective::class);
    }
     public function schemeAssign() {
        return $this->hasMany(SchemeAssign::class);
    }
    
    public function estimates() {
        return $this->hasMany(Estimate::class);
    }/*
    public function revisedEstimates() {
        return $this->hasMany(RevisedEstimate::class);
    }*/
    public function expenditures() {
        return $this->hasMany(Expenditure::class);
    }
    public function type() {
        return $this->hasOne(Type::class);
    }
   
    /*public function output() {
        return $this->hasOne(Output::class);
    }

    public function outcome() {
        return $this->hasOne(Outcome::class);
    }*/
}
