<?php

namespace Database\Seeders;

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
            'name'=>'Abdullah Serkan Canipek',
            'email'=>'ascanipek@gmail.com',
            'email_verified_at'=>NULL,
            'password'=>'$2y$10$oHbEtHXR88.63dBEE6st9enlO7NcVaZopjaxpjcXkxTXlT04HFbGi',
            'remember_token'=>'3aK1YnNlWPSSQ0NxICvmDABzBBgEJ2GE33MxyStBxjBooZqj6PI8wTh8gRkn',
            'created_at'=>'2020-10-21 09:15:47',
            'updated_at'=>'2020-10-21 09:15:47',
            'type'=>1,
            'branch'=>'BİLİŞİM TEKNOLOJİLERİ'
            ] );
           
            
            
    }
}
