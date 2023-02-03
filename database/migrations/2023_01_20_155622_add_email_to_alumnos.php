<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToAlumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alumnos', function (Blueprint $table) {
            //email tendra 100 caracteres de limite, puede ser null, he ira despues de la comumna apellido
            $table->string('email', 100)->nullable()->after('apellido');
        });

        //Schema::rename('alumnos', 'students');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::rename('students', 'alumnos');
        
        Schema::table('alumnos', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
}
