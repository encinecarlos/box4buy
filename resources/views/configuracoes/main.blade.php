@extends('base.base')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-cogs"></i> CONFIGURAÇÕES DO SISTEMA</h3>
        </div>
        <div class="box-content">
            <div class="box box-info">
                <div class="box-header">
                    <h4>Alterar parametros do sistema</h4>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" action="" method="post" id="config-save">
                        @csrf
                        <input type="hidden" name="message" id="faq_data" value="">
                        <div class="box box-info">
                            <div class="box-heder">
                                <h4>Endereço nos EUA</h4>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    {{--<label class="control-label col-sm-1">Nome:</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="cfg_name" class="form-control" value="{{ $configs->cfg_name }}">
                                    </div>--}}

                                    <label class="control-label col-sm-1">Endereço:</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="cfg_address" class="form-control" value="{{ $configs->cfg_address }}">
                                    </div>

                                    <label class="control-label col-sm-1">Cidade:</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="cfg_city" class="form-control" value="{{ $configs->cfg_city }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-1">Estado:</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="cfg_state" class="form-control" value="{{ $configs->cfg_state }}">
                                    </div>

                                    <label class="control-label col-sm-1">Zip Code:</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="cfg_zipcode" class="form-control" value="{{ $configs->cfg_zipcode }}">
                                    </div>

                                    <label class="control-label col-sm-1">Telefone:</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="cfg_phone" class="form-control" value="{{ $configs->cfg_phone }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box box-info">
                            <div class="box-header">
                                <h4>Taxas Box4Buy</h4>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label col-sm-1">Taxa até 4LBS:</label>
                                    <div class="col-sm-3">
                                        <input type="text"
                                               name="taxa01"
                                               class="form-control money"
                                               value="{{ $configs->cfg_taxa_01 }}">
                                    </div>


                                    <label class="control-label col-sm-1">Taxa até 10LBS:</label>
                                    <div class="col-sm-3">
                                        <input type="text"
                                               name="taxa02"
                                               class="form-control money"
                                               value="{{ $configs->cfg_taxa_02 }}">
                                    </div>


                                    <label class="control-label col-sm-1">Taxa até 66LBS:</label>
                                    <div class="col-sm-3">
                                        <input type="text"
                                               name="taxa03"
                                               class="form-control money"
                                               value="{{ $configs->cfg_taxa_03 }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                        <div class="box box-info">
                            <div class="box-header">
                                <h4>Alterar banner da pagina principal</h4>
                            </div>
                            <div class="box-body">
                                <div class="dropzone" id="edit-banner">
                                    <input type="hidden" id="filename" name="filename" value="home">
                                    <input type="hidden" id="folder_image" name="folder_name" value="home_image">
                                    <div class="custom-dropzone">
                                        <p class="dz-message">
                                            <i class="fa fa-image"></i> tamanho mínimo 1280x768px</p>
                                    </div>
                                    <label>
                                        Usar Overlay
                                        <input type="checkbox" name="is_overlay" id="overlay" value="1">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="box box-info">
                            <div class="box-header">
                                <h4>Alterar Texto do banner principal</h4>
                            </div>
                            <div class="box-body">
                                <div class="form-group  ">
                                    <label class="control-label col-sm-2">
                                        Texto do banner:
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text"
                                               name="descricao_banner"
                                               class="form-control"
                                               value="{{ $configs->cfg_main_text }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box box-info">
                            <div class="box-header">
                                <h4>Editar pagina de duvidas</h4>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        {{--<div id="editor"></div>--}}
                                        <div id="duvidas">
                                            {!! $configs->cfg_faq !!}
                                        </div>
                                        {{--<div id="editor-container">

                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="button"
                                        class="btn btn-info btn-rounded boxColorTema save-config">
                                    <i class="fa fa-check"></i> Salvar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('base.partials.tpl')
@stop

@section('css')
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css"
          integrity="sha256-e47xOkXs1JXFbjjpoRr1/LhVcqSzRmGmPqsrUQeVs+g="
          crossorigin="anonymous" />--}}
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
    {{--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.css">--}}
    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.js"></script>--}}

    {{--<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">--}}
    {{--<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>--}}

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script
    <script src='{{ asset('js/tinymce/tinymce.min.js') }}'></script>
    <script>
        Dropzone.autoDiscover = false;
        $('.money').maskMoney();

        var template = $('#tpl').html();
        $('#tpl').hide();

        let options = {
            url: "{{ route('configuracoes.site.upload') }}",
            previewTemplate: template,
            thumbnailWidth: 250,
            thumbnailHeight: 250,
            init: function() {
                this.on('sending', function(file, xhr, formData) {
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append("filename", document.getElementById('filename').value);
                    formData.append("folder_name", document.getElementById('folder_image').value);
                    if($('#overlay').prop('checked') === true) {
                        formData.append('is_overlay', document.getElementById('overlay').value);
                    }
                });

                this.on('success', function (file, response) {
                    this.removeFile(file);
                    toastr.success("Arquivo enviado com sucesso!");
                    $('#tpl').hide();
                    setTimeout(() => {
                        location.href = location.href;
                    }, 800);
                });
            },
        };

        $('#edit-banner').dropzone(options);

        var quill = new Quill('#duvidas', {
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline'],
                    ['link','image'],
                    [{color: []}, {background: []}],
                    [{ 'font': [] }],
                    [{ 'align': [] }],
                ]
            },
            theme: 'snow',
        });

        /*$('#duvidas').summernote({
            placeholder: "Informe o conteúdo da página",
            /!*callbacks: {
                onImageUpload: function(image) {
                    editor = $(this);
                    uploadImage(image[0], editor);
                }
            }*!/
        });*/

        {{--$('#duvidas').summernote('insertImage', '{{ route('configuracoes.site.upload') }}')--}}

        /*function uploadImage(image, editor) {
            var data = new FormData();
            data.append('filename', image);
            data.append('folder_name', 'page_images');
            axios.post('{{ route('configuracoes.site.upload') }}', data).then(response => {
                var img = $('<img>').attr('src', response.data.url);
                $(editor).summernote('insertNode', img);
            });
        }

        $('#duvidas').on('summernote.image.upload', function(that, files) {
            var data = new FormData();
            data.append('filename', files[0]);
            data.append('folder_name', 'page_images');
            axios.post('{{ route('configuracoes.site.upload') }}', data).then(response => {
                var img = $('<img>').attr('src', response.data.url);
                $summernote.summernote('insertNode', img);
            });
        })*/;

        /*var editor = new Jodit('#duvidas', {
            uploader: {
                insertImageAsBase64URI: true
            },
            buttons: "|,bold,strikethrough,underline,italic,|,ul,ol,|,outdent,indent,|,font,fontsize,brush,paragraph,|,image,video,table,link,|,align,\n,|"
        });*/

        /*tinymce.init({
            selector: 'textarea',
            plugins: 'link textcolor lists',
            toolbar: 'formatselect | ' +
                'bold italic strikethrough forecolor backcolor permanentpen formatpainter | ' +
                'alignleft aligncenter alignright alignjustify | numlist bullist | ' +
                'link unlink',
            menubar: false,
            statusbar: false
        });*/
    </script>
@endsection
