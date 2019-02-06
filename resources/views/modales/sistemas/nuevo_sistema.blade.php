<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Añadir nuevo sistema:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
							<form role="form" id="nuevo_sistema">
								<div class="panel panel-primary">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												  <div class="form-group">
													<label for="nombre">Nombre</label>
													<input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre corto del sistema">
												  </div>
                          <div class="form-group">
													<label for="nombre_largo">Nombre Largo</label>
													<input type="text" class="form-control" id="nombre_largo" name="nombre_largo" placeholder="Nombre largo del sistema">
												  </div>
                          <div class="form-group">
													<label for="url">URL Base (http://dominio_o_ip/)</label>
													<input type="text" class="form-control" id="url" name="url" placeholder="URL del sistema">
												  </div>
												  <div class="form-group">
													<label for="descripcion">Descripción</label>
													<textarea class="form-control" style="height: 117px;" id="descripcion" name="descripcion" placeholder="Descripción del sistema"></textarea>
												  </div>

                          <div class="form-group">
													<label for="cat_status_sistema">Estado del sistema</label>
													  <select  class="form-control m-input" id="cat_status_sistema" name="cat_status_sistema">
														<?php echo $datos['status_sistema']; ?>
													  </select>
												  </div>


											</div>
										</div>
									</div>
								</div>
								<div id="error_alerta" > </div>
							</form>
            </div>
						<div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cancelar
              </button>
              <button type="button" class="btn btn-primary" id="sys_js_fn_02">
                Agregar
              </button>
						</div>
        </div>
    </div>
</div>
