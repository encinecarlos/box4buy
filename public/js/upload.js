Dropzone.autoDiscover = false;

// $('a[data-modal]').click(function () {
//     $('#modalFotoPerfil').modal({
//         showClose: false,
//         fadeDuration: 200
//     });
// });

$.modal.defaults = {
    fadeDuration: 200,
    clickClose: true,
    escapeClose: true
}

var dropzonerg = new Dropzone('#rg', {
    url: '/api/upload/docs/rg',
});

dropzonerg.on('sending', function (file, xhr, formData) {
    formData.append("id", $('#suite').val());
});

dropzonerg.on('complete', function (file) {
    dropzonerg.removeFile(file);
    toastr.success("Documento enviado com sucesso!");
    setTimeout(function () {
        $.modal.close();
    }, 2500)
});

var dropzonecomprovante = new Dropzone('#comprovante', {
    url: '/api/upload/docs/comprovante',
});

dropzonecomprovante.on('sending', function (file, xhr, formData) {
    formData.append("id", $('#suite').val());
});

dropzonecomprovante.on('complete', function (file) {
    dropzonerg.removeFile(file);
    toastr.success("Documento enviado com sucesso!");
    setTimeout(function () {
        $.modal.close();
    }, 2500)
});