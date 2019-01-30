<script>
$("#breadcrumb-title").html('<?=$datos['system_data']->nombre?>');
$("#breadcrumb-title").append(' / Catálogo general / Catálogo');
</script>

<div class="m-portlet m-portlet--mobile">


	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
				<div class="col-xl-12 order-1 order-xl-2 m--align-right">

					<?php
					if(Helpme::tiene_permiso('Catalogo|add_elemento')){
					?>

					<a id="cat_js_fn_07" href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
						<span>
							<i class="fa fa-plus left"></i>
							<span>
								Nuevo elemento
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
		<table id="catalogo" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Parent</th>
					<th>Catalogo</th>
					<th>Etiqueta</th>
					<th>Activo</th>
					<th>Orden</th>
					<th>Valor</th>
				</tr>
			</thead>
		</table>
	</div>
</div>


<script>
$(document).ready(function() {
    $('#catalogo').dataTable( {
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
            "url": "catalogo/obtener_catalogo",
            "type": "POST"
        }
    } );
} );
<?php echo Helpme::tiene_permiso('Catalogo|editar_catalogo')?"accion_catalogo();":"" ?>

var pusher = new Pusher('<?=env('PUSHER_APP_KEY')?>', {
	encrypted: true
});

var updChannel = pusher.subscribe('catalogo');

pusher.connection.bind('connected', function() {
	console.log('✓ Servicio de actualización de catalogo activo');
})
updChannel.bind('evento', function(data) {
	$('#loginusr').DataTable().ajax.reload();
});

</script>
