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
    return redirect('login');
});

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

Route::get('editar/ficha', 'FichaController@show')->name('editar');
//datos personales
Route::post('crear/datos_personales','FichaController@store_datos_personales')->name('datos_personales');
Route::post('editar/datos_personales', 'FichaController@edit_datos_personales')->name('edit_datos_personales');

//datos de contactos
Route::post('crear/contacto','FichaController@store_contactos')->name('store_contactos');


//datos de enfermedades
Route::post('crear/enfermedad','FichaController@store_enfermedad')->name('store_enfermedad');

//datos de remedios
Route::post('crear/remedio','FichaController@store_remedio')->name('store_remedio');

//farmacia
Route::post('editar/farmacia', 'FichaController@edit_farmacia')->name('edit_farmacia');
// prevision salud
Route::post('editar/prevision_salud', 'FichaController@edit_prevision_salud')->name('edit_prevision_salud');
//registrar coordenadas
Route::post('crear/coordenadas','FichaController@registrar_coordenadas')->name('registrar_coordenadas');

//consulta por id
Route::post('id', 'FichaController@Index')->name('buscar_pin');
//vincular pin
Route::post('vincular/pin','FichaController@Vincular_pin')->name('Vincular_pin');
Route::get('id/{id?}', 'FichaController@mostar')->name('mostrar');