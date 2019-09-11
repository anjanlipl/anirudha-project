<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use LogsActivity;

class Permission extends \Spatie\Permission\Models\Permission
{
use Spatie\Activitylog\Traits\LogsActivity;
    
}
