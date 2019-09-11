<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;
use Spatie\Activitylog\Traits\LogsActivity;

class DepartAssign extends Model
{
use LogsActivity;
    
	protected $fillable = [
        'user_id','dept_id'
    ];
    
     public function department() {
        return $this->belongsTo(Department::class);
    }
}
