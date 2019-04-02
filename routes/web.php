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

// Views do site
Route::group(['middleware' => ['calculadorasite']], function () {
    Route::get('/', function () {
        $dolar = DB::select('select cfg_dolar from bxby_configurations');
        return view('site.main', ['dolar' => $dolar]);
    })->name('site');

    Route::get('/duvidas', function () {
        $dolar = DB::select('select cfg_dolar from bxby_configurations');
        return view('site.duvidas', ['dolar' => $dolar]);
    })->name('duvidas');

    Route::get('/onde-comprar', function () {
        $dolar = DB::select('select cfg_dolar from bxby_configurations');
        return view('site.ondecomprar', ['dolar' => $dolar]);
    })->name('ondecomprar');

    Route::get('/sobre', function () {
        $dolar = DB::select('select cfg_dolar from bxby_configurations');
        return view('site.sobre', ['dolar' => $dolar]);
    })->name('sobre');

    Route::get('/pagamento', function () {
        $dolar = DB::select('select cfg_dolar from bxby_configurations');
        return view('site.pagamentos', ['dolar' => $dolar]);
    })->name('pagamentos');

    Route::get('/contato', function () {
        $dolar = DB::select('select cfg_dolar from bxby_configurations');
        return view('site.contato', ['dolar' => $dolar]);
    })->name('contato');

    Route::get('/sucesso', function () {
        return view('site.sucesso');
    })->name('sucesso');

    Route::post('/site/email/send', 'SiteController@sendEmailSite')->name('site-contact');

    Route::get('/retorno', 'StatusController@cadastrar');
    Route::get('/produtos/add', function () {
        return view('usuario.addestoque');
    })->name('add-produto');

    Route::get('/cadastrar-se', function() {
        return view('site.cadastro_social');
    })->name('cadastre_se');
});


// Views do painel administrativo
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/pessoas', 'PessoaController@index')->name('pessoas')->middleware('auth');
    Route::get('/pessoas/add', 'PessoaController@add')->name('pessoas.add');
    Route::get('/pessoas/show/{id}', 'PessoaController@show')->name('pessoas-show');
    Route::get('/pessoas/edit/{id}', 'PessoaController@edit')->name('pessoas.edit');
    Route::delete('/pessoas/delete/{id}', 'PessoaController@destroy')->name('pessoa-delete');

    //estoque
    Route::get('/estoqueGeral', 'EstoqueController@estoqueAdmin')->name('estoqueAdmin');
    Route::get('admin/estoque/add', 'EstoqueController@addAdmin')->name('estoqueAddAdmin');
    Route::get('/estoque/showAdmin', 'EstoqueController@showAdmin')->name('estoqueShowAdmin');
    Route::get('/estoque/editAdmin', 'EstoqueController@editAdmin')->name('estoqueEditAdmin');
    Route::post('/estoque/update/{suite}', 'EstoqueController@updateProduto')->name('update-estoque');
    Route::post('/produtos/upload', 'EstoqueController@uploadEstoque')->name('upload-estoque');
    Route::post('/produtos/local/upload', 'EstoqueImagemController@getImage')->name('upload-estoque');
    Route::delete('/estoque/delete/{id}', 'EstoqueController@destroy')->name('deleta-produto');
    Route::get('/produto/foto/delete/{fotoid}', 'EstoqueController@deleteImagem');

    // Envio de emails
    Route::get('/messages/direct/all', 'DirectMessageController@index')->name('send-direct-message');
    Route::post('/messages/direct/send', 'DirectMessageController@sendToAll')->name('postSend-direct-message');
    Route::post('/messages/direct/single/send', 'DirectMessageController@sendToSingle')->name('postSend-single-message');
    
    //orcamento
    Route::get('/orcamento', 'OrcamentoController@index')->name('orcamento');
    // Route::get('/orcamento/add', 'OrcamentoController@add')->name('orcamento-add');
    Route::get('/orcamento/{id}/edit', 'OrcamentoController@edit')->name('orcamento-edit');    
    Route::get('/orcamento/{id}/show', 'OrcamentoController@show')->name('orcamento-show');    
    Route::get('/orcamento/detalhe/{produto_id}', 'OrcamentoController@orcamentoDetalhe')->name('orcamento-detalhe');
    Route::delete('/orcamento/delete/{orcamento_id}', 'OrcamentoController@destroy')->name('orcamento-delete');

    // Configurações do sistema
    Route::get('/configuracoes', 'Configuracoes\ConfiguracaoController@index')->name('configuracoes');
    Route::get('/configuracoes/password/generate', 'Configuracoes\ConfiguracaoController@generatePassword')->name('generate-pass');

    // Gestão de documentos
    Route::get('/documento/delete/rg/{id}', 'Usuarios\UsuarioController@removeDocRG')->name('deletarg');
    Route::get('/documento/delete/comprovante/{id}', 'Usuarios\UsuarioController@removeDocRG')->name('deletacomprovante');

    // Dashboard do sistema
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    //manipulação de imagens
    Route::get('/rotate/left/{imgid}', 'EstoqueImagemController@rotateLeft')->name('rotateleft');
});

