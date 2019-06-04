$('.alert-errors').hide();

$('.date').inputmask("99/99/9999");
if($('div').hasClass('money')) {
    $('.money').maskMoney();
}

$(document).ready(function () {
    // toastr.options.timeOut = 3000;
    $.modal.defaults = {
        fadeDuration: 200,
        escapeClose: true,
        clickClose: false,
        showClose: false
    };

    // Desabilita enter nos forms    
    $("form").keypress(function (event) {
        if (!$('form').hasClass('noenter')) {
            if (event.keyCode === 10 || event.keyCode === 13) {
                event.preventDefault();
                console.log("ENTER PRESSIONADO");
            }
        }
    });

    $('#send').on('click', function (event) {
        event.preventDefault();
        var form = $('.form-ajax');
        //form.validetta();
        var data = form.serialize();

        var id = location.href.split('/').pop();
        axios.put('/api/usuario/update/' + id, data).then(response => {
            Swal({
                title: 'Sucesso!',
                text: response.data.msg,
                type: 'success',
                confirmButtonText: 'OK',
                onClose: closeModal
            });
        });
    });


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

    //envia cadastro a partir do painel administrativo
    $('#send-addadmin').on('click', function (event) {
        event.preventDefault();

        var form = $('.form-ajax');

        let data = form.serialize();

        axios.post('/api/usuario/admin/new', data).then(response => {

            if (response.data.status == '1') {
                Swal({
                    title: 'Sucesso!',
                    text: response.data.msg,
                    type: 'success',
                    confirmButtonText: 'OK',
                    onClose: $('.form-ajax').trigger('reset')
                });

            } else {
                Swal({
                    title: 'Sucesso!',
                    text: response.data.msg,
                    type: 'success',
                    confirmButtonText: 'OK',
                });
            }
        }).catch(error => {
            var erros = error.response.data.errors;

            for (erro in erros) {
                $('#list-error').append('<li>' + erros[erro][0] + '</li>')
            }

            $('.alert-errors').show();

            setTimeout(() => {
                $('.alert-errors').hide();
                $('#list-error').empty();
            }, 5000);
        });
    });

    $('#limpa-form').click(function () {
        $('.form-ajax').trigger('reset');
    });

    // Tratamento da modal de endereço adicional
    var dialog = $('#modalEndereco');
    var addressDialog = $('#modalVerEndereco');
    var modalFoto = $('#modal-picture');
    var addressEdit = $('#edit-alternativo');
    var addressAdd = $('#add-alternativo');

    var optionId;
    $('#selectEndereco').change(function () {
        optionId = $('option:selected', this).val();
        console.log(optionId);
        let suite = location.href.split('/').pop();

        axios.get('/api/endereco/' + optionId + '/' + suite).then(response => {
            $('input[name=newendereco]').val(response.data[0].endereco);
            $('input[name=newnumero]').val(response.data[0].numero);
            $('input[name=newbairro]').val(response.data[0].bairro);
            $('input[name=newcidade]').val(response.data[0].cidade);
            $('input[name=newestado]').val(response.data[0].estado);
            $('input[name=newcomplemento]').val(response.data[0].complemento);
            $('input[name=newpais]').val(response.data[0].pais);
            $('input[name=newcep]').val(response.data[0].codigo_postal);
            console.log(response.data[0].endereco);
        });
    });

    addressAdd.on('click', function () {
        $('#form-endereco :input[type="text"]').val('');
        console.log("add clicado!");
    });

    var btnAddEndereco = $('#send-add');
    var btnEndereco = $('#send-endereco');

    btnAddEndereco.on('click', function (event) {
        event.preventDefault();
        var addForm = $('#form-enderecoadd');
        var data = addForm.serialize();

        axios.post('/api/endereco', data).then(response => {
            Swal({
                title: 'Tudo certo!',
                text: response.data.msg,
                type: 'success',
                confirmButtonText: 'OK',
                onClose: closeModal
            });

            if(Swal.isVisible())
            {
                $('#form-enderecoadd :input[type="text"]').val('');
            }
        });
    });

    btnEndereco.on('click', function (event) {
        event.preventDefault();
        var enderecoForm = $('#form-endereco');
        var dataEndereco = enderecoForm.serialize();

        axios.put('/api/endereco/update/' + optionId, dataEndereco).then(response => {
            Swal({
                title: 'Sucesso!',
                text: response.data.msg,
                type: 'success',
                confirmButtonText: 'OK',
                onClose: closeModal
            });

        });
    });

    function closeModal()
    {
        setTimeout(function () {
            $.modal.close();
        }, 3500);
    }

    $('#send-produto-user').click(function () {
        var data = $('#form-estoque').serialize();

        axios.post('/api/produtos/new', data).then(response => {
            $.modal.close();
            Swal({
                title: 'Sucesso!',
                text: response.data.msg,
                type: 'success',
                confirmButtonText: 'OK',
                onClose: reloadpage
            });
        }).catch(error => {
            var erros = error.response.data.errors;

            for (erro in erros) {
                $('#list-error').append('<li>' + erros[erro][0] + '</li>')
            }

            $('.alert-errors').show();

            setTimeout(() => {
                $('.alert-errors').hide();
                $('#list-error').empty();
            }, 5000);
        });
    });

    $('.edit-produto-user').click(function () {
        var id = $(this).data('idproduto');
        var data = $('#form-estoque-edit-' + id).serialize();
        console.log(data);
        axios.put('/estoque/update/produto/' + id, data).then(response => {
            $.modal.close();
            Swal({
                title: 'Sucesso!',
                text: response.data.msg,
                type: 'success',
                confirmButtonText: 'OK',
                onClose: reloadpage
            });
        });
    });

    function reloadpage() {
        location.href = location.href;
    }

    $('.enablepayment').click(function (e) {
        var suite = e.target.id;
        axios.get('/payment/' + suite + '/enable').then(response => {
            if (response.data.status == '1') {
                Swal({
                    title: 'Sucesso!',
                    text: response.data.msg,
                    type: 'success',
                    confirmButtonText: 'OK',
                    onClose: reloadpage
                });
            } else {
                Swal({
                    title: 'Temos um problema!',
                    text: response.data.msg,
                    type: 'error',
                    confirmButtonText: 'OK',
                    onClose: reloadpage
                });
            }

        });
    });

    $('.disablepayment').click(function (e) {
        var suite = e.target.id;
        axios.get('/payment/' + suite + '/disable').then(response => {
            if (response.data.status == '1') {
                Swal({
                    title: 'Sucesso!',
                    text: response.data.msg,
                    type: 'success',
                    confirmButtonText: 'OK',
                    onClose: reloadpage
                });
            } else {
                Swal({
                    title: 'Temos um problema!',
                    text: response.data.msg,
                    type: 'error',
                    confirmButtonText: 'OK',
                    onClose: reloadpage
                });
            }

        });
    });

    /*function removedocumento(suite) {
        var doctype = $('.removedoc').data('documento');
        if (doctype == 'rg') {
            axios.delete('/documento/delete/rg/' + id).then(response => {
                Swal({
                    title: 'Sucesso!',
                    text: response.data.msg,
                    type: 'success',
                    confirmButtonText: 'OK',
                    onClose: reloadpage
                });
            });
        } else if (doctype == 'comprovante') {
            axios.delete('/documento/delete/comprovante/' + id).then(response => {
                Swal({
                    title: 'Sucesso!',
                    text: response.data.msg,
                    type: 'success',
                    confirmButtonText: 'OK',
                    onClose: reloadpage
                });
            });
        }
    }*/

    $('.updateproduto').click(function (e) {
        var produto = e.target.id;
        var form = $('#form-produtoupdate');
        var data = form.serialize();

        axios.post('/admin/estoque/update/' + produto, data).then(response => {
            Swal({
                title: 'Sucesso!',
                text: response.data.msg,
                type: 'success',
                confirmButtonText: 'OK',
                onClose: reloadpage
            });
        });
    });

    // Deleta um orçamento da base
    $('.or-delete').click(function () {
        var orcamentoid = $(this).data('orcamento');
        var tabid = $(this).data('tab');
        Swal.fire({
            title: 'Você tem certeza disso?',
            text: 'Deseja deletar este registro?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim',
            confirmButtonColor: '#d33',
            cancelButtonText: 'Não',
        }).then(result => {
            if (result.value) {
                axios.delete('/admin/orcamento/delete/' + orcamentoid).then(response => {
                    Swal.fire({
                        title: 'Sucesso!',
                        text: response.data.msg,
                        type: 'success',
                        confirmButtonText: 'OK',
                        onClose: reloadpage
                    });
                });
            }

        });
    });

});
