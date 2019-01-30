function imprimir_demo(){
	$.ajax({
		url: 'pdf/generar_pdf',
		dataType: 'json',
		success: function(resp_success){
			if (resp_success['resp'] == true) {
				/*$('#myModal').modal('hide');  << si se llama desde una modal esta se debe de ocultar*/
				window.open( app_url + 'tmp/' + resp_success['token'] + '.pdf');
			}else{
				alerta(resp_success['mensaje'],resp_success['error']);
			}
		},
		error: function(respuesta){ alerta('Alerta!','Error de conectividad de red PDF-01');}
	});
}

$("body").on("click", "#pdf_js_fn_02", function() {
	$.ajax({
		url: 'pdf/valeservicio/' + $(this).data('persona'),
		dataType: 'json',
		success: function(resp_success){
			if (resp_success['resp'] == true) {
				/*$('#myModal').modal('hide');  << si se llama desde una modal esta se debe de ocultar*/
				window.open( app_url + 'tmp/' + resp_success['token'] + '.pdf');
			}else{
				alerta(resp_success['mensaje'],resp_success['error']);
			}
		},
		error: function(respuesta){ alerta('Alerta!','Error de conectividad de red PDF-02');}
	});
});

$("body").on("click", "#pdf_js_fn_03", function() {
	$.ajax({
		url: 'pdf/consentimiento/' + $(this).data('persona'),
		dataType: 'json',
		success: function(resp_success){
			if (resp_success['resp'] == true) {
				/*$('#myModal').modal('hide');  << si se llama desde una modal esta se debe de ocultar*/
				window.open( app_url + 'tmp/' + resp_success['token'] + '.pdf');
			}else{
				alerta(resp_success['mensaje'],resp_success['error']);
			}
		},
		error: function(respuesta){ alerta('Alerta!','Error de conectividad de red PDF-03');}
	});
});

$("body").on("click", "#pdf_js_fn_04", function() {
	$.ajax({
		url: 'pdf/declaracion/' + $(this).data('persona'),
		dataType: 'json',
		success: function(resp_success){
			if (resp_success['resp'] == true) {
				/*$('#myModal').modal('hide');  << si se llama desde una modal esta se debe de ocultar*/
				window.open( app_url + 'tmp/' + resp_success['token'] + '.pdf');
			}else{
				alerta(resp_success['mensaje'],resp_success['error']);
			}
		},
		error: function(respuesta){ alerta('Alerta!','Error de conectividad de red PDF-04');}
	});
});

$("body").on("click", "#pdf_js_fn_05", function() {
	var id_persona = $("#id_persona_left").val();
	var id_episodio = $("#id_episodio_left").val();
	$.ajax({
		url: 'pdf/constancia/' + id_persona+'/'+id_episodio,
		dataType: 'json',
		success: function(resp_success){
			if (resp_success['resp'] == true) {
				/*$('#myModal').modal('hide');  << si se llama desde una modal esta se debe de ocultar*/
				window.open( app_url + 'tmp/' + resp_success['token'] + '.pdf');
				//window.location.href =  app_url + 'tmp/' + resp_success['token'] + '.pdf'
				$("#menu_lat_flot").show();
				$('body').removeClass('m-brand--minimize');
				$('body').removeClass('m-aside-left--minimize');
			}else{
				alerta(resp_success['mensaje'],resp_success['error']);
			}
		},
		error: function(respuesta){ alerta('Alerta!','Error de conectividad de red PDF-05');}
	});
});

$("body").on("click", "#pdf_js_fn_06", function() {
	$.ajax({
		url: 'pdf/acta_biometricos/' + $(this).data('persona'),
		dataType: 'json',
		success: function(resp_success){
			if (resp_success['resp'] == true) {
				/*$('#myModal').modal('hide');  << si se llama desde una modal esta se debe de ocultar*/
				window.open( app_url + 'tmp/' + resp_success['token'] + '.pdf');
				$("#menu_lat_flot").show();
				$('body').removeClass('m-brand--minimize');
				$('body').removeClass('m-aside-left--minimize');
			}else{
				alerta(resp_success['mensaje'],resp_success['error']);
			}
		},
		error: function(respuesta){ alerta('Alerta!','Error de conectividad de red PDF-06');}
	});
});

$("body").on("click", "#pdf_js_fn_07", function() {
	$.ajax({
		url: 'pdf/acta_omision/' + $(this).data('persona'),
		dataType: 'json',
		success: function(resp_success){
			if (resp_success['resp'] == true) {
				/*$('#myModal').modal('hide');  << si se llama desde una modal esta se debe de ocultar*/
				window.open( app_url + 'tmp/' + resp_success['token'] + '.pdf');
				$("#menu_lat_flot").show();
				$('body').removeClass('m-brand--minimize');
				$('body').removeClass('m-aside-left--minimize');
			}else{
				alerta(resp_success['mensaje'],resp_success['error']);
			}
		},
		error: function(respuesta){ alerta('Alerta!','Error de conectividad de red PDF-07');}
	});
});

$("body").on("click", "#pdf_js_fn_08", function() {
	$.ajax({
		url: 'pdf/escrito_solicitud/' + $(this).data('persona'),
		dataType: 'json',
		success: function(resp_success){
			if (resp_success['resp'] == true) {
				/*$('#myModal').modal('hide');  << si se llama desde una modal esta se debe de ocultar*/
				window.open( app_url + 'tmp/' + resp_success['token'] + '.pdf');
				$("#menu_lat_flot").show();
				$('body').removeClass('m-brand--minimize');
				$('body').removeClass('m-aside-left--minimize');
			}else{
				alerta(resp_success['mensaje'],resp_success['error']);
			}
		},
		error: function(respuesta){ alerta('Alerta!','Error de conectividad de red PDF-08');}
	});
});

$("body").on("click", "#pdf_js_fn_09", function() {
	$.ajax({
		url: 'pdf/solicitud_ayuda/' + $(this).data('persona'),
		dataType: 'json',
		success: function(resp_success){
			if (resp_success['resp'] == true) {
				/*$('#myModal').modal('hide');  << si se llama desde una modal esta se debe de ocultar*/
				window.open( app_url + 'tmp/' + resp_success['token'] + '.pdf');
				$("#menu_lat_flot").show();
				$('body').removeClass('m-brand--minimize');
				$('body').removeClass('m-aside-left--minimize');
			}else{
				alerta(resp_success['mensaje'],resp_success['error']);
			}
		},
		error: function(respuesta){ alerta('Alerta!','Error de conectividad de red PDF-09');}
	});
});
