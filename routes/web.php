<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Mail\Notificacion;
use Illuminate\Support\Facades\Mail;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//implementar la ruta de la vista alumno

// Route::get('/alumno', function () {
//     return view('alumno.index');
// });

// Route::get('/alumno', [AlumnoController::class, 'index']);

// Route::get('/alumno/create', [AlumnoController::class, 'create']);

Route::resource('alumno', AlumnoController::class)->middleware('auth');

//definimos que rutas en concreto queremos
// Route::resource('alumno', AlumnoController::class)->only([
//     'index', 'show'
// ]);

//esta linea esta creando la ruta de login etc
Auth::routes(['register' => false, 'reset' => false]); //podemos decirle que desactive algunas seciones como registrarse o contraseña nueva

//la ruta de home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//cuando se inicia login nos lleva a la pagina de alumnos creados
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [AlumnoController::class, 'index'])->name('home');
});


Route::get('/email',function(){
    //return (new Notificacion("Miguel"))->render();
    $mensaje = new Notificacion("Miguel");

    //$response = Mail::to("miguel.carpio@escuelaestech.es")->cc("cayetano.ledesma@escuelaestech.es")->bcc("jesus.martinez@escuelaestech.es")->send($mensaje); //queue en vez de send para un envio asincrono
    $response = Mail::to("miguel.carpio@escuelaestech.es")->send($mensaje);
    dump($response);
});




//-------
