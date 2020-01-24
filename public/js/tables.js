$(document).ready(function () {
    var datasrc;
    axios.get('/produto/enviado').then(response => {
        datasrc = response.data;
        console.log(datasrc);
    });
    $('#prodenviado').DataTable({
        retrieve: true,
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de START até END de TOTAL registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de MAX registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "MENU resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
        "data": datasrc,
        "columns": [{
            title: "Descrição do produto"
        }, {
            title: "Codigo de Rastreio"
        }, {
            title: "Ações"
        }]
    });

});