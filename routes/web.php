<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
Route::get('get_infos_dashboard_json', 'HomeController@GetInfosDashBoardJson');
Auth::routes();

Route::group(['prefix' => 'tags', 'middleware' => 'auth'], function(){
	Route::post('salvar', 'TagsController@Salvar');
	Route::get('listar', 'TagsController@Listar')->name('tags.listar');
	Route::get('tags_json', 'TagsController@TagsJson');
	Route::post('salvar_edicao', 'TagsController@SalvarEdicao');
	Route::delete('deletar/{id_tag}', 'TagsController@Deletar');
});

Route::group(['prefix' => 'lancamentos', 'middleware' => 'auth'], function(){
	Route::get('listar', 'LancamentosController@Listar')->name('lancamentos.listar');
	Route::post('salvar', 'LancamentosController@Salvar');
	Route::get('lancamentos_json', 'LancamentosController@LancamentosJson');
	Route::delete('deletar/{id_tag}', 'LancamentosController@Deletar');
	Route::post('salvar_edicao', 'LancamentosController@SalvarEdicao');
});