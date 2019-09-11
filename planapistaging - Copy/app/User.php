<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\CustomDashboard;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{


    use HasRoles, HasApiTokens, Notifiable,LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','department_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function customDashboards() {
        return $this->hasMany(CustomDashboard::class);
    }
}
