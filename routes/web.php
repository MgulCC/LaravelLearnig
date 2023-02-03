<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;



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

Route::resource('alumno', AlumnoController::class);

//definimos que rutas en concreto queremos
// Route::resource('alumno', AlumnoController::class)->only([
//     'index', 'show'
// ]);