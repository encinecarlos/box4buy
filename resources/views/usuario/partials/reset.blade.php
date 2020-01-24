<div class="modal custom-modal" id="resetsenha">
    <div class="bxb-header">
        <h4 class="text-center">
            REDEFINIR SENHA
            <a href="#" rel="modal:close" class="close"><i class="fa fa-close fa-inverse"></i></a>
        </h4>
    </div>
    <div class="bxb-body">
        <form id="reset-form" action="{{ route('send-reset') }}">
            <div class="form-group">
                <p><small class="text-muted">Informe o endereço de E-mail cadastrado em nosso sistema para enviarmos o link de recuperação de senha</small></p>
                <label for="email-esqueci">E-mail </label>
                <input id="esqueci_email" name="email-esqueci" class="form-control" type="email" required>
            </div>

            <div class="form-group">
                <input type="submit" value="PROSSEGUIR" class="btn btn-primary btn-rounded">
            </div>
        </form>
    </div>

</div>
