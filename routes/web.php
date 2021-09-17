<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


//veterinarios
Route::get('/veterinarios', 'VetController@index')->name('vet.view');
Route::get('/veterinarios/crear', 'VetController@create')->name('vet.create_vet');
Route::post('/veterinarios/guardar', 'VetController@save')->name('vet.save_vet');
Route::get('/veterinario/{file}', 'VetController@avatar')->name('vet.avatar');


//agenda
Route::get('/cita', 'ScheduleController@index')->name('schedule.create');
Route::post('/cita/crear', 'ScheduleController@store')->name('schedule.save');
Route::post('/cita/editar/{id}', 'ScheduleController@edit')->name('schedule.edit');
Route::post('/cita/actualizar/{schedule}', 'ScheduleController@update')->name('schedule.update');
Route::get('/cita/mostrar', 'ScheduleController@show');
Route::get('/cita/borrar/{id}', 'ScheduleController@destroy')->name('schedule.destroy');
