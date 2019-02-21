@extends('base.base') @section('content')
<section id="mensagens_main">
    <div class="box box-info">
        <div class="box-header">
            <h1>Mensagem para todos</h1>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <form class="form-horizontal" action="" method="post">
                        <div class="box-body">
                            <div class="form-group text-center">
                                <div class="col-sm-12">
                                    <textarea rows="8" class="form-control input-alerta" id="inputAlerta" placeholder="Digite aqui a sua mensagem" autofocus></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <h2>Demostração</h2>
                    <div class="alert alert-info" role="alert">
                        Este é um exemplo de como será demostrado para o usuário
                    </div>
                </div>
            </div>
        </div>
</section>
@stop @section('css')
<link rel="stylesheet" href="{{asset('css/style.css')}}"> @stop