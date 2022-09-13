<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'display_name' => 'Administrator',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'user',
                'display_name' => 'User',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'admin user',
                'display_name' => 'Admin User',
                'created_at' => '2022-06-10 15:57:04',
                'updated_at' => '2022-06-10 15:57:04',
            ),
        ));
        
        
    }
}