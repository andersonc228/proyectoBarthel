<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/welcome', );

Route::view('registers/registerDoctor', 'registers.registerDoctor')->name('registerDoctor');
Route::view('registers/registerPacient', 'registers.registerPacient')->name('registerPacient');
Route::view('registers/registerAdministrator', 'registers.registerAdministrator')->name( 'registerAdministrator');
Route::view('test/create', 'test.create')->name( 'makeTest');
Route::view('find', 'find')->name( 'find');

Route::Post( 'registers/registerDoctor', 'AdministratorController@createDoctor');
Route::Post( 'registers/registerPacient', 'AdministratorController@createPacient');
Route::Post( 'registers/registerAdministrator', 'AdministratorController@createAdministrator');
Route::Post('registers/registerPacient', 'DoctorController@createPacient');
Route::Post( 'test/create', 'DoctorController@makeTest');

