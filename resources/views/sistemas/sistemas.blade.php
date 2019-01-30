<script>
$("#breadcrumb-title").html('<?=$datos['system_data']->nombre?>');
$("#breadcrumb-title").append(' / Administración de sistemas');
</script>
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
						<div class="col-xl-12 order-1 order-xl-2 m--align-right">

							<a id="sys_js_fn_01" href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
								<span>
									<i class="fal fa-desktop left" ></i>
									<span>
										Nuevo Sistema
									</span>
								</span>
							</a>
							<div class="m-separator m-separator--dashed d-xl-none"></div>
						</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<table id="sistemas" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
								<th>ID</th>
								<th>Sistema</th>
								<th>Nombre</th>
								<th>Descripción</th>
								<th>&nbsp;</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
<script>
    $(document).ready(function() {
        $('#sistemas').dataTable( {
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
                "url": "sistemas/listado_sistemas",
                "type": "POST"
            }
        } );

    } );
		var pusher = new Pusher('<?=env('PUSHER_APP_KEY')?>', {
			encrypted: true
		});

		var updChannel = pusher.subscribe('sistemas');

		pusher.connection.bind('connected', function() {
			console.log('✓ Servicio de actualización de sistemas activo');
		})
		updChannel.bind('evento', function(data) {
			$('#sistemas').DataTable().ajax.reload();
		});
</script>
