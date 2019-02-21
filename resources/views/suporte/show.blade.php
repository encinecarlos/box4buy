@extends('base.usuario-base')

@section('content')   
    <div class="box box-info">
        <div class="box-header">
            <h4>BXB_{{ $ticket->ticket_id }} - {{ $ticket->title }}</h4>
            <p><b>Chamado aberto por:</b> {{ $ticket->user->nome_completo }}</p>
            <div class="box-tools">
                <button type="button" id="{{ $ticket->ticket_id }}" class="btn btn-danger pull-right closeticket"><i class="fa fa-close"></i> Encerrar chamado</button>
            </div>
        </div>

        <div class="box-body">
            <p>{{ $ticket->message }}</p>
            <p><b>Categoria: </b>{{ $categoria->name }}</p>
            <p>
                <b>Status:</b>
                @switch($ticket->status)
                    @case('aberto')
                        <span class="label label-success chamadostatus">Aberto</span>
                        @break
                    {{-- @case('respondido')
                        <span class="label label-info chamadostatus">Respondido</span>
                        @break --}}
                    @case('fechado')
                        <span class="label label-danger chamadostatus">Fechado</span>
                        @break                                
                @endswitch
            </p>
        </div>
    </div>

    @if($respostas->isEmpty())
    <div class="alert alert-warning">
        <h4 class="text-center">Nenhuma resposta para este chamado</h4>
    </div>
    @else
        @foreach ($respostas as $resposta)
            <div class="box box-info">
            <div class="box-header">
                <h4><i class="fa fa-user"></i> {{ $resposta->user->nome_completo }}</h4>
                <b>@switch($resposta->user->type_user)
                    @case(1)
                        Admin
                        @break
                    @case(2)
                        Cliente
                        @break
                    @default
                        Cliente
                @endswitch</b>
                <div class="box-tools">{{ $resposta->created_at->format('d/m/Y') }} ({{ $resposta->created_at->format('h:i:s') }})</div>
            </div>

            <div class="box-body">
                <p>{!! $resposta->comment !!}</p>                                
            </div>
        </div>
        @endforeach
        
    @endif    

    <div class="box box-info">
        <div class="box-header">
            <h4>Enviar Resposta</h4>
        </div>
        <div class="box-body">
            <form action="{{ route('ticketresponse') }}" class="form-horizontal" method="POST">
                @csrf
                <input type="hidden" name="ticket_id" value="{{ $ticket->ticket_id }}">
                <div class="form-group">
                    <div class="col-sm-11">
                        <textarea name="resposta" cols="30" rows="10" class="form-control"></textarea>
                    </div>                    
                </div>
                <div class="form-group">
                    <div class="col-sm-11">
                        <button type="submit" class="btn btn-info boxColorTema pull-right">Responder</button>                        
                    </div>                    
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('js')
    <script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
    <script src='{{ asset('js/tinymce/tinymce.min.js') }}'></script>
    <script src="{{ asset('js/suporte.js') }}"></script>
@endsection