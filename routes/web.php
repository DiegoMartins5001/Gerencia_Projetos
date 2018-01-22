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
Route::get('/home', 'UserController@index')->name('entrada');
Route::get('listar_projetos_dev', 'DesenvolvedorController@listar_projetos_dev')->middleware('auth');
Route::get('detalhes_projeto_dev/{id_projeto}', 'DesenvolvedorController@detalhes_projeto_dev')->middleware('auth');

Route::get('index','UserController@index')->middleware('auth');
Route::get('index_dev','UserController@index_dev')->middleware('auth');

Route::post('/login','Auth\LoginController@postLogin');
Route::post('registrar','UserController@novo_user');

Route::get('registrar_usuario','UserController@form_user')->middleware('gestor');

Route::group(['middleware'=>'App\Http\Middleware\gestor'], function(){
	Route::get('novo_projeto', 'ProjetoController@novo_projeto')->middleware('gestor');
	Route::get('listar_projetos', 'ProjetoController@listar_projetos')->middleware('gestor');
	Route::get('editar_projeto/{id_projeto?}', 'ProjetoController@editar_projeto')->middleware('gestor');
	Route::post('salvar_projeto/{id_projeto?}', 'ProjetoController@salvar_projeto')->middleware('gestor');
	Route::get('deletar_projeto/{id_projeto?}', 'ProjetoController@deletar_projeto')->middleware('gestor');
	Route::delete('excluir_projeto/{id_projeto?}', 'ProjetoController@excluir_projeto')->middleware('gestor');
	Route::get('detalhes_projeto/{id_projeto}', 'ProjetoController@detalhes_projeto')->middleware('gestor');
	Route::get('concluir/{id_lista?}','ProjetoController@muda_status');
	Route::post('registrar_projeto','ProjetoController@cadastrar_projeto');

	Route::get('cadastrar_devs/{id_projeto}','ProjetoController@add_novos_dev')->middleware('gestor');
	Route::post('salvar_dev/{id_projeto}','ProjetoController@salvar_dev')->middleware('gestor');
});