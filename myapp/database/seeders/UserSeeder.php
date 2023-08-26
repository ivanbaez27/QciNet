<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


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
        User::create([
            'name' => 'Jorge Alberto Perez Sandoval',
            'email' => 'test@test.com',
            'code' => '123456789',
            'nip' => '123456789',
            'password' => bcrypt ('123456789'),
            'major_id' => '1',
            'username' => 'admin'
        ])->assignRole('Admin');
        
        User::create([
            'name' => 'Salvador Jimenes Monreal',
            'email' => 'test1@test.com',
            'code' => '127645237',
            'nip' => '123456789',
            'password' => bcrypt ('123456789'),
            'major_id' => '8',
            'username' => 'tester1'
            
        ])->assignRole('Estudiante');

        User::create([
            'name' => 'Guadalupe Mercado Ramírez',
            'email' => 'test2@test.com',
            'code' => '127642236',
            'nip' => '123456789',
            'password' => bcrypt ('123456789'),
            'major_id' => '4',
            'username' => 'tester2'
            
        ])->assignRole('Estudiante');
        
    }
}
