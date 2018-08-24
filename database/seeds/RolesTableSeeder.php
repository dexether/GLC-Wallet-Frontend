<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('roles')->insert([
            [

                'slug' => 'admin',
                'name' => 'Admin',
                'permissions' => '{"reports":true,"communication":true,"communication.create":true,"communication.delete":true,"custom_fields":true,"custom_fields.view":true,"custom_fields.create":true,"custom_fields.update":true,"custom_fields.delete":true,"users":true,"users.view":true,"users.create":true,"users.update":true,"users.delete":true,"users.roles":true,"settings":true,"audit_trail":true,"currencies":true,"currencies.view":true,"currencies.create":true,"currencies.update":true,"currencies.delete":true,"withdrawals":true,"withdrawals.view":true,"withdrawals.create":true,"withdrawals.update":true,"withdrawals.delete":true,"deposits":true,"deposits.view":true,"deposits.create":true,"deposits.update":true,"deposits.delete":true}'
            ],
            [

                'slug' => 'client',
                'name' => 'Client',
                'permissions' => '{}'
            ]
        ]);
    }
}
