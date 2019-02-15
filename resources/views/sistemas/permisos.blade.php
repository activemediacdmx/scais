<script>
$("#breadcrumb-title").html('<?=$datos['system_data']->nombre?>');
$("#breadcrumb-title").append(' / Roles y permisos / Control de permisos de rol > <?=$datos['descripcion']?>');
</script>
<!--begin::Portlet-->
<div class="m-portlet m-portlet--tab">
	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<span class="m-portlet__head-icon m--hide">
					<i class="la la-gear"></i>
				</span>
				<h3 class="m-portlet__head-text">
					Control de permisos de roles
				</h3>
			</div>
		</div>
	</div>
	<div class="m-portlet__body">



	<input type="hidden" name="role" id="role" value="<?php echo $datos['id_rol']; ?>">
		<?php
		if(Helpme::tiene_permiso('Roles|clonar')){
		?>
			<h3 class="header lighter wow fadeInUp animated" style="font-size:2.5em !important; line-height:70px;">
				Clonar para <?=$datos['descripcion']?>:
			</h3>
			<div class="row wow fadeInUp animated">
				<div class="col-md-4">
					<select class="form-control m-input m-input--square wow fadeInUp animated" id="id_rol_clone" name="id_rol_clone">
						<?php echo $datos['roles']; ?>
					</select>
				</div>
				<div class="col-md-2">
					<button id="rls_js_fn_01" class=" wow fadeInUp animated btn btn-primary">Clonar</button>
				</div><br>
			</div>
		<?php
		}else{
		?>
			<h3 class="header lighter wow fadeInUp animated" style="font-size:2.5em !important; line-height:70px;">
			Definir <?=$datos['descripcion']?>:
			</h3>
		<?php
		}
		$printhead = 1;
		$titulo = '';
    if($datos['metodos']){
		foreach ($datos['metodos'] as $num => $metodo){
			if($metodo->controlador != $titulo){$printhead = 1;}
			if($printhead == 1){
				echo '<h3 class="header lighter wow fadeInUp animated" style="font-size:2.5em !important; line-height:70px;">'.$metodo->controlador.'</h3>';
				$printhead = 0;
				$titulo = $metodo->controlador;
			}

				if($datos['permisos'][$num] == 1){$checked = 'checked';}else{$checked = '';}

			?>

				<div class="text-icon wow fadeInUp animated">
					<span style="float: left; position:relative;">

						<!-- Switch -->
						<span class="m-switch m-switch--lg m-switch--icon">
							<label>
								<input id="permission_<?php echo $metodo->id_metodo; ?>" name="permission_<?php echo $metodo->id_metodo; ?>" type="checkbox" <?php echo $checked; ?> onchange='setPermission(<?php echo $metodo->id_metodo; ?>)'>
								<span></span>
							</label>
						</span>

						<span class="lbl"></span>
					</span>
					<div class="text-icon-content">
						<h4>
							&nbsp;&nbsp;&nbsp;<?php echo $metodo->nombre;?>
							<span style="font-size:.6em;">
								(<?php echo $metodo->metodo; ?>)
							</span>
						</h4>

						<div class="profile-activity clearfix" style="height:50px !important;">
							<div>
								<div class="time">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $metodo->descripcion; ?>
								</div>
							</div>
						</div>
						<?php
						if($metodo->metodo == 'agregar_usuario'){
						?>
							<div class="well">
								<h4 class="smaller lighter">Roles que a los que tiene acceso este rol</h4>
								Seleccione los roles que podrán asignar los usuarios vinculados a este rol, cuando esté activa la opción de insertar un usuario y/o la opción de actualizar los datos de un usuario. Tenga en cuenta que si el usuario tiene acceso a este módulo entonces podría modificar estos permisos.<br><br>
								<table>
								<?php
									$j=0;
									for($i=0;$i < count($datos['roles_ck']); $i++){

										if($datos['accesos'][$i] == 1){$checked_ac = 'checked';}else{$checked_ac = '';}

										echo ($j == 0)?'<tr>':'';
										echo '<td>';
										?>

											<!-- Switch -->
											<span class="m-switch m-switch--icon">
												<label>
													<input id="accessrol<?=$datos['roles_ck'][$i]['value']?>" name="accessrol<?=$datos['roles_ck'][$i]['value']?>" type="checkbox"  <?php echo $checked_ac; ?>  onchange='vincular_rol(<?=$datos['roles_ck'][$i]['value']?>)'>
													<span></span>
												</label>
												<span class="lbl">&nbsp;&nbsp;<?=$datos['roles_ck'][$i]['valor']?>&nbsp;&nbsp;(<?=$datos['roles_ck'][$i]['etiqueta']?>)</span>
											</span>

										<?php
										echo '</td>';
										echo ($j == 2)?'</tr>':'';
										if($j >= 2){$j = 0;}else{$j++;}
									}
								?>
								</table>
							</div>
						<?php
						}
						?>
					</div>
				</div>

			<?php
		}
    }
		?>


</div>
</div>
<!--end::Portlet-->
