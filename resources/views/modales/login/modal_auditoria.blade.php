<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <style>
          .m-portlet { -webkit-box-shadow: none; box-shadow: none; background-color: #ffffff; }
          .m-timeline-2:before { left: 8.82rem; content: ''; position: absolute; width: 0.214rem; height: 78%; }
          .title_audit{
              font-size: 1.5em;
              position: relative;
              z-index: 5;
              text-align: right;
              padding-bottom: 30px;
              color:#478be9;
              float: right;
          }
          .date_audit{
              position:relative;
              top:20px;
              float: right;
              top: -0px;
          }
          #preload_gear_audit{
              position:relative;
              text-align:center;
              left:300px;
              top:100px;
          }
          </style>
          <?php
          if(count($auditoria) > 0){
          ?>

            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Actividades recientes para <?=$auditoria[0]->usuario?>, <span id="audit_count"><?=count($auditoria)?></span>  - Registros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">

            	<div class="m-portlet  m-portlet--full-height ">
            		<div class="m-portlet__body">
            			<div class="m-scrollable" data-scrollable="true" data-height="380" data-mobile-height="300" style="height: 500px; overflow: auto;">

            				<div class="m-timeline-2">
            					<div class="m-timeline-2__items  m--padding-top-25 m--padding-bottom-30">


                        <?php
                        $fecha_change = "Init";
                        for($i=0;$i < count($auditoria) ;$i++){
                          $fecha = substr($auditoria[$i]->fecha_alta, 0, 10);
                          if($fecha_change != $fecha){
                            echo '
                            <div class="col-xl-3 date_audit"><input data-function="'.$id_usuario.'" type="text" readonly class="form-control date-picker" id="auditar_fecha_alta" name="fecha_alta" placeholder="Fecha a auditar" value=""></div>
                            <div class="title_audit">'.$fecha.'</div><div class="clearfix"></div><div id="register_logger_audit">';
                          }
                        ?>

            						<div class="m-timeline-2__item">
            							<span class="m-timeline-2__item-time"><?=substr($auditoria[$i]->fecha_alta, -8,5)?></span>
            							<div class="m-timeline-2__item-cricle">
            								<i class="fa fa-genderless m--font-danger"></i>
            							</div>
            							<div class="m-timeline-2__item-text  m--padding-top-5">
            								<?=$auditoria[$i]->descripcion?><br><br>
            							</div>
            						</div>
                        <?php
                        $fecha_change = $fecha;
                        }
                        ?>
                        </div>


            					</div>
            				</div>


            			</div>
            		</div>
            	</div>
            </div>

        <?php
        }else{
        ?>
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Sin ctividades recientes</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="modal_content"></div>
        <?php
        }
        ?>

        </div>
    </div>
</div>
