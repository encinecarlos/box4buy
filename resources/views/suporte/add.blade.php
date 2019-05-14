@extends(((Auth::user()->type_user == '2') ? 'base.usuario-base' : 'base.base'))

@section('content')
    <div class="box box-info">
        <div class="box-header">
            <h4>Abrir Novo Chamado</h4>
        </div>
        <div class="box-body">            
            <form class="form-horizontal" action="{{ route('ticketadd') }}" method="POST">
                @csrf                
                {{--<div class="form-group">
                    <label class="control-label col-sm-2">Assunto:</label>
                    <div class="col-sm-9">
                        <input type="text" name="subject" class="form-control">
                    </div>
                </div>--}}

                {{--<div class="form-group">
                    <label class="control-label col-sm-2">Categoria:</label>
                    <div class="col-sm-9">
                        <select name="category" class="form-control">
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                            @endforeach
                        </select>
                    </div>                    
                </div>--}}

                {{--<div class="form-group">
                    <label class="control-label col-sm-2">Prioridade:</label>
                    <div class="col-sm-9">
                        <select name="priority" class="form-control">
                            <option value="">Selecione</option>
                            <option value="alta">Alta</option>
                            <option value="media">Média</option>
                            <option value="baixa">Baixa</option>
                        </select>
                    </div>
                </div>--}}

                <div class="form-group">
                    <label class="control-label col-sm-2">Mensagem:</label>
                    <div class="col-sm-9">
                        <textarea name="message" class="form-control" cols="30" rows="10"></textarea>
                    </div>                    
                </div>
                <div class="form-group">
                    <div class="col-sm-11">
                        <button type="submit" class="btn btn-info boxColorTema">Enviar Mensagem</button>
                    </div>                    
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
