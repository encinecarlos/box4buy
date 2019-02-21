$('.alert-errors').hide();

$('.date').inputmask("99/99/9999");
// var date = document.getElementById('date');
// Inputmask('99/99/9999').mask(date);

// $('#form-dados input').prop('readonly', true);
// $('#form-dados select').css('display', 'none');


$(document).ready(function () {
    toastr.options.timeOut = 3000;

    // Desabilita enter nos forms
    $("form").keypress(function (event) {
        if (!$('form').hasClass('noenter')) {
            if (event.keyCode === 10 || event.keyCode === 13) {
                event.preventDefault();
                console.log("ENTER PRESSIONADO");
            }
        }
    })


    $('#send-cadastro').on('click', function (event) {
        event.preventDefault();

        var form = $('.form-ajax');

        let data = form.serialize();

        axios.post('/api/usuario/new', data).then(response => {
            window.location = '/sucesso';
        }).catch(error => {
            var erros = error.response.data.errors;

            for (erro in erros) {
                $('#list-error').append('<li>' + erros[erro][0] + '</li>')
            }

            $('.alert-errors').show();

            setTimeout(() => {
                $('.alert-errors').hide();
                $('#list-error').empty();
            }, 10000);
        });
    });

    $('#limpa-form').click(function () {
        $('.form-ajax').trigger('reset');
    });
});