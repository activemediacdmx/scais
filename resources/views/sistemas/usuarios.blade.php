<script>
$("#breadcrumb-title").html('<?=$datos['system_data']->nombre?>');
$("#breadcrumb-title").append(' / Control de usuarios');
</script>
		<div class="m-portlet m-portlet--mobile">

			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
						<div class="col-xl-12 order-1 order-xl-2 m--align-right">

							<?php
							if((Helpme::tiene_permiso('Usuarios|desbloquear_usuarios'))&&($datos['bloqueados'] > 0)){
							?>

							<button
							  id="usr_js_fn_08"
								class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill"
								data-title="Desbloquear todo"
								data-message="Esta accion desbloqueará a tos los usuarios que estén bloqueados"
								data-type="warning"
								data-show-confirm-button="true"
								data-confirm-button-class="btn-sm m-btn--pill    btn-outline-success"
								data-show-cancel-button="true"
								data-cancel-button-class="btn-sm m-btn--pill    btn-secondary"
								data-close-on-confirm="false"
								data-close-on-cancel="false"
								data-confirm-button-text="Si, Desbloquear"
								data-cancel-button-text="No, Cancelar"
								data-popup-title-success="¡Desbloqueados!"
								data-popup-message-success="Se han desbloqueado todos los usuarios"
								data-popup-title-cancel="Cancelado"
								data-popup-message-cancel="Se ha cancelado la operación de desbloqueo de usuarios">
								<i class="fa fa-lock left"></i>
								Desbloquear todos</button>

							<?php
							}
							?>


							<div class="m-separator m-separator--dashed d-xl-none"></div>
						</div>
				</div>
			</div>



			<div class="m-portlet__body">
				<table id="usuarios" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
								<th>ID</th>
								<th>Usuario</th>
								<th>Correo</th>
								<th>Nombre</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Rol</th>
								<th>&nbsp;</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
<script>

$("#usr_js_fn_08").each(function() {
		var t = $(this).data("title")
			, a = $(this).data("message")
			, s = $(this).data("type")
			, e = $(this).data("allow-outside-click")
			, n = $(this).data("show-confirm-button")
			, c = $(this).data("show-cancel-button")
			, o = $(this).data("close-on-confirm")
			, i = $(this).data("close-on-cancel")
			, l = $(this).data("confirm-button-text")
			, u = $(this).data("cancel-button-text")
			, h = $(this).data("popup-title-success")
			, d = $(this).data("popup-message-success")
			, r = $(this).data("popup-title-cancel")
			, f = $(this).data("popup-message-cancel")
			, p = $(this).data("confirm-button-class")
			, m = $(this).data("cancel-button-class");
		$(this).click(function() {
				swal({
						title: t,
						text: a,
						type: s,
						allowOutsideClick: e,
						showConfirmButton: n,
						showCancelButton: c,
						confirmButtonClass: p,
						cancelButtonClass: m,
						closeOnConfirm: o,
						closeOnCancel: i,
						confirmButtonText: l,
						cancelButtonText: u
				}, function(t) {
					if(t){
						$.ajax({
							url: 'usuarios/desbloquear_usuarios',
							dataType: 'json',
							success: function(resp_success){
								if (resp_success['resp'] == true) {
									swal(h, d, "success");
									$('#usr_js_fn_08').remove();
									$('#usuarios').DataTable().ajax.reload();
								}else{
									alerta_div('error_alerta',resp_success['mensaje'],resp_success['error']);
								}
							},
							error: function(respuesta){ alerta('Alerta!','Error de conectividad de red USR-08');}
						});
					}else{
						swal(r, f, "error");
					}
				})
		})
});

    $(document).ready(function() {
        $('#usuarios').dataTable( {
            "fnDrawCallback": function( oSettings ) {
              /**/
            },
            "language": {
                "url": "<?=env('APP_URL')?>assets/plugins/datatables/Spanish.json"
            },
						"searching": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "processing": true,
            "serverSide": true,
    		    "ajax": {
								"headers": {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
                "url": "systemusers/obtener_usuarios/<?=$datos['id_sistema']?>",
                "type": "POST"
            }
        } );

    } );
		var pusher = new Pusher('<?=env('PUSHER_APP_KEY')?>', {
			encrypted: true
		});

		var updChannel = pusher.subscribe('usuarios');

		pusher.connection.bind('connected', function() {
			console.log('✓ Servicio de actualización de usuarios activo');
		})
		updChannel.bind('evento', function(data) {
			$('#usuarios').DataTable().ajax.reload();
		});
</script>
