<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Agregar nuevo elemento al catálogo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" id="modal_content">
            <form role="form" id="agregar_elemento">
               <div class="panel panel-primary">
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-md-12">

                           <div class="form-group">
                              <label for="id_padre">ID Parent</label>
                              <input id="id_padre" name="id_padre" type="text" placeholder="ID Parent" class="form-control" value="">
                           </div>
                           <div class="form-group">
                              <label for="catalogo">Catalogo</label>
                              <input id="catalogo" name="catalogo" type="text" class="form-control" placeholder="Catálogo" value="">
                           </div>
                           <div class="form-group">
                              <label for="etiqueta">Etiqueta</label>
                              <input id="etiqueta" name="etiqueta" type="text" class="form-control" placeholder="Etiqueta" value="">
                           </div>
                           <!-- Switch -->
                           <div class="m-form__group form-group row">
                              <label class="col-3 col-form-label" for="chk_cat_status">
                              Inactivo
                              </label>

                              <div class="col-3">
                                 <span class="m-switch m-switch--outline m-switch--icon m-switch--info">
                                 <label>
                                 <input id="chk_activo" name="chk_activo" type="checkbox" checked>
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
                                 <textarea id="valor" name="valor" type="text" class="form-control"  placeholder="Valor"></textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <input type="hidden" id="activo" name="activo" value="1">
               
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="cat_js_fn_10">Agregar</button>
            <button  data-dismiss="modal" class="btn btn-secondary" type="button">Cancelar</button>
         </div>
      </div>
   </div>
</div>
