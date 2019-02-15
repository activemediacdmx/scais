function accion_catalogo(){
	$(document).ready(function() {
		$('#catalogo' ).dataTable();
		$('#catalogo tbody').on('click', 'tr', function () {
			var id = $('td', this).eq(0).text();
			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: 'catalogo/data_catalogo/' + id,
				dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){
						$("#orden").TouchSpin({
							min: 0,
							max: 1000,
							step: 1,
							initval: 0,
							decimals: 0,
							boostat: 5,
							maxboostedstep: 10
						});
					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
				error: function(respuesta){ alerta('Alerta!','Error de conectividad de red CATGL-01');}
			});
		} );
	} );
}
$("body").on("click", "#cat_js_fn_02", function() {
	var msj_error="";
	if( $('#catalogo').get(0).value == "" )	msj_error+='El Catálogo es requerido.<br />';
	if( $('#etiqueta').get(0).value == "")	msj_error+='La Etiqueta es requerida.<br />';
	if( $('#orden').get(0).value == "")	msj_error+='Indique el orden.<br />';
	if( !msj_error == "" ){
		alerta('Alerta!','Error de conectividad de red CATGL-02 - ' + msj_error);
		return false;
	}
	$(document).ready(function() {
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'catalogo/editar_catalogo',
			type: 'POST',
			data: $("#edita_catalogo").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$('#catalogo').DataTable().ajax.reload();
					$('#myModal').modal('hide');
				}else{
					alerta('Alerta!','Error de conectividad de red CATGL-03');
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red CATGL-04');}
		});
	} );
});

$("body").on("change", "#chk_activo", function() {
	if($("#chk_activo").is(':checked')) {
		$('#activo').get(0).value = "1";
	} else {
		$('#activo').get(0).value = "0";
	}
});

$("body").on("click", "#cat_js_fn_05", function() {
	$(document).ready(function() {
		var id = $('#id_cat').get(0).value;
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'catalogo/eliminar_elemento/' + id,
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$('#catalogo').DataTable().ajax.reload();
					$('#myModal').modal('hide');
				}else{
					alerta('Alerta!','La eliminación causa una violacion de integridad relacional verifique que no se use el catálogo antes de su eliminación, error: CATGL-05');
				}
			},
			error: function(respuesta){ alerta('Alerta!','La eliminación causa una violacion de integridad relacional verifique que no se use el catálogo antes de su eliminación, error: CATGL-06');}
		});
	} );
});


$("body").on("click", "#cat_js_fn_07", function() {
	$.ajax({
		headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: 'catalogo/modal_add_elemento',
		dataType: 'html',
		success: function(resp_success){
			var modal =  resp_success;
			$(modal).modal().on('shown.bs.modal',function(){
				$("#orden").TouchSpin({
					min: 0,
					max: 1000,
					step: 1,
					initval: 0,
					decimals: 0,
					boostat: 5,
					maxboostedstep: 10
				});
			}).on('hidden.bs.modal',function(){
				$(this).remove();
			});
		},
		error: function(respuesta){ alerta('Alerta!','Error de conectividad de red CATGL-07');}
	});
});

$("body").on("click", "#cat_js_fn_10", function() {
	var msj_error="";
	if( $('#catalogo').get(0).value == "" )	msj_error+='El Catálogo es requerido.<br />';
	if( $('#etiqueta').get(0).value == "")	msj_error+='La Etiqueta es requerida.<br />';
	if( $('#activo').get(0).value == "")	msj_error+='Estará activo?.<br />';
	if( $('#orden').get(0).value == "")	msj_error+='Indique el orden.<br />';
	if( !msj_error == "" ){
		alerta('Alerta!','Error de conectividad de red CATGL-08 - ' +  msj_error);
		return false;
	}
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'catalogo/agregar_elemento',
			type: 'POST',
			data: $("#agregar_elemento").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$('#catalogo').DataTable().ajax.reload();
					$('#myModal').modal('hide');
				}else{
					alerta('Alerta!','Error de conectividad de red CATGL-09');
				}
			},
			error: function(respuesta){ alerta('Alerta!','Verifique los valores, los identificadores deben ser numéricos, error: CATGL-10');}
		});
});