/* Views do painel do usuário */
Route::group(['middleware' => ['auth', 'calculadora']], function () {
    Route::get('/usuario/home', 'Usuarios\UsuarioController@renderHome')->name('home');

    Route::get('/usuario/perfil/{id}', 'Usuarios\UsuarioController@perfil')->name('perfil');
    Route::get('/usuario/perfil/edit/{id}', 'Usuarios\UsuarioController@perfilEdit')->name('perfil-edit');

    Route::get('/usuario/estoque', 'EstoqueController@exibeEstoqueUsuario')->name('estoque');
    Route::post('/usuario/estoque', 'EstoqueController@cadastrar');

    Route::get('/usuario/fotos', function () {
        return view('usuario.fotos');
    })->name('fotos');

    Route::get('/usuario/carrinho', function () {
        return view('usuario.carrinho');
    })->name('carrinho');

    Route::get('/usuario/orcamentos', function () {
        return view('usuario.orcamentos');
    })->name('orcamentos');

    Route::get('/usuario/enviados', 'Usuarios\EnviadosController@index')->name('enviados');

    Route::get('/usuario/suporte', 'SuporteController@index')->name('tickets');
    Route::get('/usuario/suporte/add', 'SuporteController@create')->name('ticketadd');
    Route::post('usuario/suporte/add', 'SuporteController@store');
    Route::get('/usuario/suporte/{ticket_id}', 'SuporteController@show')->name('ticketshow');
    Route::get('/admin/suporte/{ticket_id}', 'SuporteController@adminShow')->name('ticketadminshow');
    Route::post('/usuario/suporte/resposta', 'CommentsController@postComment')->name('ticketresponse');
    Route::get('/suporte/{ticket_id}/close', 'SuporteController@closeTicket')->name('closeticket');
    Route::get('/suporte/{ticket_id}/open', 'SuporteController@openTicket')->name('openticket');
    Route::get('/admin/suporte', 'SuporteController@adminIndex')->name('ticketadmin');

    // Estoque
    Route::get('/estoque/{id}', 'EstoqueController@exibeEstoqueUsuario');
    Route::post('/estoque', 'EstoqueController@cadastrar');
    Route::post('/estoque/update/{seq_produto}', 'EstoqueController@updateStatus');
    Route::get('/estoque/edit/{seq_produto}', 'EstoqueController@edit')->name('editarproduto');
    Route::get('/estoque/{suite}/{produto}', 'EstoqueController@produtoEdit')->name('edit-produto');
    Route::post('/estoque/produto/{seq_produto}', 'EstoqueController@alteraQuantidade');
    Route::post('/produtos/upload', 'EstoqueController@uploadEstoque')->name('upload-estoque');
    Route::get('/estoque/adiciona/quantidade/{seq_produto}/produto', 'EstoqueController@removeProduto')->name('remove-item');
    Route::delete('/estoque/delete/{id}', 'EstoqueController@destroy')->name('deleta-produto-usuario');
    Route::put('/estoque/update/produto/{idproduto}', 'EstoqueController@updateProduto')->name('update-estoque-usuario');
    
    // Carrinho
    Route::get('usuario/carrinho', 'OrcamentoController@cartIndex')->name('user-carrinho');
    Route::get('/carrinho/atualiza/{produto}/quantidade', 'OrcamentoController@mudaQuantidade');

    // Endereços
    Route::get('/enderecos', 'EnderecosController@index')->middleware('auth');
    Route::get('/enderecos/add', 'EnderecosController@add');
    Route::get('/enderecos/show', 'EnderecosController@show');
    Route::get('/enderecos/edit', 'EnderecosController@edit');

    //compra assistida
    Route::get('/compra-assistida', 'CompraAssistidaController@index')->name('compra.main');
    Route::get('/compra-assistida/add', 'CompraAssistidaController@add')->name('compra.add');
    Route::post('/compra-assistida/save/{itemid}', 'CompraAssistidaController@store')->name('compra.save');
    Route::post('/compra-assistida/additems', 'CompraAssistidaController@addItems')->name('compra.additem');
    Route::post('/compra-assistida/updateitem', 'CompraAssistidaController@updateItems')->name('compra.updateitem');
    Route::post('/compra-assistida/removeitems', 'CompraAssistidaController@removeItems')->name('compra.removeitem');
    Route::get('/compra-assistida/edit/{id}', 'CompraAssistidaController@edit')->name('compra.edit');

    // Orcamentos
    Route::post('/orcamento', 'OrcamentoController@geraOrcamento');
    Route::get('/orcamento/usuario/{id}/edit', 'OrcamentoController@editUsuario')->name('orcamento-edit-usuario');
    Route::get('/orcamento/usuario/detalhe/{produto_id}', 'OrcamentoController@orcamentoDetalheUsuario')->name('orcamento-detalhe-usuario');
    Route::put('/orcamento/{id}', 'OrcamentoController@update')->name('update-orcamento');
    Route::delete('/cancelar/orcamento/{id}', 'OrcamentoController@cancelaOrcamento')->name('orcamento.cancelar');
    Route::get('/orcamento/show/{id}', 'OrcamentoController@show')->name('orcamento.show');
    // Route::post('/orcamento/remove/produto/{id}', 'OrcamentoController@removeProduto')->name('removeproduto');

    // Rotas de pagamento e recibo
    Route::get('/invoice/{orcamento}', 'PaymentController@invoice')->name('pagamento-invoice');
    Route::post('/invoice/payment/{orcamento}', 'PaymentController@pay')->name('payment');
    Route::get('/invoice/payment/status', 'PaymentController@getStatus')->name('status');
    Route::get('/invoice/payment/recibo/{id}', 'PaymentController@geraRecibo')->name('recibo');
    Route::get('/invoice/pdf/{id}', 'PaymentController@toPDF')->name('gerapdf');
    Route::get('/payment/{suite}/enable', 'Usuarios\UsuarioController@enablePayment')->name('enable-payment');
    Route::get('/payment/{suite}/disable', 'Usuarios\UsuarioController@disablePayment')->name('disable-payment');

    Route::get('/usuario/calculadora', 'Usuarios\UsuarioController@price')->name('calculadora');

    Route::get('/usuario/tutorial', function () {
        return view('usuario.tutorial');
    })->name('tutorial');
});

