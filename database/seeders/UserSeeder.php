<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Deivie Jaimes',
            'email' => 'deivie92@gmail.com',
            'password' => bcrypt('panchito365')
        ])->assignRole('Admin');

        User::create([
            'name' => 'Julia Montoya',
            'email' => 'deivie365@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Gerente');

        User::create([
            'name' => 'Juanito Perez',
            'email' => 'deivie@gmail.com',
            'password' => bcrypt('123456')
        ])->assignRole('Sub');
        
    }
}