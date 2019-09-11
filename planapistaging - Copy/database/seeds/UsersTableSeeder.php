<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Technical Admin',
            'email' => 'admin@lipl.in',
            'password' => Hash::make('lipl#123'),
        ]);
                $user->assignRole('admin');
    }
}
