Dropzone.autoDiscover = false;
var cropper = $.fn.cropper;
$(document).ready(function () {
    var template = $('#tpl').html();
    $('#tpl').hide();
    let options = {
        url: '/admin/produtos/upload',
        previewTemplate: template,
        thumbnailWidth: 250,
        thumbnailHeight: 250,
        dictDefaultMessage: "<i class='fa fa-photo'></i> Insira a foto do produto",
        init: function() {
            this.on('sending', function(file, xhr, formData) {
                formData.append("produto", document.getElementById('codigo_produto').value);
                formData.append("suite", document.getElementById('codigo_suite').value);
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
$('#produto-upload').dropzone(options);

function deleteImage(id)
{
    axios.get('/produto/foto/delete/' + id).then(response => {
        console.log(response);
    });
}


});