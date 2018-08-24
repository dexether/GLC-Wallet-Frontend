<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('settings')->insert([
            [
                'setting_key' => 'company_name',
                'setting_value' => 'Crypto Exchange',
            ],
            [
                'setting_key' => 'company_address',
                'setting_value' => 'Suite 608',
            ],
            [
                'setting_key' => 'company_currency',
                'setting_value' => 'ZAR',
            ],
            [
                'setting_key' => 'company_website',
                'setting_value' => 'http://www.webstudio.co.zw',
            ],
            [
                'setting_key' => 'company_country',
                'setting_value' => '1',
            ],
            [
                'setting_key' => 'system_version',
                'setting_value' => '1.0',
            ],
            [
                'setting_key' => 'sms_enabled',
                'setting_value' => '1',
            ],
            [
                'setting_key' => 'active_sms',
                'setting_value' => '1',
            ],
            [
                'setting_key' => 'portal_address',
                'setting_value' => 'http://www.',
            ],
            [
                'setting_key' => 'company_email',
                'setting_value' => 'info@webstudio.co.zw',
            ],
            [
                'setting_key' => 'currency_symbol',
                'setting_value' => '$',
            ],
            [
                'setting_key' => 'currency_position',
                'setting_value' => 'left',
            ],
            [
                'setting_key' => 'company_logo',
                'setting_value' => 'logo.jpg',
            ],
            [
                'setting_key' => 'phone_verify',
                'setting_value' => '0',
            ],
            [
                'setting_key' => 'email_verify',
                'setting_value' => '1',
            ],
            [
                'setting_key' => 'documents_verify',
                'setting_value' => '1',
            ],
            [
                'setting_key' => 'auto_email_activation',
                'setting_value' => '1',
            ],
            [
                'setting_key' => 'referral_commission',
                'setting_value' => '0',
            ],
            [
                'setting_key' => 'minimum_payout',
                'setting_value' => '100',
            ],
            [
                'setting_key' => 'cancel_withdrawal',
                'setting_value' => '1',
            ],
            [
                'setting_key' => 'notify_withdrawal_request',
                'setting_value' => '1',
            ],
            [
                'setting_key' => 'notify_exchange_complete',
                'setting_value' => '1',
            ],
            [
                'setting_key' => 'custom_header_javascript',
                'setting_value' => '',
            ],
            [
                'setting_key' => 'custom_footer_javascript',
                'setting_value' => '',
            ],
            [
                'setting_key' => 'enable_google_recaptcha',
                'setting_value' => '0',
            ],
            [
                'setting_key' => 'google_recaptcha_site_key',
                'setting_value' => '',
            ],
            [
                'setting_key' => 'google_recaptcha_secret_key',
                'setting_value' => '',
            ],
            [
                'setting_key' => 'password_reset_subject',
                'setting_value' => 'Password reset instructions',
            ],
            [
                'setting_key' => 'password_reset_template',
                'setting_value' => 'Dear {name}, you have requested to change password.Click <a href="{resetLink}">here</a> to reset your password. If link does not work, paste this link in your browser: {resetLink} ',
            ],
            [
                'setting_key' => 'new_account_subject',
                'setting_value' => 'New Account Information',
            ],
            [
                'setting_key' => 'new_account_template',
                'setting_value' => 'Thank you for creating an account. Click <a href="{activationLink}">here</a> to activate your account. If link does not work, paste this link in your browser: {activationLink}',
            ],
            [
                'setting_key' => 'withdrawal_paid_sms_template',
                'setting_value' => 'Dear {name}, Your cash out request was paid.<br> Transaction ID: {transactionId}. Amount:${amount}. Thank you',
            ],
            [
                'setting_key' => 'withdrawal_paid_email_template',
                'setting_value' => 'Dear {name}, Your cash out request was paid.<br> Transaction ID: {transactionId}. Amount:${amount}. Thank you',
            ],
            [
                'setting_key' => 'withdrawal_paid_email_subject',
                'setting_value' => 'Withdrawal Paid',
            ],
            [
                'setting_key' => 'withdrawal_declined_email_template',
                'setting_value' => 'Dear {name}, Your cash out request was declined.<br> Transaction ID: {transactionId}. <br>Amount:${amount}. <br>Thank you',
            ],
            [
                'setting_key' => 'withdrawal_declined_email_subject',
                'setting_value' => 'Withdrawal Declined',
            ],
            [
                'setting_key' => 'payment_email_subject',
                'setting_value' => 'Payment Receipt',
            ],
            [
                'setting_key' => 'payment_email_template',
                'setting_value' => 'Dear {name},You received new payment. Transaction ID: {transactionId}.<br>Payment Type:{paymentType}<br>Amount:${amount}.<br> Thank you',
            ],
            [
                'setting_key' => 'sell_email_subject',
                'setting_value' => 'Crypto Currency Sold',
            ],
            [
                'setting_key' => 'sell_email_template',
                'setting_value' => 'Dear {name}, your cryptocurrency has been purchased.<br>Order ID:{orderId}}',
            ],
            [
                'setting_key' => 'withdrawal_request_email_subject',
                'setting_value' => 'Withdrawal Request',
            ],
            [
                'setting_key' => 'withdrawal_request_email_template',
                'setting_value' => 'Dear Admin. {name} has made a withdrawal request.Transaction ID: {transactionId}.<br>Payment Type:{paymentType}<br>Amount:${amount}.<br> Thank you',
            ],
            [
                'setting_key' => 'non_reply_email',
                'setting_value' => 'nonreply@webstudio.co.zw',
            ],
            [
                'setting_key' => 'cron_last_run',
                'setting_value' => '',
            ],
            [
                'setting_key' => 'enable_cron',
                'setting_value' => '0',
            ],
            [
                'setting_key' => 'admin_email',
                'setting_value' => 'admin@webstudio.co.zw',
            ],
            [
                'setting_key' => 'alerts_email',
                'setting_value' => 'alerts@webstudio.co.zw',
            ],
            [
                'setting_key' => 'wallet_address_limit',
                'setting_value' => '1',
            ],
            [
                'setting_key' => 'otp_sms_template',
                'setting_value' => 'Your OTP is {otp}',
            ],
            [
                'setting_key' => 'announcement',
                'setting_value' => '',
            ],
            [
                'setting_key' => 'announcement_type',
                'setting_value' => 'info',
            ],
            [
                'setting_key' => 'update_url',
                'setting_value' => 'http://webstudio.co.zw/uce/update',
            ]

        ]);
    }
}
