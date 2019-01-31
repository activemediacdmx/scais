<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">
										Edición de <?php echo $datos['usuario']['nombres'].' '.$datos['usuario']['apellido_paterno'].' '.$datos['usuario']['apellido_materno']; ?>
								</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
							<form role="form" id="edita_rol_usuario">
								<div class="panel panel-primary">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-6">
												  <div class="form-group">
													<label for="id_rol">Rol</label>
													  <select class="form-control m-input" id="id_rol" name ="id_rol">
														<?php echo $datos['roles']; ?>
													  </select>
												  </div>
											</div>
										</div>
									</div>
								</div>
								<input id="id_usuario" name="id_usuario" type="hidden" value="<?php echo $datos['usuario']['id_usuario']; ?>">
                <input id="id_usuario" name="id_sistema" type="hidden" value="<?php echo $datos['id_sistema']; ?>">
							</form>
            </div>
						<div class="modal-footer">
              <button type="button" class="btn btn-primary" id="sys_js_fn_11">Editar</button>
							<button  data-dismiss="modal" class="btn btn-secondary" type="button">Cancelar</button>
						</div>
        </div>
    </div>
</div>
