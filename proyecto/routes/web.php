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

Route::view('registers/registerDoctor', 'registers.registerDoctor')->name('registerDoctor');
Route::view('registers/registerPacient', 'registers.registerPacient')->name('registerPacient');
Route::view('registers/registerAdministrator', 'registers.registerAdministrator')->name('registerAdministrator');
Route::view('test/create', 'test.create')->name('makeTest');
Route::view('findView', 'findView')->name('findView');
Route::view('administrator.editAdministrator', 'editAdministrator')->name('editAdministrator');
Route::view('administrator.editPacient', 'editPacient')->name('editPacient');
Route::view('administrator.editDoctor', 'editDoctor')->name('editDoctor');
Route::view('updatePassword', 'updatePassword')->name('updatePassword');


Route::view('appointments/newAppointment', 'appointments.newAppointment')->name('newAppointment');
Route::view('appointments/homeAppointment', 'appointments.homeAppointments')->name('homeAppointments');
Route::view('appointments/viewAppointments', 'appointments.viewAppointments')->name('viewAppointments');
Route::post('/appointments/newAppointment', 'DoctorController@makeAppointment');
Route::post('/appointments/homeAppointments', 'ApointmentController@viewAppointments');
Route::post('/appointments/viewAppointments', 'ApointmentController@appointmentPacient');
Route::post( 'appointments/manageAppointment', 'ApointmentController@manageAppointment');
Route::post( 'appointments/modifyAppointments', 'ApointmentController@modify');


Route::view('appointments/appointmentFind', 'appointments.appointmentFind')->name('appointment');
Route::view( 'pacientFindAppointment', 'pacient.pacientFindAppointment')->name( 'pacientFindAppointment');

Route::Post('registers/registerDoctor', 'AdministratorController@createDoctor');
Route::Post('registers/registerPacient', 'AdministratorController@createPacient');
Route::Post('registers/registerAdministrator', 'AdministratorController@createAdministrator');

Route::Post('test/makeTest', 'DoctorController@makeTest');
Route::Post('findPost', 'AdministratorController@findAdmin');
Route::Post('findPostPacient', 'DoctorController@viewPacient');
Route::post('/changePassword', 'HomeController@changePassword')->name('changePassword');

Route::post('findDataPacient', 'DoctorController@managePacient');


Route::Post('/administrator/modifyUser', 'AdministratorController@modifyUser');

Route::Post('/pacient/modifyUser', 'AdministratorController@modifyUser');
Route::Post('/pacient/modifyPacient', 'DoctorController@modifyPacient');
Route::post('pacient/pacientViewAppointment', 'ApointmentController@pacientAppointment');

Route::get('/changePassword', 'HomeController@showChangePasswordForm');
Route::get('/pacient/edit/{id}', 'DoctorController@edit');