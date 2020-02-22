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

Route::get('login2', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
})->name('index');
Route::get('inicio', function () {
    return view('registrar_informe.index');
});

//Rutas AUTH
Route::get('login', function(){return view('auth.login');})->name('login');
Route::post('validaracceso', 'Auth\LoginController@login')->name('validaracceso');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
//Fin Auth

//Rutas de Bryan
Route::get('buscador', 'BuscadorController@index')->name('buscador');
//