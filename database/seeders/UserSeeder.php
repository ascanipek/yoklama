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
            
            
                        
            DB::table('users')->insert( [
            'id'=>2,
            'name'=>'Kerim Metin',
            'email'=>'kerimmetin@gmail.com',
            'email_verified_at'=>NULL,
            'password'=>'$2y$10$PWqJmZw9WhhqI44avyHFKOhiyKwJpW/mUIdWmE3CsBD/kYmUeSbha',
            'remember_token'=>'JMEVPM7ymjPU0gzK5pzqSAlBJoL1O8MXoeTRGQGPFVwZiUXilUDHlIfjKAB4',
            'created_at'=>NULL,
            'updated_at'=>NULL,
            'type'=>2,
            'branch'=>'BİLİŞİM TEKNOLOJİLERİ'
            ] );
            
            
                        
            DB::table('users')->insert( [
            'id'=>11,
            'name'=>'Ahmet İğdir',
            'email'=>'ahmetigdir17@gmail.com',
            'email_verified_at'=>NULL,
            'password'=>'$2y$10$SZYmxqQ5iLaeZutKjcM5Y.5T5gnwRfYSPTZcWtGiGmdMEmEIykDdu',
            'remember_token'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL,
            'type'=>2,
            'branch'=>'BİLİŞİM TEKNOLOJİLERİ'
            ] );
            
            
                        
            DB::table('users')->insert( [
            'id'=>12,
            'name'=>'Ufuk Demirtaş',
            'email'=>'ufukeses@mynet.com',
            'email_verified_at'=>NULL,
            'password'=>'$2y$10$nI1TLiyn73M7hhB729SypOEh3.DKjMWV8SxV.E4QN9hNk6MS8h8la',
            'remember_token'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL,
            'type'=>2,
            'branch'=>'BİLİŞİM TEKNOLOJİLERİ'
            ] );
            
            
                        
            DB::table('users')->insert( [
            'id'=>13,
            'name'=>'Mehmet Azizoğlu',
            'email'=>'maskeka@gmail.com',
            'email_verified_at'=>NULL,
            'password'=>'$2y$10$Ghm5nx4LzNS3cMarJeOphuLIrsrnU7ngoViNGVryCUCdI3CEHc6se',
            'remember_token'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL,
            'type'=>2,
            'branch'=>'Bilişim Teknolojileri'
            ] );
            
            
                        
            DB::table('users')->insert( [
            'id'=>14,
            'name'=>'Sibel Azizoğlu',
            'email'=>'sibelazizoglu@gmail.com',
            'email_verified_at'=>NULL,
            'password'=>'$2y$10$ncONHJNfHQlQpZUh25G7tuCF3sRFM7dbRzryNcG/nvk8dOwSzoo5i',
            'remember_token'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL,
            'type'=>2,
            'branch'=>'BİLİŞİM TEKNOLOJİLERİ'
            ] );
            
            
                        
            DB::table('users')->insert( [
            'id'=>15,
            'name'=>'Serhan Anık',
            'email'=>'serhananik@gmail.com',
            'email_verified_at'=>NULL,
            'password'=>'$2y$10$EG/pDsRDaPr7/3FDcbjd4u8MfE4y/kpF9Tlj/WBsMk4dw1UrbuO2S',
            'remember_token'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL,
            'type'=>2,
            'branch'=>'BİLİŞİM TEKNOLOJİLERİ'
            ] );
            
            
                        
            DB::table('users')->insert( [
            'id'=>16,
            'name'=>'Murat Metin',
            'email'=>'muratmetin@gmail.com',
            'email_verified_at'=>NULL,
            'password'=>'$2y$10$uhbXi4upLpSypoVIwOnJE.tQW88/QjKa7eEObHUNo1SRmI8GsCkMK',
            'remember_token'=>NULL,
            'created_at'=>NULL,
            'updated_at'=>NULL,
            'type'=>2,
            'branch'=>'BİLİŞİM TEKNOLOJİLERİ'
            ] );
            
            
    }
}
