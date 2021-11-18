<?php

namespace Database\Seeders;

//use App\Models\Gerencia;
use Illuminate\Database\Seeder;
//use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RoleSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(EstatuSeeder::class);
         //User::factory(20)->create();
         //Gerencia::factory(40)->create();
             
    }
}