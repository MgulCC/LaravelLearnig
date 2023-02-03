<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //importar DB

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //selecionar la tambla alumnos
    public function run()
    {
        DB::table('alumnos')->insert([
            [
                'nombre' => 'Frodo',
                'apellido' => 'Bolson',
                'email' => 'yervadelacomarca@hobbiton.com',
                'edad' => 35,
                'direccion' => 'c/ la colina, hobbiton',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nombre' => 'Meriadoc',
                'apellido' => 'Brandigamo',
                'email' => 'yervadelacomarca@hobbiton.com',
                'edad' => 36,
                'direccion' => 'c/ la colina, hobbiton',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),  
            ]
        ]);
    }
}
