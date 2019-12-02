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

Route::get('/produtos/cadastrar', 'ProductController@viewForm');
Route::post('/produtos', 'ProductController@create');

// usando rota parametrizada (bigodes) para poder usar a informacao dinamica (id do produto). Com isso, ele pega no controller o id do produto e jah carrega no formulario de atualizacao
// se a rota nao receber esse id, ela nao estah completa e retorna na tela 'not foud 404'
// para tornar opcional, coloca a interrogacao no id, e precisa informar algo para retornar no lugar para compeletar a rota, no controller.
Route::get('/produtos/atualizar/{id?}', 'ProductController@viewFormUpdate');
