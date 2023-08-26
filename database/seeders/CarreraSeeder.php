<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carrera;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Carrera::create([
            'nombre_carrera' => 'INGENIERIA BIOMEDICA '
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'INGENIERIA CIVIL'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'INGENIERIA EN ALIMENTOS Y BIOTECOLOGIA'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'INGENIERIA EN COMPUTACION'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'INGENIERIA EN COMUNICACIONES Y ELECTRONICA'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'INGENIERIA INFORMATICA'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'INGENIERIA EN LOGISTICA Y TRANSPORTE'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'INGENIERIA EN TOPOGRAFIA GEOMATICA'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'INGENIERIA FOTONICA'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'INGENIERIA INDUSTRIAL'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'INGENIERIA MECANICA ELECTRICA'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'INGENIERIA QUIMICA'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'INGENIERIA ROBOTICA'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'LICENCIATURA EN CIENCIAS DE MATERIALES'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'LICENCIATURA EN FISICA'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'LICENCIATURA EN MATEMATICAS'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'LICENCIATURA EN QUIMICA'
           
        ]);
        Carrera::create([
            'nombre_carrera' => 'LICENCIATURA EN QUIMICO FARMACOBIOLOGO'
           
        ]);

    }
}
