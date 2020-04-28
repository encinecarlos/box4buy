$(document).ready(function () {

    $.modal.defaults = {
        fadeDuration: 200,
        clickClose: true,
        escapeClose: true
    };

    // mascara para os inputs    
    $('.money').maskMoney();

    var seq_id;
    var pesototal = 0;
    var quantidadetotal = 0;


    $('.qt').click(function () {

        seq_id = this.id;
        var qtde = $('#qtde-' + seq_id).val();

        axios.post('/estoque/produto/' + seq_id, { qtenvio: qtde }).then(response => {
            Swal({
                title: 'Sucesso!',
                text: 'Seu produto foi adicionado ao carrinho.',
                type: 'success',
                confirmButtonText: 'OK',
                onClose: reloadpage
            });
        });
    });

    /*$('#linha_seguro').hide();
    $('select[name="codigo_pacote"]').change(function () {
        if ($('select[name="codigo_pacote"]').val() === 2 || $('select[name="codigo_pacote"]').val() === 3) {
            $('#linha_seguro').show();
        } else {
            $('#linha_seguro').hide();
        }
    });*/

    if ($('#peso-total').val() > 4) {
        $('select[name="codigo_pacote"] option:first-child').remove();
        $('#linha_seguro').show();
    }
    // verifica dados do orçamento
    $('#solicita_orcamento').click(function () {
        var suite, pacote, seguro, endereco, nota_fiscal, propaganda, caixas, sacolas, etiquetas, valor_declarado;
        pacote = $('select[name="codigo_pacote"]');
        seguro = $('select[name="seguro"]');
        endereco = $('select[name="codigo_endereco"]');
        suite = $(this).data('suite');
        var totalItens = 0;

        axios.get('/api/endereco/' + endereco.val() + '/' + suite).then(response => {
            nota_fiscal = $('select[name="envianf"]');
            propaganda = $('select[name="enviapropaganda"]');
            caixas = $('select[name="caixaoriginal"]');
            sacolas = $('select[name="sacolaoriginal"]');
            etiquetas = $('select[name="etiquetaoriginal"]');
            protecao_extra = $('select[name="protecao_extra"]');
            $('#address_id').val(endereco.val());

            valor_declarado = $('input[name="valor_declarado[]"]');
            valor_declarado.each(function (e) {
                var idvalor = $(this).attr('id');
                $('.valor-' + idvalor).prepend($(this).val());
            });

            $('#ver_pacote').prepend(pacote.children(':selected').text());
            // $('#ver_seguro').prepend(seguro == 1 ? 'Sim' : 'Não');
            $('#ver_seguro').prepend(seguro.children(':selected').text());
            $('#vernf').prepend(nota_fiscal.children(':selected').text());
            $('#verpropaganda').prepend(propaganda.children(':selected').text());
            $('#vercaixas').prepend(caixas.children(':selected').text());
            $('#versacolas').prepend(sacolas.children(':selected').text());
            $('#veretiquetas').prepend(etiquetas.children(':selected').text());
            $('#verfitaextra').prepend(protecao_extra.children(':selected').text());
            // $('.valor').prepend();

            $('#newendereco').prepend(response.data[0].endereco);
            $('#newnumero').prepend(response.data[0].numero);
            $('#newbairro').prepend(response.data[0].bairro);
            $('#newcidade').prepend(response.data[0].cidade);
            $('#newestado').prepend(response.data[0].estado);
            $('#newcomplemento').prepend(response.data[0].complemento);
            $('#newpais').prepend(response.data[0].pais == 'BR' ? 'Brasil' : '');
            $('#newcep').prepend(response.data[0].codigo_postal);


            var arr = document.getElementsByName('valor_declarado[]');
            var totalItens = $('.qtde-produto');
            var total = [];
            var sumItens = 0;

            // totalItens.each(function() {
            //     total.push()
            // });

            for (var i = 0; i < arr.length; i++) {
                if (parseFloat(arr[i].value)) {
                    console.log("itens: " + totalItens[i].value);
                    total[i] = parseFloat(arr[i].value.replace(',', '.')) * parseFloat(totalItens[i].value.replace(',', '.'));
                    sumItens += total[i];
                }
            }


            $('#ver_total_declarado').prepend(parseFloat(sumItens) + ' USD');
            $('#total-declarado').val(sumItens);

        });

        $('#verificadados').on($.modal.AFTER_CLOSE, function () {
            $('#ver_pacote').empty();
            $('#ver_seguro').empty();
            $('#vernf').empty();
            $('#verpropaganda').empty();
            $('#vercaixas').empty();
            $('#versacolas').empty();
            $('#veretiquetas').empty();
            // $('#ver_valor_declarado').empty();
            valor_declarado.each(function (e) {
                var idvalor = $(this).attr('id');
                $('.valor-' + idvalor).empty();
            });
            $('#ver_total_declarado').empty();
            $('#address_id').empty();
        });
    });

    $('#dados-entrega').click(function () {
        var codsuite = $('#solicita_orcamento').data('suite');
        var address_id = $('#address_id').val();

        axios.get('/api/endereco/' + address_id + '/' + codsuite).then(response => {
            console.log(response);
            $('#editendereco').val(response.data[0].endereco);
            $('#editnumero').val(response.data[0].numero);
            $('#editbairro').val(response.data[0].bairro);
            $('#editcidade').val(response.data[0].cidade);
            $('#editestado').val(response.data[0].estado);
            $('#editcomplemento').val(response.data[0].complemento);
            $('#editpais').val(response.data[0].pais);
            $('#editcep').val(response.data[0].codigo_postal);
        });
    });

    var btnEndereco = $('#send-delivery');


    btnEndereco.on('click', function (event) {
        event.preventDefault();
        var codsuite = $('#solicita_orcamento').data('suite');
        var address_id = $('#address_id').val();
        var enderecoForm = $('#form-delivery');
        var dataEndereco = enderecoForm.serialize();

        axios.put('/api/endereco/update/' + address_id, dataEndereco).then(response => {
            toastr.success(response.data.msg);
            setTimeout(function () {
                $.modal.close();
            }, 3500);
        });
    });

    $('.changeqtd').click(function () {
        var produto_id = this.id;
        var quantidade = $('#edita-' + produto_id).val();
        var produto_data = $(this).data('produto');

        axios.get('/carrinho/atualiza/' + produto_id + '/quantidade?quantidade=' + quantidade+'&produto_id='+produto_data).then(response => {
            Swal({
                title: 'Sucesso!',
                text: 'Quantidade atualizada com sucesso.',
                type: 'success',
                confirmButtonText: 'OK',
                onClose: reloadpage
            });
        });
    });

    // Remove produto do carrinho
    $('.removeproduto').click(function (e) {
        e.preventDefault();
        var produtoid = $(this).data('product');
        var sess_id = this.id;

        var url = '/estoque/adiciona/quantidade/' + sess_id + '/produto?prod_id=' + produtoid;
        console.log(url);

        axios.get(url).then(response => {
            Swal({
                title: 'Sucesso!',
                text: 'Produto removido.',
                type: 'success',
                confirmButtonText: 'OK',
            }).then(result => {
                if (result.value) {
                    location.href = '/usuario/estoque'
                }
            });
        });
    });

    // processa orçamento
    $('#geraorcamento').click(function () {
        var orcamento = $('#frm-orcamento');
        var data = orcamento.serialize();

        axios.post('/orcamento', data).then(response => {
            $('#itens-total').val('');
            $('#peso-total').val('');

            if (response.data.status === '1') {
                $.modal.close();
                Swal({
                    title: 'Sucesso!',
                    text: response.data.msg,
                    type: 'success',
                    confirmButtonText: 'OK',
                }).then(result => {
                    if (result.value) {
                        location.href = location.origin + '/usuario/estoque';
                    }
                });
            } else {
                $.modal.close();
                Swal({
                    title: 'Tivemos um problema!',
                    text: response.data.msg,
                    type: 'error',
                    confirmButtonText: 'OK',
                }).then(result => {
                    if (result.value) {
                        location.reload();
                    }
                });
            }
        }).catch(error => {
            var erros = error.response.data.errors;

            for (erro in erros) {
                $('#list-error').append('<li>' + erros[erro][0] + '</li>')
            }

            $.modal.close();
            $('html, body').animate({ scrollTop: 0 }, 1000);
            $('.alert-errors').removeClass('hide');

            setTimeout(() => {
                $('.alert-errors').addClass('hide');
                $('#list-error').empty();
            }, 10000);
        });
    });

    // Calcula os valores da box
    $('#calcularvalor').click(function () {
        var frete = $('#frete').val();
        var valorseguro = $('#seguro-valor').val();
        var taxabox = $('#taxabox').val();

        if (valorseguro === '') {
            valorseguro = 0;
        }

        var valortotal = parseFloat(frete) + parseFloat(valorseguro) + parseFloat(taxabox);
        var taxa = (valortotal / 100) * 5;
        var valorfinal = valortotal + taxa;
        $('#subtotal').val(valorfinal.toFixed(2));
    });

    // Atualiza o orçamento com os valores para o cliente
    $('#update-orcamento').click(function () {
        var seq_id = $('#seq').val();
        var form = $('#orcamento-update');
        var data = form.serialize();

        axios.put('/orcamento/' + seq_id, data).then(response => {
            if (response.data.status === '1') {
                Swal({
                    text: 'Atualizado com sucesso!.',
                    type: 'success',
                    confirmButtonText: 'OK',
                    onClose: reloadpage
                }).then(result => {
                    if (result.value) {
                        location.reload();
                    }
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
            }, 10000);
        });
    });

    function reloadpage()
    {
        location.reload();
    }

    // Deleta ou cancela um orçamento
    $('.or-delete').click(function () {
        var orcamentoid = $(this).data('orcamento');
        axios.delete('/admin/orcamento/delete/' + orcamentoid).then(response => {
            Swal({
                title: 'Sucesso!',
                text: response.data.msg,
                type: 'success',
                confirmButtonText: 'OK',
                onClose: reloadpage
            });
        });
    });

    $('.orcamento-cancelar').click(function() {
        var orcamentoid = $(this).data('orcamento');

        Swal.fire({
            title: 'Você tem certeza disso?',
            text: 'Deseja cancelar este orçamento?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim',
            confirmButtonColor: '#d33',
            cancelButtonText: 'Não',
        }).then(result => {
           if(result.value) {
               axios.delete('/cancelar/orcamento/'+orcamentoid).then(response => {
                   Swal({
                       title: 'Sucesso!',
                       text: 'Orcamento cancelado com sucesso!',
                       type: 'success',
                       confirmButtonText: 'OK',
                       onClose: reloadpage
                   });
               });
           }
        });

    });

});
