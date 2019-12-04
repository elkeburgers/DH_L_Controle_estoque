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


//  a rota padrao abaixo cria as rotas login e register de usuario automaticamente para nos
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

// vou informar que a rota abaixo precisa de usuario logado, informando o middleware que verifica isso, usando o checkuser que cadastramos dentro do Kernel. Poderiamos usar apenas nesta porque as outras paginas teoricamente so seriam acessadas apos esta, mas por seguranca se coloca em todas. 
Route::get('/produtos/cadastrar', 'ProductController@viewForm')->middleware('checkuser');
Route::post('/produtos/cadastrar', 'ProductController@create');

// usando rota parametrizada (bigodes) para poder usar a informacao dinamica (id do produto). Com isso, ele pega no controller o id do produto e jah carrega no formulario de atualizacao
// se a rota nao receber esse id, ela nao estah completa e retorna na tela 'not foud 404'
// para tornar opcional, coloca a interrogacao no id, e precisa informar algo para retornar no lugar para compeletar a rota, no controller.
Route::get('/produtos/atualizar/{id?}', 'ProductController@viewFormUpdate');
//rota para botao atualizar na view, para de fato salvar os dados atualizados no banco de dados.
Route::post('/produtos/atualizar', 'ProductController@update');

// rota para visualizar a tabela com todos os produtos
Route::get('/produtos', 'ProductController@viewAllProducts');
Route::get('/produto', 'ProductController@viewAllProducts');

Route::get('/produtos/deletar/{id?}', 'ProductController@delete');




