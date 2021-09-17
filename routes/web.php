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
Route::get('/cita', 'ScheduleController@index')->name('schedule.create');
Route::get('/veterinarios', 'VetController@index')->name('vet.view');
Route::get('/veterinarios/crear', 'VetController@create')->name('vet.create_vet');
Route::post('/veterinarios/guardar', 'VetController@save')->name('vet.save_vet');
Route::get('/veterinario/{file}', 'VetController@avatar')->name('vet.avatar');
Route::post('/cita/crear', 'ScheduleController@store')->name('schedule.save');
