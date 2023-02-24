<?php

use App\Http\Controllers\V1\AlumnoApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController; //implementar esto

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function(){
    //todo lo que hay aqui dentro en este grupo se accedera escribiendo /api/v1/*
    Route::post('login', [AuthController::class, 'authenticate']);

    //registro
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => ['jwt.verify']], function(){
        //todo lo que haya en este grupo requiere autenticacion de usuario
        Route::post('logout', [AuthController::class, 'logout']);

        //ruta para obtener usuario
        Route::post('get-user', [AuthController::class, 'getUser']);

        //la ruta para que nos de los alumnos
        Route::get('alumnos', [AlumnoApiController::class, 'index']);
        //mostrar un alumno
        Route::get('alumnos/{id}', [AlumnoApiController::class, 'showOne']);

        //Crear alumno
        Route::post('alumnos', [AlumnoApiController::class, 'store']);

        //hacer un update
        Route::put('alumnos/{id}', [AlumnoApiController::class, 'update']);
    });

});
