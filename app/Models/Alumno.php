<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Alumno extends Model // Alumno => alumnos
{
    use HasFactory;

    // Alumno -> alumnos, cuando el plural del español sea diferente que en ingles
    protected $table = "alumnos";

    //propiedad fillable/ visaualizar los campos de las tablas en las consultas SQL
    protected $fillable = ['nombre', 'apellido', 'email', 'edad', 'direccion', 'foto'];

    //propiedad hidden/ ocultar los campos de las tablas en las consultas SQL
    protected $hidden = ['id'];

    //devuelve todos los alumnos de la base de datos
    public function obtenerAlumnos() {
        //DB::table('alumnos')->all();
        return Alumno::all();
    }

    //devuelve un alumno con la id = $id
    public function obtenerAlumnoPorId($id){
        return Alumno::find($id);
    }
    
    //casteo
    protected $casts = [
        'email_verifed_at' => 'datetime',
        'activo' => 'boolean',
    ];
}
