<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="myModalLabel">Edición de <?php echo $datos['modelo'][2]; ?></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <form role="form" id="edita_catalogo">
         <div class="modal-body" id="modal_content">
            <div class="panel panel-primary">
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="id_padre">ID Parent</label>
                           <input id="id_padre" name="id_padre" type="text" placeholder="ID Parent" class="form-control" value="<?php echo $datos['modelo'][1]; ?>">
                        </div>
                        <div class="form-group">
                           <label for="catalogo">Catalogo</label>
                           <input id="catalogo" name="catalogo" type="text" class="form-control" placeholder="Catálogo" value="<?php echo $datos['modelo'][2]; ?>">
                        </div>
                        <div class="form-group">
                           <label for="etiqueta">Etiqueta</label>
                           <input id="etiqueta" name="etiqueta" type="text" class="form-control" placeholder="Etiqueta" value="<?php echo $datos['modelo'][3]; ?>">
                        </div>
                        <!-- Switch -->
                        <div class="m-form__group form-group row">
                           <label class="col-3 col-form-label" for="chk_cat_status">
                             Inactivo
                           </label>
                           <div class="col-3">
                              <span class="m-switch m-switch--outline m-switch--icon m-switch--info">
                              <label>
                                <input id="chk_activo" name="chk_activo" type="checkbox" <?php echo $datos['chk_activo']; ?>>
                              <span></span>
                              </label>
                              </span>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="orden">Orden</label>
                                 <div class="widget-main">
                                    <input type="text" class="input-sm" id="orden" name="orden"/>
                                    <div class="space-6"></div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="valor">Valor</label>
                              <textarea id="valor" name="valor" type="text" class="form-control"  placeholder="Valor"><?php echo $datos['modelo'][6]; ?></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <input type="hidden" id="activo" name="activo" value="<?php echo $datos['activo']; ?>">
               <input id="id_cat" name="id_cat" type="hidden" value="<?php echo $datos['modelo'][0]; ?>">
               <button type="button" class="btn btn-primary" id="cat_js_fn_02">Editar</button>
               <?php echo Helpme::tiene_permiso('Catalogo|eliminar_elemento')?"
                  <button type='button' id='cat_js_fn_05' class='btn btn-danger' type='button'>Eliminar elemento</button>
                  ":""
                  ?>
               <button  data-dismiss="modal" class="btn btn-secondary" type="button">Cancelar</button>
            </div>
      </form>
      </div>
   </div>
</div>
