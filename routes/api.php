<?php

use Illuminate\Http\Request;
use App\Http\Controllers\EnderecosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/usuario/new', 'Usuarios\UsuarioController@cadastrar')->name('novo-usuario');
Route::post('/usuario/admin/new', 'PessoaController@store')->name('novo-usuario-admin');

Route::get('/{token}', 'Usuarios\UsuarioController@confirmaToken')->name('token');
Route::get('/usuario/editar/{suite}', 'Usuarios\UsuarioController@exibirUsuario')->name('usuario.exibir');
route::patch('/usuario/update/{id}', 'Usuarios\UsuarioController@atualizar')->name('usuario.atualizar');
Route::delete('/usuario/delete/{id}', 'Usuarios\UsuarioController@destroy')->name('usuario.deletar');
Route::post('/upload', 'Usuarios\UsuarioController@uploadImgPerfil')->name('upload');
Route::post('/upload/docs/rg', 'Usuarios\UsuarioController@uploadDocRG')->name('upload.rg');
Route::post('/upload/docs/comprovante', 'Usuarios\UsuarioController@uploadDocComprovante')->name('upload.comprovante');

Route::get('/pessoas', ['as' => 'pessoas.list', 'uses' => 'PessoaController@index']);
Route::post('/pessoas', ['as' => 'pessoas.add', 'uses' => 'PessoaController@store']);
Route::put('/pessoas/update/{id}', ['as' => 'pessoas.update', 'uses' => 'PessoaController@update']);
Route::delete('/pessoas/delete/{id}', ['as' => 'pessoas.edit', 'uses' => 'PessoaController@destroy']);

Route::post('/endereco', 'EnderecosController@cadastrar');
Route::get('/endereco/{seq_endereco}/{id}', 'EnderecosController@show');
Route::put('/endereco/update/{id}', 'EnderecosController@update');
Route::delete('/endereco/delete/{id}', 'EnderecosController@destroy');

Route::post('/produtos/new', 'EstoqueController@cadastrar')->name('produto-new');
// Route::post('/produtos/upload', 'EstoqueController@uploadEstoque')->name('upload-estoque');

Route::get('/senha', 'Usuarios\UsuarioController@resetToken');

Route::post('/status/new', 'statusController@cadastrar');
