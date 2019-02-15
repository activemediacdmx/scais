<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Desloguear</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
							La siguiente accion elimina la session activa del usuario, lo cual lo obligará a loguearse nuevamente.
							<br><br>¿Está seguro de continuar con esta acción?
            </div>
						<div class="modal-footer">
							<button id="comm_js_fn_06" data-function="<?=$id_usuario?>" class="btn btn-light-green waves-effect waves-light" type="button">Desloguear usuario</button>
							<button  data-dismiss="modal" class="btn btn-git waves-effect waves-light" type="button">Cerrar</button>
						</div>
        </div>
    </div>
</div>
