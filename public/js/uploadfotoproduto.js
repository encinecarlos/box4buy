// var Cropper = require('cropperjs');

Dropzone.autoDiscover = false;
$(document).ready(function () {
    var template = $('#tpl').html();
    $('#tpl').hide();
    var uploadestoque = new Dropzone('#produto-upload', {
        url: '/admin/produtos/upload',
        previewTemplate: template,
        thumbnailWidth: 250,
        thumbnailHeight: 250,
        dictDefaultMessage: "<i class='fa fa-photo'></i> Insira a foto do produto",
        autoProcessQueue: false
    });

    uploadestoque.on('addedfile', function (file) {

        var image = document.getElementById('img-editable');
        const edit = new Cropper(image);
        console.log(edit);
        $('#left').click(function(e) {
            e.preventDefault();
            console.log("teste");
            edit.rotate(-90);
        });

        $('#save').click(function (e) {
            e.preventDefault();
            uploadestoque.processQueue();
        });

        $('#tpl').show();
        // $('#viewimage').modal();
    });

    uploadestoque.on('sending', function (file, xhr, formData) {
        formData.append("produto", document.getElementById('codigo_produto').value);
        formData.append("suite", document.getElementById('codigo_suite').value);
    });

    uploadestoque.on('complete', function (file, response) {
        uploadestoque.removeFile(file);
        toastr.success("Arquivo enviado com sucesso!");
        $('#tpl').hide();
        setTimeout(() => {
            location.href = location.href;
        }, 800);
    });
});