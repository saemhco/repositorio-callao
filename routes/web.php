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


Route::get('inicio', function () {
    return view('registrar_informe.index');
});
//Informe
Route::group(['prefix' => 'informe'], function () {
    Route::get('/', 'InformeController@index')->name('informe.index');
    Route::get('set_programa', 'InformeController@detalle_programa')->name('informe.programa');
    Route::get('set_jurado', 'InformeController@set_jurado')->name('informe.jurados');
});

//Rutas AUTH
Route::get('/login', function(){
   // When user is already logged redirect to home
   return Illuminate\Support\Facades\Auth::check() ? redirect('home') : view('auth.login');
})->name('login');
Route::post('validaracceso', 'Auth\LoginController@login')->name('validaracceso');
Route::get('/registrar/usuario', 'UserController@index')->name('register.user');
Route::post('registrarusuario', 'UserController@create')->name('register.user');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
//Fin Auth
// Rutas Report
Route::post('/report/basic', 'ReportController@BasicSearch')->name('search.basic');
Route::post('/report/intermediate', 'ReportController@IntermediateSearch')->name('search.intermediate');
Route::post('/report/advanced', 'ReportController@AdvancedSearch')->name('search.advanced');
