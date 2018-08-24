<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();
        $statement = "INSERT INTO `permissions` (`id`, `parent_id`, `name`, `slug`, `description`) VALUES
(1, 0, 'Reports', 'reports', 'Access Reports Module'),
(2, 0, 'Communication', 'communication', 'Access Communication Module'),
(3, 2, 'Create Communication', 'communication.create', 'Send Emails & SMS'),
(4, 2, 'Delete Communication', 'communication.delete', 'Delete Communication'),
(5, 0, 'Custom Fields', 'custom_fields', 'Access Custom Fields Module'),
(6, 5, 'View Custom Fields', 'custom_fields.view', 'View Custom fields'),
(7, 5, 'Create Custom Fields', 'custom_fields.create', 'Create Custom Fields'),
(8, 5, 'Custom Fields', 'custom_fields.update', 'Update Custom Fields'),
(9, 5, 'Delete Custom Fields', 'custom_fields.delete', 'Delete Custom Fields'),
(10, 0, 'Users', 'users', 'Access Users Module'),
(11, 10, 'View Users', 'users.view', 'View Users '),
(12, 10, 'Create Users', 'users.create', 'Create users'),
(13, 10, 'Update Users', 'users.update', 'Update Users'),
(14, 10, 'Delete Users', 'users.delete', 'Delete Users'),
(15, 10, 'Manage Roles', 'users.roles', 'Manage user roles'),
(16, 0, 'Settings', 'settings', 'Manage Settings'),
(17, 0, 'Audit Trail', 'audit_trail', 'Access Audit Trail'),
(18, 0, 'Currencies', 'currencies', 'Access Currencies menu'),
(19, 18, 'View Currencies', 'currencies.view', NULL),
(20, 18, 'Create Currencies', 'currencies.create', NULL),
(21, 18, 'Update Currencies', 'currencies.update', NULL),
(22, 18, 'Delete Currencies', 'currencies.delete', NULL),
(23, 0, 'Withdrawals', 'withdrawals', 'Access Withdrawals menu'),
(24, 23, 'View Withdrawals', 'withdrawals.view', NULL),
(25, 23, 'Create Withdrawals', 'withdrawals.create', NULL),
(26, 23, 'Update Withdrawals', 'withdrawals.update', NULL),
(27, 23, 'Delete Withdrawals', 'withdrawals.delete', NULL),
(28, 0, 'Deposits', 'deposits', 'Access Deposits menu'),
(29, 28, 'View Deposits', 'deposits.view', NULL),
(30, 28, 'Create Deposits', 'deposits.create', NULL),
(31, 28, 'Update Deposits', 'deposits.update', NULL),
(32, 28, 'Delete Deposits', 'deposits.delete', NULL);";
        DB::unprepared($statement);
    }
}
