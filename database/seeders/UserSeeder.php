<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert( [
            'id'=>1,
            'name'=>'user',
            'email'=>'user@test.com',
            'email_verified_at'=>NULL,
            'password'=>'$2y$10$UB/oeNVc5JHOlZbesZDyEezyIeUz9Hb3Wbq6Mh17wwJsRqpIKQLEa',
            'remember_token'=>'3aK1YnNlWPSSQ0NxICvmDABzBBgEJ2GE33MxyStBxjBooZqj6PI8wTh8gRkn',
            'created_at'=>'2020-10-21 09:15:47',
            'updated_at'=>'2020-10-21 09:15:47',
            'type'=>1,
            'branch'=>'BİLİŞİM TEKNOLOJİLERİ'
            ] ); 
    }
}
