@extends('base.base')

@section('content')
    <div class="box box-info">
        <div class="box-header">
            <h4><i class="fa fa-envelope"></i> ENVIO DE E-MAILS</h4>
        </div>

        <div class="box-body">            
            @if(Session::has('msg'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-lable="Fechar"><i class="fa fa-close"></i></button>
                {{ session('msg') }}
            </div>
            @endif
            <ul class="nav nav-tabs">
                <li class="active"><a href="#multiple" data-toggle="tab" aria-expanded="true"><i class="fa fa-users"></i> MENSAGEM PARA TODOS OS USUÁRIOS</a></li>
                <li><a href="#single" data-toggle="tab" aria-expanded="false"><i class="fa fa-user"></i> MENSAGEM INDIVIDUAL</a></li>
            </ul>
            <div class="tab-content">                
                <div class="tab-pane active" id="multiple">
                    <div class="box box-info">
                        <div class="box-header">
                            <h4><i class="fa fa-users"></i> ENVIAR PARA TODOS</h4>
                        </div>

                        <div class="box-body">
                            <form id="send-multiple" enctype="multipart/form-data" action="{{ route('postSend-direct-message') }}" class="form-horizontal" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Assunto:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="subject" class="form-control">
                                    </div>
                                </div>

                                {{-- <div class="form-group">
                                    <label class="control-label col-sm-2">Categoria:</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="file">
                                    </div>                    
                                </div> --}}

                                <div class="form-group">
                                    <label class="control-label col-sm-2">Mensagem:</label>
                                    <div class="col-sm-9">
                                        <textarea name="message" class="form-control" cols="30" rows="30"></textarea>
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
                </div>

                <div class="tab-pane" id="single">
                    <div class="box box-info">
                        <div class="box-header">
                            <h4><i class="fa fa-users"></i> ENVIAR PARA UM UNICO USUÁRIO</h4>
                        </div>

                        <div class="box-body">
                            <form id="send-single" enctype="multipart/form-data" action="{{ route('postSend-single-message') }}" class="form-horizontal" method="POST">
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
                                        <select name="emailto[]" class="form-control" multiple>
                                            @foreach($emails as $email)
                                                <option value="{{ $email->email }}">[CB#{{ $email->codigo_suite }} {{ $email->nome_completo }}] - {{ $email->email }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Mensagem:</label>
                                    <div class="col-sm-9">
                                        <textarea name="message" class="form-control" cols="30" rows="30"></textarea>
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
                </div>
            </div>
                        
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('bower_components/axios/dist/axios.js') }}"></script>
    <script src='{{ asset('js/tinymce/tinymce.min.js') }}'></script>    
    <script>
        function elFinderBrowser (field_name, url, type, win) {
                tinymce.activeEditor.windowManager.open({
                file: '<?= route('elfinder.tinymce4') ?>',// use an absolute path!
                title: 'Selecionar Imagem',
                width: 1170,
                height: 450,
                resizable: 'yes'
            }, {
                setUrl: function (url) {
                    win.document.getElementById(field_name).value = url;
                }
            });
            return false;
    }

    tinymce.init({
        selector: 'textarea',
        height: "350",
        // invalid_elements: 'img',
        toolbar: 'bold italic | alignleft aligncenter alignright | image',
        plugins: "image",
        relative_urls : false,
        remove_script_host : false,
        convert_urls : true,
        image_title: true,
        menubar: false,
        statusbar: false,
        automatic_uploads: true,
        file_picker_types: 'image',
        file_browser_callback : elFinderBrowser        
    });
    
    </script>
    @if(Session::has('msg'))
        <script>
            toastr.success({!! session('msg') !!})                
        </script>
    @endif
@endsection