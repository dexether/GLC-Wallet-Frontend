<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOfflineWalletToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::table('settings')->insert([
            [

                'setting_key' => 'wallet_address_source',
                //0=offline, 1=online(block.io)
                'setting_value' => '1',

            ],
            [

                'setting_key' => 'account_accessed_notification',
                'setting_value' => '0'

            ],
            [

                'setting_key' => 'account_accessed_email_subject',
                'setting_value' => 'Account Accessed',
            ],
            [

                'setting_key' => 'account_accessed_email_template',
                'setting_value' => '<p>Dear {name}. Your account was accessed from {ip}</p>',
            ],
            [

                'setting_key' => 'enable_withdrawal_otp',
                'setting_value' => '0',
            ],
            [

                'setting_key' => 'enable_partial_order_fulfilment',
                'setting_value' => '0',
            ]
            ,
            [

                'setting_key' => 'site_online',
                'setting_value' => '1',
            ],
            [

                'setting_key' => 'enable_frontend',
                'setting_value' => '0',
            ],
            [

                'setting_key' => 'enable_coin_to_coin',
                'setting_value' => '0',
            ],
            [

                'setting_key' => 'order_expire_days',
                'setting_value' => '0',
            ]

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        App\Models\Setting::where('setting_key', 'wallet_address_source')
            ->delete();
        App\Models\Setting::where('setting_key', 'account_accessed_notification')
            ->delete();
        App\Models\Setting::where('setting_key', 'account_accessed_email_subject')
            ->delete();
        App\Models\Setting::where('setting_key', 'account_accessed_email_template')
            ->delete();
        App\Models\Setting::where('setting_key', 'enable_withdrawal_otp')
            ->delete();
        App\Models\Setting::where('setting_key', 'enable_partial_order_fulfilment')
            ->delete();
        App\Models\Setting::where('setting_key', 'site_online')
            ->delete();
        App\Models\Setting::where('setting_key', 'enable_frontend')
            ->delete();
        App\Models\Setting::where('setting_key', 'enable_coin_to_coin')
            ->delete();
        App\Models\Setting::where('setting_key', 'order_expire_days')
            ->delete();
    }
}
