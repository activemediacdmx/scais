<div class="modal fade" id="myModalRol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">
										Inicializar y Sincronizar sistema
								</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
							<form role="form" id="sync_system">
								<div class="panel panel-primary">
									<div class="panel-body">
                    Para inicializar el sistema, el sistema remoto debe establecer la variable LOGIN_EXT_LOC en "EXTERNO" y el system SYSTEM_KEY debe de establecerse
                    igual que la SYSTEM_KEY generada por <?=env('APP_NAME')?>, asi mismo  la SYSTEM_ID debe corresponder al id del sistema de <?=env('APP_NAME')?> y la
                    variable EXT_LOGIN debera setearse a <?=env('APP_URL')?>webhook/auth . para continuar ingrese el SYSTEM KEY del sistema para confirmar la accón.<br><br>
                    <div class="form-group">
                    <label for="system_key">System Key</label>
                    <input id="system_key" name="system_key" type="text" class="form-control" placeholder="System Key" value="">
                    </div>
									</div>
								</div>
							</form>
            </div>
						<div class="modal-footer">
              <button type="button" data-function="<?=$id_sistema?>" class="init_sync btn btn-primary" id="sys_js_fn_18">Inicializar</button>
							<button  data-dismiss="modal" class="close_sync btn btn-secondary" type="button">Cancelar</button>
						</div>
        </div>
    </div>
</div>
