<script>
$("#breadcrumb-title").html('Auditoría');
$("#breadcrumb-title").append(' / Análisis de cambios');
</script>
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__body">
				<table id="auditoria" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
								<th>ID</th>
								<th>Sistema</th>
								<th>Controller</th>
								<th>Metodo</th>
                <th>Permiso</th>
                <th>ipv4</th>
                <th>URL</th>
                <th>method</th>
                <th>token</th>
                <th>usuario</th>
                <th>id</th>
                <th>fecha</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>

<script>
    $(document).ready(function() {
        $('#auditoria').dataTable( {
            "fnDrawCallback": function( oSettings ) {
              /**/
            },
            "language": {
                "url": "<?=env('URL_APP')?>assets/plugins/datatables/Spanish.json"
            },
						"searching": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "processing": true,
            "serverSide": true,
    		    "ajax": {
								"headers": {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
                "url": "login/auditoria_get",
                "type": "POST"
            }
        } );

    } );
		var pusher = new Pusher('<?=env('PUSHER_APP_KEY')?>', {
			encrypted: true
		});

		var updChannel = pusher.subscribe('auditoria');

		pusher.connection.bind('connected', function() {
			console.log('✓ Servicio de actualización de auditoria activo');
		})
		updChannel.bind('evento', function(data) {
			$('#auditoria').DataTable().ajax.reload();
		});
</script>
