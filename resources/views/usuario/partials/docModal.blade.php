<div class="modal custom-modal" id="upload-modal">
        <div class="box box-info">
            <div class="box-header">
                <h4>ENVIAR DOCUMENTOS</h4>
                <div class="box-tools">
                    <a href="#" class="close" rel="modal:close"><i class="fa fa-close"></i></a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">        
                    <div class="col-sm-12">
                        <label for="rg">COMPROVANTE DE IDENTIDADE</label>
                        <div class="dropzone" id="rg">
                            <input type="hidden" name="suite" id="suite" value="{{ Auth::user()->codigo_suite }}">
                            <div class="custom-dropzone">
                                <p class="dz-message">
                                    <i class="fa fa-file-text"></i> Envie seu RG</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label for="rg">COMPROVANTE DE ENDEREÇO</label>
                        <div class="dropzone" id="comprovante">
                            <div class="custom-dropzone">
                                <p class="dz-message">
                                    <i class="fa fa-file-text"></i> Envie seu comprovante de endereço</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    

</div>