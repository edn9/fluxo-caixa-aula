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
    $usuarios = \DB::table('usuarios')->get();

    return view('list', compact('usuarios'));
})->name('list');

Route::get('/criar', 'AdminController@criar');

Route::post('/salvar', 'AdminController@salvar');

Route::post('/editar', 'AdminController@editar');

Route::post('/editar-salvar', 'AdminController@editarSalvar');

Route::get('/excluir{id}', 'AdminController@excluir');
