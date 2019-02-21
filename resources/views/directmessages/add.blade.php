@extends('base.usuario-base')

@section('content')
    <div class="box box-info">
        <div class="box-header">
            <h4>Enviar nova mensagem</h4>
        </div>
        <div class="box-body">            
            <form class="form-horizontal" action="{{ route('ticketadd') }}" method="POST">
                @csrf                
                <div class="form-group">
                    <label class="control-label col-sm-2">Assunto:</label>
                    <div class="col-sm-9">
                        <input type="text" name="subject" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Destinatário:</label>
                    <div class="col-sm-9">
                        <select name="category" class="form-control">
                            <option value="all">Enviar para todos</option>  
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->codigo_suite }}">{{ $usuario->email }}</option>
                            @endforeach
                        </select>
                    </div>                    
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Anexo:</label>
                    <div class="col-sm-9">
                        <input type="file" name="anexo">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Mensagem:</label>
                    <div class="col-sm-9">
                        <textarea name="message" class="form-control" id="message" cols="30" rows="10"></textarea>
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

@section('js')
    <script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
    <script src='{{ asset('js/tinymce/tinymce.min.js') }}'></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'link',
            toolbar: 'bold italic | alignleft aligncenter alignright | link unlink',
            menubar: false,
            statusbar: false
        });
    </script>
@endsection