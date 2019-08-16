<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Role extends \Spatie\Permission\Models\Role
{
use LogsActivity;
	
    //
}
