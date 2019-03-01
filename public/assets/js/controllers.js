function accion_controller(){
	$(document).ready(function() {
		$('#controllers').dataTable();
		$('#controllers tbody').on('click', 'tr', function () {
			var id = $('td', this).eq(0).text();
			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: 'controllers/data_controller/' + id,
				dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){
						//console.log(modal);
					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
				error: function(respuesta){ alerta('Alerta!','Error de conectividad de red CNTR-01');}
			});
		} );
	} );
}
$("body").on("click", "#cntr_js_fn_02", function() {
	var msj_error="";
	if( $('#controlador').get(0).value == "" )	msj_error+='El Controlador es requerido.<br />';
	if( $('#metodo').get(0).value == "")	msj_error+='El modelo es requerido.<br />';
	if( !msj_error == "" ){
		alerta_div('error_alerta','Error en la captura de datos.',msj_error);
		return false;
	}
	$(document).ready(function() {
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'controllers/editar_metodo',
			type: 'POST',
			data: $("#edita_modelo").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$('#myModal').modal('hide');
					$('#controllers').DataTable().ajax.reload();
				}else{
					alerta_div('error_alerta',resp_success['mensaje'],resp_success['error']);
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red CNTR-02');}
		});
	} );
});
$("body").on("click", "#cntr_js_fn_03", function() {
	$(document).ready(function() {
		var id = $('#id_metodo').get(0).value;
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'controllers/eliminar_par/' + id,
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$('#myModal').modal('hide');
					$('#controllers').DataTable().ajax.reload();
				}else{
					alerta_div('error_alerta',resp_success['mensaje'],resp_success['error']);
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red CNTR-03');}
		});
	} );
});
$("body").on("click", "#cntr_js_fn_04", function() {
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'controllers/modal_add_metodo',
			dataType: 'html',
			success: function(resp_success){
				var modal =  resp_success;
				$(modal).modal().on('shown.bs.modal',function(){
					//console.log(modal);
				}).on('hidden.bs.modal',function(){
					$(this).remove();
				});
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red CNTR-04');}
		});
});
$("body").on("click", "#cntr_js_fn_05", function() {
	var msj_error="";
	if( $('#controlador').get(0).value == "" )	msj_error+='El Controlador es requerido.<br />';
	if( $('#metodo').get(0).value == "")	msj_error+='El modelo es requerido.<br />';
	if( !msj_error == "" ){
		alerta_div('error_alerta','Error en la captura de datos.',msj_error);
		return false;
	}
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'controllers/agregar_metodo',
			type: 'POST',
			data: $("#nuevo_modelo").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$('#myModal').modal('hide');
					$('#controllers').DataTable().ajax.reload();
				}else{
					alerta_div('error_alerta',resp_success['mensaje'],resp_success['error']);
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red CNTR-05');}
		});
});

$("body").on("click", "#set_auditable", function() {
	if($("#set_auditable").is(':checked')) {
		$('#auditable').get(0).value = "19";
	} else {
		$('#auditable').get(0).value = "20";
	}
});
