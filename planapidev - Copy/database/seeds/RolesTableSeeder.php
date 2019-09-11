<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'super-admin','guard_name'=>'web']);
        $role = Role::create(['name' => 'hod','guard_name'=>'web']);
        $role = Role::create(['name' => 'departmental-admin','guard_name'=>'web']);
       

        $role = Role::create(['name' => 'departmental-user','guard_name'=>'web']);

        $role = Role::create(['name' => 'gnctd-viewer','guard_name'=>'web']);

        $role = Role::create(['name' => 'departmental-viewer','guard_name'=>'web']);

        $role = Role::create(['name' => 'public-viewer','guard_name'=>'web']);

    }
}
