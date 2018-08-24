<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $credentials = array(
            "email" => 'admin@webstudio.co.zw',
            "password" => 'admin123',
            "name" => 'Admin',
            "first_name" => 'Admin',
            "last_name" => 'Admin',
            "email_verified" => 1,
            "phone_verified" => 1,
            "documents_verified" => 1,
        );
        $user = \Cartalyst\Sentinel\Laravel\Facades\Sentinel::registerAndActivate($credentials);
        $role = \Cartalyst\Sentinel\Laravel\Facades\Sentinel::findRoleBySlug('admin');
        $role->users()->attach($user);

    }
}
