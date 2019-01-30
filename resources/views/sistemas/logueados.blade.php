<script>
$("#breadcrumb-title").html('<?=$datos['system_data']->nombre?>');
$("#breadcrumb-title").append(' / Control de sesiones');
</script>
		<div class="m-portlet m-portlet--mobile">


			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
						<div class="col-xl-12 order-1 order-xl-2 m--align-right">

							<?php
							if(Helpme::tiene_permiso('Roles|modal_roles')){
							?>

							<a id="comm_js_fn_07" href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
								<span>
									<i class="fa fa-users left"></i>
									<span>
										Desloguear a todos
									</span>
								</span>
							</a>

							<?php
							}
							?>
							<div class="m-separator m-separator--dashed d-xl-none"></div>
						</div>
				</div>
			</div>


			<div class="m-portlet__body">
				<table id="loginusr" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Usuario</th>
							<th>Nombre</th>
							<th>Inicio</th>
							<th>Verificacion</th>
							<th>IP</th>
							<th>session</th>
							<th>Acciones</th>
						</tr>
					</thead>
				</table>
			</div>
</div>

<script>
$(document).ready(function() {
      $('#loginusr').dataTable( {
        "fnDrawCallback": function( oSettings ) {
          /**/
        },
        "language": {
          "url": "<?=env('APP_URL')?>assets/plugins/datatables/Spanish.json"
        },
				"searching": true,
        "processing": true,
        "serverSide": true,
        "ajax": {
					"headers": {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
          "url": "systemusers/logueados_get/<?=$datos['id_sistema']?>",
          "type": "POST"
        },
        "columnDefs": [
          {
            "targets": 7,
            "searchable":false,
            "visible":true,
            "render": function (status) {
              return  status ;
            }
          },
          {
            "targets": 6,
            "searchable":false,
            "visible":true
          }
        ]
      } );
} );

var pusher = new Pusher('<?=env('PUSHER_APP_KEY')?>', {
	encrypted: true
});

var updChannel = pusher.subscribe('loginusr');

pusher.connection.bind('connected', function() {
	console.log('✓ Servicio de actualización de login activo');
})
updChannel.bind('evento', function(data) {
	$('#loginusr').DataTable().ajax.reload();
});

</script>
