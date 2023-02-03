<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUseridToAlumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('alumnos', function (Blueprint $table) {
        //     $table->unsignedbigInteger('userid')->after('id');
        //     //clave foranea
        //     //si existe la columna userid la transforma en foranea
        //     if(Schema::hasColumn('userid')) {
        //         $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
        //     }
        //     //$table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
        //     //modificar columna, en este caso email
        //     //$table->string('email')
        // });

        ///--------
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('alumnos', function (Blueprint $table) {
        //     $table->dropForeign('alumnos_userid_foreign');
        //     $table->dropColumn('userid');
        // });

        //-----
    }
}
