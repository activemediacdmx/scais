<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Relacionar sistemas para <strong><?= $datos['user']->usuario ?></strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
							<form role="form" id="relacionar_sistemas">
								<div class="panel panel-primary">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
                          <?php
                              for($i=0;$i < count($datos['lista_sistemas']); $i++){
            										if($datos['acceso'][$i] == 1){$checked_ac = 'checked';}else{$checked_ac = '';
                              }
                          ?>
                          <div class="m-form__group form-group row">
                              <label class="col-9 col-form-label" for="chk_change_pass">
                                <strong><?=$datos['lista_sistemas'][$i]->nombre?></strong><br>
                                <span><?=$datos['lista_sistemas'][$i]->nombre_largo?></span>
                              </label>
                              <div class="col-3">
                                <span class="m-switch m-switch--outline m-switch--icon m-switch--info">
                                  <label>
                                    <input
                                    id="system_access_<?=$datos['lista_sistemas'][$i]->id_sistema?>"
                                    name="system_access_<?=$datos['lista_sistemas'][$i]->id_sistema?>"
                                    type="checkbox"
                                    <?php echo $checked_ac; ?>
                                    onchange='vincular_sistema(<?=$datos['lista_sistemas'][$i]->id_sistema?>)'>
                                    <span></span>
                                  </label>
                                </span>
                              </div>
                          </div>
                          <hr>
                          <?php
                             }
                          ?>

											</div>
										</div>
									</div>
								</div>

                <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $datos['id_usuario']; ?>">

							</form>
            </div>
						<div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cerrar
              </button>
						</div>
        </div>
    </div>
</div>
