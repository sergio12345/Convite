<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DataTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_types')->delete();
        
        \DB::table('data_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'users',
                'slug' => 'users',
                'display_name_singular' => 'User',
                'display_name_plural' => 'Users',
                'icon' => 'voyager-person',
                'model_name' => 'App\\Models\\User',
                'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller' => 'App\\Http\\Controllers\\Admin\\UserController',
                'description' => NULL,
                'generate_permissions' => 0,
                'server_side' => 1,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-23 15:27:04',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'menus',
                'slug' => 'menus',
                'display_name_singular' => 'Menu',
                'display_name_plural' => 'Menus',
                'icon' => 'voyager-list',
                'model_name' => 'TCG\\Voyager\\Models\\Menu',
                'policy_name' => NULL,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'roles',
                'slug' => 'roles',
                'display_name_singular' => 'Role',
                'display_name_plural' => 'Roles',
                'icon' => 'voyager-lock',
                'model_name' => 'TCG\\Voyager\\Models\\Role',
                'policy_name' => NULL,
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-14 18:19:58',
            ),
            3 => 
            array (
                'id' => 6,
                'name' => 'campaigns',
                'slug' => 'campaigns',
                'display_name_singular' => 'Evento',
                'display_name_plural' => 'Eventos',
                'icon' => NULL,
                'model_name' => 'App\\Models\\Campaign',
                'policy_name' => NULL,
                'controller' => 'App\\Http\\Controllers\\Admin\\CampaignController',
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 1,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-06-10 17:36:46',
                'updated_at' => '2022-09-06 19:18:21',
            ),
            4 => 
            array (
                'id' => 7,
                'name' => 'invitees',
                'slug' => 'invitees',
                'display_name_singular' => 'Invitee',
                'display_name_plural' => 'Invitees',
                'icon' => NULL,
                'model_name' => 'App\\Models\\Invitee',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 1,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-06-10 17:38:42',
                'updated_at' => '2022-06-23 15:44:25',
            ),
            5 => 
            array (
                'id' => 8,
                'name' => 'pix_payments',
                'slug' => 'pix-payments',
                'display_name_singular' => 'Pix Payment',
                'display_name_plural' => 'Pix Payments',
                'icon' => 'voyager-credit-cards',
                'model_name' => 'App\\Models\\PixPayment',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 1,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-06-10 17:40:51',
                'updated_at' => '2022-06-22 22:41:33',
            ),
            6 => 
            array (
                'id' => 14,
                'name' => 'campaign_payouts',
                'slug' => 'campaign-payouts',
                'display_name_singular' => 'Campaign Payout',
                'display_name_plural' => 'Campaign Payouts',
                'icon' => 'voyager-credit-card',
                'model_name' => 'App\\Models\\CampaignPayout',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 1,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-06-14 22:31:50',
                'updated_at' => '2022-06-23 12:50:10',
            ),
            7 => 
            array (
                'id' => 19,
                'name' => 'campaign_medias',
                'slug' => 'campaign-medias',
                'display_name_singular' => 'Campaign Media',
                'display_name_plural' => 'Campaign Medias',
                'icon' => 'voyager-logbook',
                'model_name' => 'App\\Models\\CampaignMedia',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 1,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-06-14 23:30:58',
                'updated_at' => '2022-06-23 13:20:43',
            ),
            8 => 
            array (
                'id' => 20,
                'name' => 'admins',
                'slug' => 'admins',
                'display_name_singular' => 'Admin',
                'display_name_plural' => 'Admins',
                'icon' => 'voyager-people',
                'model_name' => 'App\\Models\\Admin',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 1,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-06-17 13:48:43',
                'updated_at' => '2022-06-23 13:28:16',
            ),
            9 => 
            array (
                'id' => 21,
                'name' => 'institutions',
                'slug' => 'institutions',
                'display_name_singular' => 'Institution',
                'display_name_plural' => 'Institutions',
                'icon' => NULL,
                'model_name' => 'App\\Models\\Institution',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-08-23 00:13:25',
                'updated_at' => '2022-08-23 00:51:38',
            ),
            10 => 
            array (
                'id' => 28,
                'name' => 'webhooks',
                'slug' => 'webhooks',
                'display_name_singular' => 'Webhook',
                'display_name_plural' => 'Webhooks',
                'icon' => NULL,
                'model_name' => 'App\\Models\\Webhook',
                'policy_name' => NULL,
                'controller' => 'App\\Http\\Controllers\\WebhookController',
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2022-09-09 13:03:12',
                'updated_at' => '2022-09-09 13:35:26',
            ),
        ));
        
        
    }
}