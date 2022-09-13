<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        DB::table('admins')->delete();
            
            
        DB::table('admins')->insert(array (
            0 =>
            array (
                'id' => 1,
                'role_id' => 1,
                'name' => 'admin',
                'email' => 'admin@ultrahaus.com',
                'avatar' => 'users/default.png',
                'password' => '$2y$10$qu8/VD/nLE8XgzGnmX/Jxe1OdZvDVp4BavqQQGV8bhgF9kHoJFPj2',
                'remember_token' => null,
                'settings' => NULL,
                'created_at' => '2022-06-10 16:29:47',
                'updated_at' => '2022-06-10 16:29:47',
            ),
        ));

            

    }
}
