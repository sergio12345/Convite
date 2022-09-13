<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'browse_admin',
                'table_name' => NULL,
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'browse_bread',
                'table_name' => NULL,
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'browse_database',
                'table_name' => NULL,
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'browse_media',
                'table_name' => NULL,
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'browse_compass',
                'table_name' => NULL,
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'browse_menus',
                'table_name' => 'menus',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'read_menus',
                'table_name' => 'menus',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'edit_menus',
                'table_name' => 'menus',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'add_menus',
                'table_name' => 'menus',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'delete_menus',
                'table_name' => 'menus',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'browse_roles',
                'table_name' => 'roles',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'read_roles',
                'table_name' => 'roles',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'edit_roles',
                'table_name' => 'roles',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'add_roles',
                'table_name' => 'roles',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'delete_roles',
                'table_name' => 'roles',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'browse_users',
                'table_name' => 'users',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'read_users',
                'table_name' => 'users',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'edit_users',
                'table_name' => 'users',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            18 => 
            array (
                'id' => 19,
                'key' => 'add_users',
                'table_name' => 'users',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            19 => 
            array (
                'id' => 20,
                'key' => 'delete_users',
                'table_name' => 'users',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            20 => 
            array (
                'id' => 21,
                'key' => 'browse_settings',
                'table_name' => 'settings',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            21 => 
            array (
                'id' => 22,
                'key' => 'read_settings',
                'table_name' => 'settings',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            22 => 
            array (
                'id' => 23,
                'key' => 'edit_settings',
                'table_name' => 'settings',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            23 => 
            array (
                'id' => 24,
                'key' => 'add_settings',
                'table_name' => 'settings',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            24 => 
            array (
                'id' => 25,
                'key' => 'delete_settings',
                'table_name' => 'settings',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            25 => 
            array (
                'id' => 26,
                'key' => 'browse_campaigns',
                'table_name' => 'campaigns',
                'created_at' => '2022-06-10 17:36:46',
                'updated_at' => '2022-06-10 17:36:46',
            ),
            26 => 
            array (
                'id' => 27,
                'key' => 'read_campaigns',
                'table_name' => 'campaigns',
                'created_at' => '2022-06-10 17:36:46',
                'updated_at' => '2022-06-10 17:36:46',
            ),
            27 => 
            array (
                'id' => 28,
                'key' => 'edit_campaigns',
                'table_name' => 'campaigns',
                'created_at' => '2022-06-10 17:36:46',
                'updated_at' => '2022-06-10 17:36:46',
            ),
            28 => 
            array (
                'id' => 29,
                'key' => 'add_campaigns',
                'table_name' => 'campaigns',
                'created_at' => '2022-06-10 17:36:46',
                'updated_at' => '2022-06-10 17:36:46',
            ),
            29 => 
            array (
                'id' => 30,
                'key' => 'delete_campaigns',
                'table_name' => 'campaigns',
                'created_at' => '2022-06-10 17:36:46',
                'updated_at' => '2022-06-10 17:36:46',
            ),
            30 => 
            array (
                'id' => 31,
                'key' => 'browse_invitees',
                'table_name' => 'invitees',
                'created_at' => '2022-06-10 17:38:42',
                'updated_at' => '2022-06-10 17:38:42',
            ),
            31 => 
            array (
                'id' => 32,
                'key' => 'read_invitees',
                'table_name' => 'invitees',
                'created_at' => '2022-06-10 17:38:42',
                'updated_at' => '2022-06-10 17:38:42',
            ),
            32 => 
            array (
                'id' => 33,
                'key' => 'edit_invitees',
                'table_name' => 'invitees',
                'created_at' => '2022-06-10 17:38:42',
                'updated_at' => '2022-06-10 17:38:42',
            ),
            33 => 
            array (
                'id' => 34,
                'key' => 'add_invitees',
                'table_name' => 'invitees',
                'created_at' => '2022-06-10 17:38:42',
                'updated_at' => '2022-06-10 17:38:42',
            ),
            34 => 
            array (
                'id' => 35,
                'key' => 'delete_invitees',
                'table_name' => 'invitees',
                'created_at' => '2022-06-10 17:38:42',
                'updated_at' => '2022-06-10 17:38:42',
            ),
            35 => 
            array (
                'id' => 36,
                'key' => 'browse_pix_payments',
                'table_name' => 'pix_payments',
                'created_at' => '2022-06-10 17:40:52',
                'updated_at' => '2022-06-10 17:40:52',
            ),
            36 => 
            array (
                'id' => 37,
                'key' => 'read_pix_payments',
                'table_name' => 'pix_payments',
                'created_at' => '2022-06-10 17:40:52',
                'updated_at' => '2022-06-10 17:40:52',
            ),
            37 => 
            array (
                'id' => 38,
                'key' => 'edit_pix_payments',
                'table_name' => 'pix_payments',
                'created_at' => '2022-06-10 17:40:52',
                'updated_at' => '2022-06-10 17:40:52',
            ),
            38 => 
            array (
                'id' => 39,
                'key' => 'add_pix_payments',
                'table_name' => 'pix_payments',
                'created_at' => '2022-06-10 17:40:52',
                'updated_at' => '2022-06-10 17:40:52',
            ),
            39 => 
            array (
                'id' => 40,
                'key' => 'delete_pix_payments',
                'table_name' => 'pix_payments',
                'created_at' => '2022-06-10 17:40:52',
                'updated_at' => '2022-06-10 17:40:52',
            ),
            40 => 
            array (
                'id' => 56,
                'key' => 'browse_campaign_payouts',
                'table_name' => 'campaign_payouts',
                'created_at' => '2022-06-14 22:31:50',
                'updated_at' => '2022-06-14 22:31:50',
            ),
            41 => 
            array (
                'id' => 57,
                'key' => 'read_campaign_payouts',
                'table_name' => 'campaign_payouts',
                'created_at' => '2022-06-14 22:31:50',
                'updated_at' => '2022-06-14 22:31:50',
            ),
            42 => 
            array (
                'id' => 58,
                'key' => 'edit_campaign_payouts',
                'table_name' => 'campaign_payouts',
                'created_at' => '2022-06-14 22:31:50',
                'updated_at' => '2022-06-14 22:31:50',
            ),
            43 => 
            array (
                'id' => 59,
                'key' => 'add_campaign_payouts',
                'table_name' => 'campaign_payouts',
                'created_at' => '2022-06-14 22:31:50',
                'updated_at' => '2022-06-14 22:31:50',
            ),
            44 => 
            array (
                'id' => 60,
                'key' => 'delete_campaign_payouts',
                'table_name' => 'campaign_payouts',
                'created_at' => '2022-06-14 22:31:50',
                'updated_at' => '2022-06-14 22:31:50',
            ),
            45 => 
            array (
                'id' => 71,
                'key' => 'browse_campaign_medias',
                'table_name' => 'campaign_medias',
                'created_at' => '2022-06-14 23:30:58',
                'updated_at' => '2022-06-14 23:30:58',
            ),
            46 => 
            array (
                'id' => 72,
                'key' => 'read_campaign_medias',
                'table_name' => 'campaign_medias',
                'created_at' => '2022-06-14 23:30:58',
                'updated_at' => '2022-06-14 23:30:58',
            ),
            47 => 
            array (
                'id' => 73,
                'key' => 'edit_campaign_medias',
                'table_name' => 'campaign_medias',
                'created_at' => '2022-06-14 23:30:58',
                'updated_at' => '2022-06-14 23:30:58',
            ),
            48 => 
            array (
                'id' => 74,
                'key' => 'add_campaign_medias',
                'table_name' => 'campaign_medias',
                'created_at' => '2022-06-14 23:30:58',
                'updated_at' => '2022-06-14 23:30:58',
            ),
            49 => 
            array (
                'id' => 75,
                'key' => 'delete_campaign_medias',
                'table_name' => 'campaign_medias',
                'created_at' => '2022-06-14 23:30:58',
                'updated_at' => '2022-06-14 23:30:58',
            ),
            50 => 
            array (
                'id' => 76,
                'key' => 'browse_admins',
                'table_name' => 'admins',
                'created_at' => '2022-06-17 13:48:43',
                'updated_at' => '2022-06-17 13:48:43',
            ),
            51 => 
            array (
                'id' => 77,
                'key' => 'read_admins',
                'table_name' => 'admins',
                'created_at' => '2022-06-17 13:48:43',
                'updated_at' => '2022-06-17 13:48:43',
            ),
            52 => 
            array (
                'id' => 78,
                'key' => 'edit_admins',
                'table_name' => 'admins',
                'created_at' => '2022-06-17 13:48:43',
                'updated_at' => '2022-06-17 13:48:43',
            ),
            53 => 
            array (
                'id' => 79,
                'key' => 'add_admins',
                'table_name' => 'admins',
                'created_at' => '2022-06-17 13:48:43',
                'updated_at' => '2022-06-17 13:48:43',
            ),
            54 => 
            array (
                'id' => 80,
                'key' => 'delete_admins',
                'table_name' => 'admins',
                'created_at' => '2022-06-17 13:48:43',
                'updated_at' => '2022-06-17 13:48:43',
            ),
            55 => 
            array (
                'id' => 81,
                'key' => 'browse_institutions',
                'table_name' => 'institutions',
                'created_at' => '2022-08-23 00:13:25',
                'updated_at' => '2022-08-23 00:13:25',
            ),
            56 => 
            array (
                'id' => 82,
                'key' => 'read_institutions',
                'table_name' => 'institutions',
                'created_at' => '2022-08-23 00:13:25',
                'updated_at' => '2022-08-23 00:13:25',
            ),
            57 => 
            array (
                'id' => 83,
                'key' => 'edit_institutions',
                'table_name' => 'institutions',
                'created_at' => '2022-08-23 00:13:25',
                'updated_at' => '2022-08-23 00:13:25',
            ),
            58 => 
            array (
                'id' => 84,
                'key' => 'add_institutions',
                'table_name' => 'institutions',
                'created_at' => '2022-08-23 00:13:25',
                'updated_at' => '2022-08-23 00:13:25',
            ),
            59 => 
            array (
                'id' => 85,
                'key' => 'delete_institutions',
                'table_name' => 'institutions',
                'created_at' => '2022-08-23 00:13:25',
                'updated_at' => '2022-08-23 00:13:25',
            ),
            60 => 
            array (
                'id' => 91,
                'key' => 'browse_webhooks',
                'table_name' => 'webhooks',
                'created_at' => '2022-09-09 13:03:12',
                'updated_at' => '2022-09-09 13:03:12',
            ),
            61 => 
            array (
                'id' => 92,
                'key' => 'read_webhooks',
                'table_name' => 'webhooks',
                'created_at' => '2022-09-09 13:03:12',
                'updated_at' => '2022-09-09 13:03:12',
            ),
            62 => 
            array (
                'id' => 93,
                'key' => 'edit_webhooks',
                'table_name' => 'webhooks',
                'created_at' => '2022-09-09 13:03:12',
                'updated_at' => '2022-09-09 13:03:12',
            ),
            63 => 
            array (
                'id' => 94,
                'key' => 'add_webhooks',
                'table_name' => 'webhooks',
                'created_at' => '2022-09-09 13:03:12',
                'updated_at' => '2022-09-09 13:03:12',
            ),
            64 => 
            array (
                'id' => 95,
                'key' => 'delete_webhooks',
                'table_name' => 'webhooks',
                'created_at' => '2022-09-09 13:03:12',
                'updated_at' => '2022-09-09 13:03:12',
            ),
        ));
        
        
    }
}