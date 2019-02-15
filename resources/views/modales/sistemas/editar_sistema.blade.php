<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">
										Edición de <?php echo $datos['sis_data']->nombre; ?>
								</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
							<form role="form" id="edita_sistema">
								<div class="panel panel-primary">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												  <div class="form-group">
													<label for="nombre">Nombre</label>
													<input  id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" value="<?php echo $datos['sis_data']->nombre; ?>">
												  </div>
												  <div class="form-group">
													<label for="nombre_largo">Nombre largo</label>
													<input id="nombre_largo" name="nombre_largo" type="text" class="form-control" placeholder="Nombre Largo" value="<?php echo $datos['sis_data']->nombre_largo; ?>">
												  </div>
                          <div class="form-group">
													<label for="url">URL Base (http://dominio_o_ip/)</label>
													<input type="text" class="form-control" id="url" name="url" placeholder="URL del sistema" value="<?php echo $datos['sis_data']->url; ?>">
												  </div>
												  <div class="form-group">
													<label for="descripcion">Descripción</label>
													<textarea id="descripcion" name="descripcion" class="form-control" placeholder="Descripción" ><?php echo $datos['sis_data']->descripcion; ?></textarea>
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
								<input type="hidden" id="id_sistema" name="id_sistema" value="<?php echo $datos['sis_data']->id_sistema; ?>">
							</form>
            </div>
						<div class="modal-footer">
              <button type="button" class="btn btn-primary" id="sys_js_fn_04">Editar</button>
							<button  data-dismiss="modal" class="btn btn-secondary" type="button">Cancelar</button>
						</div>
        </div>
    </div>
</div>
