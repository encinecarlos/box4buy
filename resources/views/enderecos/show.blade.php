@extends('base.base') @section('content')
<section id="enderecos_main">
    <div class="box box-info">
        <div class="box-header">
            <h1>Endereço de
                <span class="name_featured">{Nome do cliente}</span>
            </h1>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-6 content_show_pessoas">
                    <p>Endereço</p>
                    <p>-</p>
                </div>
                <div class="col-xs-6 content_show_pessoas">
                    <p>Número</p>
                    <p>-</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 content_show_pessoas">
                    <p>Complemento</p>
                    <p>-
                </div>
                <div class="col-xs-6 content_show_pessoas">
                    <p>CEP</p>
                    <p>-</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 content_show_pessoas">
                    <p>Cidade</p>
                    <p>-</p>
                </div>
                <div class="col-xs-6 content_show_pessoas">
                    <p>Estado</p>
                    <p>-</p>
                </div>
            </div>

            <div class="box-footer">
                <div class="box-footer">
                    <a href="{{url('/enderecos')}}" class="btn btn-default">Voltar</a>
                    <a href="{{'/enderecos/edit'}}" type="submit" class="btn btn-info pull-right">Editar</a>
                </div>
            </div>

        </div>
    </div>
</section>
@stop @section('css')
<link rel="stylesheet" href="{{asset('css/style.css')}}"> @stop