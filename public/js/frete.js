$(document).ready(function () {
    //var peso = $('#pesoinput').val();
    // var data = peso.serialize();

    $('#btn-peso').click(function () {
        //console.log("Peso antes do axios: " + peso);
        //console.log(peso);
        axios.post('/calcular', { peso: $('#pesoinput').val(), rota: location.pathname }).then(response => {
            location.href = location.href;
            console.log(response.data);
        });

        // axios.get('/calculadora/clear').then(response => {
        //     console.log('cache limpo');
        // });
    });
});