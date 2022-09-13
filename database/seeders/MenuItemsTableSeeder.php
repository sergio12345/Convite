<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu_items')->delete();
        
        \DB::table('menu_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'menu_id' => 1,
                'title' => 'Dashboard',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-boat',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 1,
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
                'route' => 'voyager.dashboard',
                'parameters' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'menu_id' => 1,
                'title' => 'Users',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-person',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 5,
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-08-30 21:08:46',
                'route' => 'voyager.users.index',
                'parameters' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'menu_id' => 1,
                'title' => 'Roles',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-lock',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 13,
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-08-30 21:08:47',
                'route' => 'voyager.roles.index',
                'parameters' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'menu_id' => 1,
                'title' => 'Tools',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-tools',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 2,
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-21 18:41:09',
                'route' => NULL,
                'parameters' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'menu_id' => 1,
                'title' => 'Menu Builder',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-list',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 1,
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-17 13:50:54',
                'route' => 'voyager.menus.index',
                'parameters' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'menu_id' => 1,
                'title' => 'Database',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-data',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 2,
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-17 13:50:54',
                'route' => 'voyager.database.index',
                'parameters' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'menu_id' => 1,
                'title' => 'Compass',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-compass',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 3,
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-17 13:50:54',
                'route' => 'voyager.compass.index',
                'parameters' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'menu_id' => 1,
                'title' => 'BREAD',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-bread',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 4,
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-17 13:50:54',
                'route' => 'voyager.bread.index',
                'parameters' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'menu_id' => 1,
                'title' => 'Settings',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-settings',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 12,
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-08-30 21:08:47',
                'route' => 'voyager.settings.index',
                'parameters' => NULL,
            ),
            9 => 
            array (
                'id' => 11,
                'menu_id' => 1,
                'title' => 'Eventos',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-categories',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 6,
                'created_at' => '2022-06-10 17:36:47',
                'updated_at' => '2022-09-06 19:17:58',
                'route' => 'voyager.campaigns.index',
                'parameters' => 'null',
            ),
            10 => 
            array (
                'id' => 12,
                'menu_id' => 1,
                'title' => 'Invitees',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-people',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 7,
                'created_at' => '2022-06-10 17:38:42',
                'updated_at' => '2022-08-30 21:08:47',
                'route' => 'voyager.invitees.index',
                'parameters' => 'null',
            ),
            11 => 
            array (
                'id' => 13,
                'menu_id' => 1,
                'title' => 'Pix Payments',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-credit-cards',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 9,
                'created_at' => '2022-06-10 17:40:52',
                'updated_at' => '2022-08-30 21:08:47',
                'route' => 'voyager.pix-payments.index',
                'parameters' => NULL,
            ),
            12 => 
            array (
                'id' => 16,
                'menu_id' => 1,
                'title' => 'Campaign Payouts',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-credit-card',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 10,
                'created_at' => '2022-06-14 22:31:50',
                'updated_at' => '2022-08-30 21:08:47',
                'route' => 'voyager.campaign-payouts.index',
                'parameters' => NULL,
            ),
            13 => 
            array (
                'id' => 19,
                'menu_id' => 1,
                'title' => 'Campaign Medias',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-logbook',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 11,
                'created_at' => '2022-06-14 23:30:58',
                'updated_at' => '2022-08-30 21:08:47',
                'route' => 'voyager.campaign-medias.index',
                'parameters' => NULL,
            ),
            14 => 
            array (
                'id' => 20,
                'menu_id' => 1,
                'title' => 'Admins',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-people',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 3,
                'created_at' => '2022-06-17 13:48:43',
                'updated_at' => '2022-06-21 18:41:14',
                'route' => 'voyager.admins.index',
                'parameters' => NULL,
            ),
            15 => 
            array (
                'id' => 22,
                'menu_id' => 1,
                'title' => 'Charity Institutions',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-heart',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 8,
                'created_at' => '2022-08-23 00:13:25',
                'updated_at' => '2022-08-30 21:08:47',
                'route' => 'voyager.institutions.index',
                'parameters' => 'null',
            ),
            16 => 
            array (
                'id' => 24,
                'menu_id' => 1,
                'title' => 'Webhooks',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-archive',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 15,
                'created_at' => '2022-09-09 13:03:12',
                'updated_at' => '2022-09-09 14:10:22',
                'route' => 'voyager.webhooks.index',
                'parameters' => 'null',
            ),
        ));
        
        
    }
}