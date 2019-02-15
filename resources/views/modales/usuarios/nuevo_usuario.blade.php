<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Añadir nuevo usuario:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
							<form role="form" id="nuevo_usuario">
								<div class="panel panel-primary">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-6">
												  <div class="form-group">
													<label for="id_ubicacion">Ubicación</label>
													  <select  class="form-control m-input" id="id_ubicacion" name="id_ubicacion">
														<?php echo $datos['ubicacion']; ?>
													  </select>
												  </div>
												  <div class="form-group">
													<label for="usuario">Usuario</label>
													<input type="text" class="form-control" id="usuario" name="usuario" placeholder="nombre de usuario">
												  </div>
												  <div class="form-group">
													<label for="nombres">Nombre</label>
													<input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombre(s)">
												  </div>
												  <div class="form-group">
													<label for="apellido_paterno">Apellido Paterno</label>
													<input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno">
												  </div>
												  <div class="form-group">
													<label for="apellido_materno">Apellido Materno</label>
													<input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno">
												  </div>

                          <div class="m-form__group form-group row">
                              <label class="col-9 col-form-label" for="chk_change_pass">
                                Requerir cambio de contraseña
                              </label>
                              <div class="col-3">
                                <span class="m-switch m-switch--outline m-switch--icon m-switch--info">
                                  <label>
                                    <input id="chk_change_pass" name="chk_change_pass" type="checkbox" checked   value="">
                                    <span></span>
                                  </label>
                                </span>
                              </div>
                          </div>

											</div>
											<div class="col-md-6">
												  <div class="form-group">
													<label for="correo">Correo electrónico</label>
													<input type="email" class="form-control" id="correo" name="correo" placeholder="Ingresar correo">
												  </div>
												  <div class="form-group">
													<label for="password">Contraseña</label>
													<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
												  </div>
												  <div class="form-group">
													<label for="password2">Confirmar contraseña</label>
													<input type="password" class="form-control" id="password2" name="password2" placeholder="Confirmar contraseña">
												  </div>
												  <div class="form-group">
													<label for="id_rol">Rol</label>
													  <select class="form-control m-input" id="id_rol" name ="id_rol">
														<?php echo $datos['roles']; ?>
													  </select>
												  </div>
												  <div class="form-group">
													<label for="fecha_ingreso">Fecha de ingreso</label>
													  <input type="text" class="form-control date-picker" id="fecha_ingreso" name="fecha_ingreso" placeholder="Seleccione la fecha en que ingresó" value="">
												  </div>

                          <div class="m-form__group form-group row">
															<label class="col-3 col-form-label" for="chk_cat_status">
																Habilitado
															</label>
															<div class="col-3">
																<span class="m-switch m-switch--outline m-switch--icon m-switch--info">
																	<label>
                                    <input id="chk_cat_status" name="chk_cat_status" type="checkbox" checked value="">
																		<span></span>
																	</label>
																</span>
															</div>
													</div>

											</div>
										</div>
									</div>
								</div>


								<div id="error_alerta" > </div>

								<input type="hidden" id="cat_status" name="cat_status" value="3">
								<input type="hidden" id="change_pass" name="change_pass" value="10">

							</form>
            </div>
						<div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cancelar
              </button>
              <button type="button" class="btn btn-primary" id="usr_js_fn_04">
                Agregar
              </button>

						</div>
        </div>
    </div>
</div>
