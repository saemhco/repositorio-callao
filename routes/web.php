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
// Reports
Route::get('/', 'ReportController@index')->name('index');  // Search
Route::get('/home', 'HomeController@index')->name('home');  // Insert

//Rutas AUTH
Route::get('login', function(){
   // When user is already logged redirect to home
   return Illuminate\Support\Facades\Auth::check() ? redirect()->route('informe.index') : view('auth.login');
})->name('login');
Route::post('validaracceso', 'Auth\LoginController@login')->name('validaracceso');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('configurar_mi_cuenta', 'Auth\MeController@update')->name('me.update');
//Fin Auth

//Informe
Route::group(['prefix' => 'informe'], function () {
    Route::get('/', 'InformeController@index')->name('informe.index');
    Route::get('data', 'InformeController@data')->name('informe.data');
    Route::get('set_programa', 'InformeController@get_programa')->name('informe.programa');
    Route::get('set_jurado', 'InformeController@set_jurado')->name('informe.jurados');
    Route::get('set_personas', 'InformeController@get_personas')->name('informe.personas');
    Route::get('set_tabla_personas', 'InformeController@get_tabla_personas')->name('informe.tabla_personas');
    Route::post('nueva_persona', 'InformeController@store_personas')->name('informe.store_personas');
    Route::post('eliminar_persona', 'InformeController@delete_persona')->name('informe.delete_personas');
    Route::post('form_nuevo', 'InformeController@store')->name('informe.store');
    Route::post('eliminar', 'InformeController@delete')->name('informe.eliminar');
    Route::get('editar/{id}', 'InformeController@edit')->where(['id' => '[0-9]+'])->name('informe.editar_personas');
    Route::post('form_editar', 'InformeController@update')->name('informe.actualizar');
    Route::post('guardar_archivo', 'InformeController@save_file')->name('informe.guardar_archivo');
});
//Personas
Route::group(['prefix' => 'personas'], function () {
    Route::get('/', 'PersonaController@index')->name('personas.index');
    Route::get('data', 'PersonaController@data')->name('personas.data');
    Route::post('nuevo', 'PersonaController@store')->name('personas.nuevo');
    Route::post('eliminar', 'PersonaController@delete')->name('personas.eliminar');
    Route::post('actualizar', 'PersonaController@update')->name('personas.actualizar');
    Route::get('editar/{dni}', 'PersonaController@edit')->name('personas.editar');
    Route::post('importacion_masiva', 'PersonaController@importar')->name('personas.importar');
});
//usuario
Route::group(['prefix' => 'usuarios'], function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('data', 'UserController@data')->name('user.data');
    Route::post('nuevo', 'UserController@store')->name('user.nuevo');
    Route::post('eliminar', 'UserController@delete')->name('user.eliminar');
    Route::post('actualizar', 'UserController@update')->name('user.actualizar');
    Route::get('editar/{id}', 'UserController@edit')->where(['id' => '[0-9]+'])->name('user.editar');
});

// Rutas Report
Route::group(['prefix' => 'busqueda'], function(){
   Route::get('/', 'ReportController@index')->name('search.index');  // Search
   Route::post('basic', 'ReportController@BasicSearch')->name('search.basic');
   Route::post('intermediate', 'ReportController@IntermediateSearch')->name('search.intermediate');
   Route::post('advanced', 'ReportController@AdvancedSearch')->name('search.advanced');
   Route::post('set_programa', 'ReportController@get_programa')->name('search.getprograma');
   Route::get('/{id}', 'ReportController@search_found')->where(['id' => '[0-9]+'])->name('search.found');
});

// Rutas dasboard
Route::group(['prefix' => 'dasboard'], function(){
   Route::get('/', 'DasboardController@index')->name('dasboard.index');  
});

// Rutas ajustes
Route::group(['prefix' => 'ajustes'], function(){
   Route::get('/', 'AjustesController@index')->name('ajustes.index');  
   Route::post('update', 'AjustesController@update')->name('ajustes.update');  
   Route::get('reset', 'AjustesController@restablecer')->name('ajustes.restablecer');  
});