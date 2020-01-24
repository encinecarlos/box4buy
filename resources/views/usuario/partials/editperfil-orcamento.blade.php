<div class="modal custom-modal-x2" id="dados-envio">
    <div class="box box-info">
        <div class="box-header">
            <h4>ALTERAR DADOS DE ENTREGA</h4>
            <div class="box-tools">
                <a href="#" class="close" rel="modal:close"><i class="fa fa-close"></i></a>
            </div>
        </div>
        <div class="box-body">
            <form class="form-horizontal" id="form-delivery" method="post">
                @method('PUT')
                    <div class="box-body">
                        <div class="form-group notMarging">
                            <div class="form-group notMarging">
                                <label class="col-sm-2 control-label">
                                    Nome
                                </label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="editnome" disabled name="_nome" placeholder="Nome" type="text" value="{{ Auth::user()->nome_completo }}">                                    
                                </div>                                
                                <label class="col-sm-2 control-label">
                                    Email
                                </label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="editemail" disabled name="email" placeholder="Email" type="email" value="{{ Auth::user()->email }}">                                    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    Endereço
                                </label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="editendereco" name="newendereco" placeholder="Endereço" type="text">                
                                </div>
                                <label class="col-sm-2 control-label">
                                    Nº
                                </label>
                                <div class="col-sm-2">
                                    <input class="form-control" id="editnumero" name="newnumero" placeholder="Nº" type="text">                
                                </div>            
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    Bairro
                                </label>
                                <div class="col-sm-5">
                                    <input class="form-control" id="editbairro" name="newbairro" placeholder="Bairro" type="text">                
                                </div>
                                <label class="col-sm-1 control-label">
                                    Cidade
                                </label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="editcidade" name="newcidade" placeholder="Cidade" type="text">                
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    Estado
                                </label>
                                <div class="col-sm-5">
                                    <input class="form-control" id="edituf" name="newuf" placeholder="Estado" type="text">                
                                </div>
                                <label class="col-sm-1 control-label">
                                    Comp.
                                </label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="editcomplemento" name="newcomplemento" placeholder="Complemento" type="text">                
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    Pais
                                </label>
                                <div class="col-sm-5">
                                    <select name="newpais" id="editpais" class="form-control">
                                        <option value="BR">Brasil</option>                                        
                                    </select>
                                                    
                                </div>
                                <label class="col-sm-1 control-label">
                                    CEP
                                </label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="editCep" name="newcep" placeholder="CEP" type="text">                
                                </div>
                            </div>

                            <div class="form-group notMarging">
                                <label class="col-sm-2 control-label">
                                    Telefone
                                </label>
                                <div class="col-sm-4">
                                    <input class="form-control" data-inputmask='"mask": "(99) 999-9999"' data-mask="" name="telefone" placeholder="Telefone 01" type="text" value="{{ Auth::user()->contatos->telefone != '' ? Auth::user()->contatos->telefone : '' }}">                                    
                                </div>
                                <label class="col-sm-2 control-label">
                                    Celular
                                </label>
                                <div class="col-sm-4">
                                    <input class="form-control" data-inputmask='"mask": "(99) 9999-9999"' data-mask="" name="celular" placeholder="Celular 01" type="text" value="{{ Auth::user()->contatos->celular != '' ? Auth::user()->contatos->celular : '' }}">                                    
                                </div>
                            </div>
                                                        
                            <div class="form-group notMarging">
                                <label class="col-sm-2 control-label">
                                    Adicionar endereço
                                </label>
                                <div class="col-sm-4">
                                    <a href="#modalAddEndereco" class="btn btn-info boxColorTema" data-method="add" rel="modal:open" id="add-alternativo">
                                        Adicionar novo endereço
                                    </a>
                                </div>                                                                
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-1 pull-right">
                                    <button class="btn btn-info pull-right boxColorTema" id="send-delivery" type="submit">
                                        ALTERAR
                                    </button>
                                </div>
                                <div class="col-sm-1 pull-right">
                                    <a href="#" class="btn btn-info pull-right boxColorTema" rel="modal:close">
                                        CANCELAR
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            @include('usuario.partials.addendereco')
            <!-- FINAL DIV MEU PERFIL CLIENTE  -->
        </div>
    </div>
</div>