Route::get('/login', function () {
    return view('usuario.login');
})->name('login');

Route::get('/dolar', 'Usuarios\UsuarioController@dolarTest');

Route::post('/login', 'Usuarios\UsuarioController@login');
Route::get('/logout', 'Usuarios\UsuarioController@logout')->name('logout');

Route::get('/reset/password', 'Usuarios\UsuarioController@sendEmailReset')->name('send-reset');
Route::get('/reset/{token}/{id}', 'Usuarios\UsuarioController@viewResetForm')->name('view-reset');
Route::post('/reset/password', 'Usuarios\UsuarioController@resetPassword')->name('post-reset');

Route::get('/retornaSuite', 'Usuarios\UsuarioController@gerarSuite');
Route::get('/retornafrete', 'Usuarios\UsuarioController@price');
Route::post('/calcular', 'Usuarios\UsuarioController@getFrete')->name('calcular');
Route::get('/calculadora', function () {
    $dolar = DB::select('select cfg_dolar from bxby_configurations');
    return view('site.calculadora', ['dolar' => $dolar]);
})->name('calculadora-site');

Route::get('/calculadora/clear', 'Usuarios\UsuarioController@clearFrete');

Route::get('/bxby/chat', function() {
    return view('chat.main');
});


// Rotas d eteste
Route::get('/pacote/{tracknumber}', 'Usuarios\UsuarioController@rastreiaPacote');
