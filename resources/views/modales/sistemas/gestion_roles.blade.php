<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <style>
      #descripcion{
          margin-top: 0px !important;
          padding-top: 6px !important;
      }
      #rls_js_fn_03{
        position:relative;
        top: 32px;
        left: 40px;
      }
      </style>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Gestionar Roles para: <?=$datos['system_data']->nombre?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
							<div class="row">
								<div class="col-md-12 column">
									<div class="table-responsive">
										<table id="roles" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>ID</th>
													<th>Rol</th>
													<th>Tipo</th>
													<th>Permisos</th>
												</tr>
												<tbody>
												<?php
                        if($datos['roles']){
  												foreach ($datos['roles'] as $row) {
  													echo "
  													<tr>
  														<td>".$row->id_rol."</td>
  														<td>".$row->descripcion."</td>
  														<td>".$row->etiqueta."</td>
  														<td>
  														<center>
  														<a data-dismiss='modal' onclick=\"carga_archivo('contenedor_principal','systemroles/permisos/".$row->id_rol."/".$datos['id_sistema']."')\"
  														href=\"javascript:;\"><i style='font-size:1.5em; color:#97c95d !important;' class='fa fa-key'></i></a>
  														</center>
  														</td>
  													</tr>
  													";
  												}
                        }
												?>
												</tbody>
											</thead>
										</table>
									</div>
								</div>
							</div>
							<div class="row" id="add_field" style="display:none;">
								<form id="nuevo_rol">
									<div class="col-md-12 column">
										<div class="panel-body">
											<div class="form-group">
												<div class="row">

                          <div class="col align-bottom">

  														<label for="descripcion">Nuevo rol</label>
  														<input type="text" placeholder="Rol" id="descripcion" name="descripcion" class="form-control">

                          </div>
                          <div class="col align-bottom">

  														<label for="cat_tiporol">Tipo Rol</label>
  														<select class="form-control m-input" id="cat_tiporol" name="cat_tiporol">
  														<?php echo $datos['tiporol']; ?>
  														</select>

                          </div>
													<div class="col align-bottom">
														<span data-function="<?=$datos['id_sistema']?>" id="sys_js_fn_07" class="btn btn-ar btn-primary" type="button">Agregar</span>
													</div>

                        </div>
											</div>
										</div>
									</div>
								</form>
							</div>
            </div>
						<div class="modal-footer">
							<button  class="btn btn-primary" type="button" id="add">Agregar</button>
							<button  data-dismiss="modal" class="btn btn-secondary" type="button">Cerrar</button>
						</div>
        </div>
    </div>
</div>
