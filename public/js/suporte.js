$(document).ready(function () {
    $('.closeticket').click(function (e) {
        var ticket = e.target.id;
        axios.get('/suporte/' + ticket + '/close').then((response) => {
            toastr.success(response.data.msg);
            location.href = self.location;
        }).catch((err) => {
            console.error(err);
            toastr.error('Não foi possivel fechar este chamado.');
        });
    });

    $('.openticket').click(function (e) {
        var openticket = e.target.id;
        axios.get('/suporte/' + openticket + '/open').then((response) => {
            toastr.success(response.data.msg);
            location.href = self.location;
        }).catch((err) => {
            console.error(err);
            toastr.error('Não foi possivel abrir este chamado.');
        });
    });

    tinymce.init({
        selector: 'textarea',
        toolbar: 'bold italic | alignleft aligncenter alignright',
        menubar: false,
        statusbar: false
    })
});