$(document).ready(function () {

    $('.produto').on('click', function (e) {
        var id = e.target.id;
        var data = $('#form-produto').serialize();
        axios.post('/estoque/update/' + id, data).then(response => {
            toastr.success("atualizado com sucesso");
        });
    });
});

// Requisição de cadastro de novo status
$('#send-status').on('click', function (event) {
    event.preventDefault();
    var statusform = $('#formstatus');

    var data = statusform.serialize();

    axios.post('/api/status/new', data).then(response => {
        toastr.success(response.data.msg);
        $('#tab-data').load(window.location.href + " #tab-data");
    });
});