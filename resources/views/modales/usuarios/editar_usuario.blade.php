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
							<form role="form" id="edita_usuario">
								<div class="panel panel-primary">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-6">
												  <div class="form-group">
													<label for="id_ubicacion">Ubicación</label>
													  <select class="form-control m-input" id="id_ubicacion" name="id_ubicacion">
														<?php echo $datos['ubicacion']; ?>
													  </select>
												  </div>
												  <div class="form-group">
													<label for="usuario">Usuario</label>
													<input disabled id="usuario" name="usuario" type="text" class="form-control" value="<?php echo $datos['usuario']['usuario']; ?>">
												  </div>
												  <div class="form-group">
													<label for="nombres">Nombre</label>
													<input id="nombres" name="nombres" type="text" class="form-control" placeholder="Nombre(s)" value="<?php echo $datos['usuario']['nombres']; ?>">
												  </div>
												  <div class="form-group">
													<label for="apellido_paterno">Apellido Paterno</label>
													<input id="apellido_paterno" name="apellido_paterno" type="text" class="form-control" placeholder="Apellido Paterno" value="<?php echo $datos['usuario']['apellido_paterno']; ?>">
												  </div>
												  <div class="form-group">
													<label for="apellido_materno">Apellido Materno</label>
													<input id="apellido_materno" name="apellido_materno" type="text" class="form-control" placeholder="Apellido Materno" value="<?php echo $datos['usuario']['apellido_materno']; ?>">
												  </div>

                          <div class="m-form__group form-group row">
                              <label class="col-9 col-form-label" for="chk_change_pass">
                                Requerir cambio de contraseña
                              </label>
                              <div class="col-3">
                                <span class="m-switch m-switch--outline m-switch--icon m-switch--info">
                                  <label>
                                    <input id="chk_change_pass" name="chk_change_pass" type="checkbox" <?php echo $datos['chk_change_pass']; ?>  value="">
                                    <span></span>
                                  </label>
                                </span>
                              </div>
                          </div>


											</div>
											<div class="col-md-6">
												  <div class="form-group">
													<label for="correo">Correo electrónico</label>
													<input id="correo" name="correo" type="email" class="form-control" placeholder="Ingresar correo" value="<?php echo $datos['usuario']['correo']; ?>">
												  </div>
												  <div class="form-group">
													<label for="password">Contraseña</label>
													<input id="password" name="password" type="password" class="form-control"  placeholder="Ingrese solo si desea cambiarla">
												  </div>
												  <div class="form-group">
													<label for="password2">Confirmar contraseña</label>
													<input id="password2" name="password2" type="password" class="form-control" placeholder="Confirmar contraseña">
												  </div>
												  <div class="form-group">
													<label for="id_rol">Rol</label>
													  <select class="form-control m-input" id="id_rol" name ="id_rol">
														<?php echo $datos['roles']; ?>
													  </select>
												  </div>

												  <div class="form-group">
													<label for="fecha_ingreso">Fecha de ingreso</label>
													  <input readonly type="text" class="form-control date-picker" id="fecha_ingreso" name="fecha_ingreso" placeholder="Seleccione la fecha en que ingresó" value="<?php echo $datos['usuario']['fecha_ingreso']; ?>">
												  </div>

                          <div class="m-form__group form-group row">
															<label class="col-3 col-form-label" for="chk_cat_status">
																Habilitado
															</label>
															<div class="col-3">
																<span class="m-switch m-switch--outline m-switch--icon m-switch--info">
																	<label>
                                    <input id="chk_cat_status" name="chk_cat_status" type="checkbox" <?php echo $datos['chk_cat_status']; ?>  value="">
																		<span></span>
																	</label>
																</span>
															</div>
													</div>

											</div>
										</div>
									</div>
								</div>
								<input type="hidden" id="cat_status" name="cat_status" value="<?php echo $datos['cat_status']; ?>">
								<input type="hidden" id="change_pass" name="change_pass" value="<?php echo $datos['change_pass']; ?>">
								<input id="id_usuario" name="id_usuario" type="hidden" value="<?php echo $datos['usuario']['id_usuario']; ?>">
							</form>
            </div>
						<div class="modal-footer">
              <button type="button" class="btn btn-primary" id="usr_js_fn_05">Editar</button>
              <button type="button" class="btn btn-danger" id="usr_js_fn_06">Baja</button>
              <?php
              if($datos['usuario']['cat_status']==9){ ?>
                <button type="button" class="btn btn-warning" id="usr_js_fn_07">Desbloquear</button>
              <?php } ?>
							<button  data-dismiss="modal" class="btn btn-secondary" type="button">Cancelar</button>
						</div>
        </div>
    </div>
</div>
