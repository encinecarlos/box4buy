<form class="form-horizontal form-ajax noenter" id="form-cadastro" enctype="multipart/form-data" method="post">
    @csrf
    {{--<div class="alert alert-danger alert-errors">
        <ul id="list-error" style="list-style-type: none">
        </ul>
    </div>--}}
    <!-- <input type="hidden" name="nome"> -->
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="_nome" class="form-control" placeholder="Primeiro nome" autofocus>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>Sobrenome:</label>
                <input type="text" name="_sobrenome" placeholder="Ultimo nome" class="form-control" autofocus>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>E-mail:</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>Senha</label>
                <div class="div-senha">
                    <input class="form-control" type="password" id="senha" name="password"/>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>Confirmar senha</label>
                <input type="password" id="confirm-senha" name="confirm-password" class="form-control">
            </div>
        </div>
    </div>

    <div class="form-group text-center">
        <button type="submit" id="send-cadastro" class="btn btn-primary btn-rounded btn-block"><i class="fa fa-check"></i>
            Cadastrar
        </button>
    </div>
</form>
