<section id="login">
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-center titulo-modal-cadastro">ÁREA DO CLIENTE</h4>
                    <button type="button" class="close btn_fechar_modal" data-dismiss="modal" aria-label="Close">
                        <span class="fa fa-times" aria-hidden="true"></span>
                    </button>
                </div>
                <div id="div-forms">
                    <form id="login-form" class="form-ajax" action="{{route('login')}}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <label for="email">E-mail</label>
                            <input id="login_username" name="email" class="form-control" type="email" required>
                            <label for="password">Senha</label>
                            <input id="login_password" name="password" class="form-control" type="password" required>

                            <a id="esqueci-senha" data-toggle="modal" data-dismiss="modal" aria-label="Close" data-target="#esqueciSenha">Esqueci minha senha</a>
                        </div>
                        <div class="modal-footer col-btn-footer text-center">
                            <div>
                                <button type="submit" id="send-login" class="btn btn-success">Entrar</button>
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <div class="footer-informativo">
                                <a>Não é registrado ainda?</a>&nbsp;&nbsp;
                                <button type="button" data-toggle="modal" data-dismiss="modal" aria-label="Close" data-target="#cadastro-modal" class="btn btn-link">CADASTRAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- Modal Senha --}}

<div class="modal fade" id="esqueciSenha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" id="modal_esqueci_senha" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-center titulo-modal-cadastro">ESQUECI A SENHA</h4>
                <button type="button" class="close btn_fechar_modal" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times" aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="reset-form" action="{{ route('send-reset') }}">
                    <label for="email-esqueci">E-mail</label>
                    <input id="esqueci_email" name="email-esqueci" class="form-control" type="email" required>
                    <div class="form-group">
                        <input type="submit" value="PROSSEGUIR" class="btn btn-primary">    
                    </div>
                </form>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Prosseguir</button>
            </div> --}}
        </div>
    </div>
</div>