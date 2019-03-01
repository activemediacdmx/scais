<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Nuevo Controlador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
							<form role="form" id="nuevo_modelo">
								<div class="panel panel-primary">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												  <div class="form-group">
													<label for="controlador">Controlador</label>
													<input id="controlador" name="controlador" type="text" placeholder="Controlador" class="form-control" value="">
												  </div>
												  <div class="form-group">
													<label for="metodo">Método</label>
													<input id="metodo" name="metodo" type="text" class="form-control" placeholder="Método" value="">
												  </div>
												  <div class="form-group">
													<label for="nombre">Nombre</label>
													<input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" value="">
												  </div>
												  <div class="form-group">
													<label for="descripcion">Descripción</label>
													<textarea id="descripcion" name="descripcion" type="text" class="form-control"  placeholder="Descripción"></textarea>
												  </div>
                          <div class="m-form__group form-group row">
                              <label class="col-9 col-form-label" for="set_auditable">
                                Auditar la actividad de este permiso
                              </label>
                              <div class="col-3">
                                <span class="m-switch m-switch--outline m-switch--icon m-switch--info">
                                  <label>
                                    <input id="set_auditable" name="set_auditable" type="checkbox" checked   value="">
                                    <span></span>
                                  </label>
                                </span>
                              </div>
                          </div>
											</div>
										</div>
									</div>
								</div>
                <input type="hidden" id="auditable" name="auditable" value="19">
							</form>
            </div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" id="cntr_js_fn_05">Agregar</button>
							<button  data-dismiss="modal" class="btn btn-secondary" type="button">Cancelar</button>
						</div>
        </div>
    </div>
</div>
