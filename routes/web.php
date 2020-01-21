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

/*** CAIXA - START***/

Route::get('/cadastro', 'AdminController@cadastro_caixa')->name('cadastro_caixa');

Route::post('/cadastro-salvar', 'AdminController@cadastro_salvar')->name('cadastro_salvar');

Route::get('/cadastro-editar/{id}', 'AdminController@cadastro_editar')->name('cadastro_editar');

Route::post('/cadastro-alterado', 'AdminController@cadastro_alterado')->name('cadastro_alterado');

Route::post('/deletar-caixa/{id}', 'AdminController@deletar_caixa')->name('deletar_caixa');

Route::get('/caixa-aberto/{id}', 'AdminController@abrir_caixa')->name('abrir_caixa');

Route::post('/adicionar-dinheiro/{caixaId}', 'AdminController@adicionar_dinheiro')->name('adicionar_dinheiro');

Route::post('/remover-dinheiro/{caixaId}', 'AdminController@remover_dinheiro')->name('remover_dinheiro');

Route::post('/caixa-fechado/{caixaId}', 'AdminController@fechar_caixa')->name('fechar_caixa');

Route::get('/transacoes/{id}', 'AdminController@transacoes')->name('transacoes');

Route::get('/resumo-financeiro/{id}', 'AdminController@resumo_financeiro')->name('resumo_financeiro');

/*** CAIXA - END ***/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
