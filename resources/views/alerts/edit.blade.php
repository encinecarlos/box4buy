@extends('base.base')

@section('content')
    <div class="box box-info">
        <div class="box-header">
            <h4>ATUALIZAR ANÚNCIO</h4>
            <div class="box-tools">
                <a href="{{ url()->route('alerts.all') }}" class="btn btn-default btn-rounded">
                    <i class="fa fa-arrow-left"></i>
                    Voltar
                </a>
            </div>
        </div>
        <div class="box-body">
            <form enctype="multipart/form-data"
                  class="form-horizontal"
                  id="post-alert"
                  method="POST">
                @csrf
                <div class="form-group">
                    <label for="title" class="control-label col-sm-2">Titulo:</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" id="title" class="form-control" value="{{ $alert->title }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Texto:</label>
                    <div class="col-sm-9">
                        <textarea name="description" class="form-control" cols="30" rows="30">{!! $alert->description !!}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-11">
                        <button id="alert-save"
                                type="button"
                                onclick="updateAlert({{ $alert->sequencia }})"
                                class="btn btn-info btn-rounded pull-right btn-lg btn-rounded boxColorTema">
                            <i class="fa fa-send"></i>
                            postar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')

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
            content_css: '{{ asset('css/bootstrap/bootstrap.min.css') }}',
            // invalid_elements: 'img',
            toolbar: 'formatselect | bold italic | alignleft aligncenter alignright | link media image | numlist bullist',
            plugins: "image searchreplace autolink directionality visualblocks visualchars link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern",
            relative_urls : false,
            remove_script_host : false,
            convert_urls : true,
            image_title: true,
            menubar: false,
            statusbar: false,
            automatic_uploads: true,
            file_picker_types: 'image',
            image_class_list: [
                {title: 'img-responsive', value: 'img-responsive'},
            ],
            file_browser_callback : elFinderBrowser
        });

        function updateAlert(id) {
            var token = $('input[name="_token"]').val();
            var title = $('#title').val();
            var description = tinymce.get('description').getContent();
            // console.log(teste);
            axios.put('/admin/alerts/update/'+id, {'_token': token, 'title': title, 'description': description}).then(response => {
                Swal({
                    title: 'Tudo certo',
                    text: response.data,
                    type: 'success',
                    confirmButtonText: 'OK',
                    onClose: location.href
                });
            });
        }

        function clearFields(form) {
            form.trigger('reset');
        }
    </script>
@endsection
a
