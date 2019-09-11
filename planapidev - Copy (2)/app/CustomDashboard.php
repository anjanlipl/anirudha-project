<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Spatie\Activitylog\Traits\LogsActivity;


class CustomDashboard extends Model
{
use LogsActivity;
	
    protected $fillable = [
        'scheme_ids','name','user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
