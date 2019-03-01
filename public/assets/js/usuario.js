$("body").on("click", "#usr_js_fn_01", function() {
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'usuarios/modal_add_usr',
			dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){
						/**/


					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red USR-01');}
		});
});

﻿$("body").on("click", "#usr_js_fn_02", function(){
	var msj_error="";
	if( $('#nombres').get(0).value == "" )	msj_error+='Olvidó ingresar Nombre.<br />';
	if( $('#apellido_paterno').get(0).value == "")	msj_error+='Olvidó ingresar el apellido paterno.<br />';
	if( $('#apellido_materno').get(0).value == "")	msj_error+='Olvidó ingresar el apellido materno.<br />';

	if( $('#correo').get(0).value == "" )	msj_error+='Olvidó ingresar Correo.<br />';
    var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
    if (!regex.test($('#correo').val().trim())) msj_error+='El correo tiene un formato inválido.<br />';

	if(($('#password').get(0).value != "")&&($('#password2').get(0).value != "")){

			if( $('#password').get(0).value == "" )	msj_error+='Olvidó ingresar Contraseña.<br />';
			if( $('#password2').get(0).value == "") msj_error+='Olvidó ingresar Confimación de contraseña.<br />';

			if( $('#password').get(0).value != $('#password2').get(0).value) msj_error+='Las contraseñas no empatan.<br />';

	}

	if( !msj_error == "" ){
		alerta('Faltan datos', msj_error);
		return false;
	}

		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: app_url + 'usuarios/editar_perfil',
			type: 'POST',
			data: $("#editar_perfil").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$('#name_top').html(resp_success['new_name']);
					alerta('Anuncio!', resp_success['mensaje']);
				}else{
					alerta('Alerta!', resp_success['mensaje']);
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red USR-02');}
		});

});

$("body").on("click", ".usr_js_fn_03", function() {
		id_usuario = $(this).attr('data-function');
			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: 'usuarios/datos_usuario/' + id_usuario,
				dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){

					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
				error: function(respuesta){ alerta('Alerta!','Error de conectividad de red USR-03');}
			});
});


﻿$("body").on("click", "#usr_js_fn_04", function() {
	var msj_error="";
	if( $('#usuario').get(0).value == "" ){ msj_error+='Olvidó ingresar Usuario.<br />'; /*$('#usuario').css({background:'#F4CECD'}); */ }
	if( $('#nombres').get(0).value == "" )	msj_error+='Olvidó ingresar Nombre.<br />';
	if( $('#apellido_paterno').get(0).value == "")	msj_error+='Olvidó ingresar el apellido paterno.<br />';
	if( $('#apellido_materno').get(0).value == "")	msj_error+='Olvidó ingresar el apellifo materno.<br />';
	if( $('#correo').get(0).value == "" )	msj_error+='Olvidó ingresar Correo.<br />';
	if( $('#password').get(0).value == "" )	msj_error+='Olvidó ingresar Contraseña.<br />';
	if( $('#password2').get(0).value == "") msj_error+='Olvidó ingresar Confimación de contraseña.<br />';
	if( $('#id_rol').get(0).value == "" )	msj_error+='Olvidó seleccionar Rol de usuario.<br />';
	if( $('#id_ubicacion').get(0).value == "" )	msj_error+='Olvidó seleccionar la ubicacion del usuario.<br />';

	if( !msj_error == "" ){
		alerta_div('error_alerta','Error en la captura de datos.',msj_error);
		return false;
	}


		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'usuarios/agregar_usuario',
			type: 'POST',
			data: $("#nuevo_usuario").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$('#myModal').modal('hide');
					$('#usuarios').DataTable().ajax.reload();
				}else{
					alerta_div('error_alerta',resp_success['mensaje'],resp_success['error']);
					$('#password').get(0).value = "";
					$('#password2').get(0).value = "";
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red USR-04');}
		});


});

function alerta_div(id_div,error_head,error_content){
	var div_error = '<div class="alert alert-danger" id="error_new_user">';
	div_error += '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
	div_error += '<strong><i class="fa fa-comments-o"></i>'+error_head+'</strong>';
	div_error += '<br />'+error_content;
	div_error += '</div>';
	$('#'+id_div).html(div_error);
}

﻿$("body").on("click", "#usr_js_fn_05", function() {
	var msj_error="";
	if( $('#nombres').get(0).value == "" )	msj_error+='Olvidó ingresar Nombre.<br />';
	if( $('#apellido_paterno').get(0).value == "")	msj_error+='Olvidó ingresar el apellido paterno.<br />';
	if( $('#apellido_materno').get(0).value == "")	msj_error+='Olvidó ingresar el apellido materno.<br />';
	if( $('#correo').get(0).value == "" )	msj_error+='Olvidó ingresar Correo.<br />';
	if( $('#id_rol').get(0).value == "" )	msj_error+='Olvidó seleccionar Rol de usuario.<br />';
	if( $('#password').get(0).value != $('#password2').get(0).value) msj_error+='Las contraseñas no empatan.<br />';
	if( $('#id_ubicacion').get(0).value == "" )	msj_error+='Olvidó Seleccionar la Ubicación.<br />';


	if( !msj_error == "" ){
		alerta('Faltan datos', msj_error);
		return false;
	}

		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'usuarios/editar_usuario',
			type: 'POST',
			data: $("#edita_usuario").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$('#myModal').modal('hide');
					$('#usuarios').DataTable().ajax.reload();
				}else{
					alerta_div('error_alerta',resp_success['mensaje'],resp_success['error']);
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red USR-05');}
		});

});


﻿$("body").on("click", "#chk_change_pass", function() {
	if($("#chk_change_pass").is(':checked')) {
		$('#change_pass').get(0).value = "10";
	} else {
		$('#change_pass').get(0).value = "11";
	}
});

﻿$("body").on("click", "#chk_cat_status", function() {
	if($("#chk_cat_status").is(':checked')) {
		$('#cat_status').get(0).value = "3";
	} else {
		$('#cat_status').get(0).value = "4";
	}
});

﻿$("body").on("click", "#usr_js_fn_06", function() {

		var id = $('#id_usuario').get(0).value;
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'usuarios/baja_usuario/' + id,
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$('#myModal').modal('hide');
					$('#usuarios').DataTable().ajax.reload();
				}else{
					alerta_div('error_alerta',resp_success['mensaje'],resp_success['error']);
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red USR-06');}
		});

});

$("body").on("click", "#usr_js_fn_07", function() {
		id_usuario = $(this).attr('data-function');
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'usuarios/desbloquea_usuario/' + id_usuario,
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$('#myModal').modal('hide');
					$('#usuarios').DataTable().ajax.reload();
				}else{
					alerta_div('error_alerta',resp_success['mensaje'],resp_success['error']);
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red USR-07');}
		});
});

$("body").on("click", "#usr_js_fn_08", function() {
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
							headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
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


$("body").on("click", ".usr_js_fn_09", function() {
		id_usuario = $(this).attr('data-function');
			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: 'login/modal_auditoria/' + id_usuario,
				dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){

					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
				error: function(respuesta){ alerta('Alerta!','Error de conectividad de red USR-09');}
			});
});

function tyc(stat) {
	if(stat == 'SI'){
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: app_url +  'usuarios/tyc/' + stat,
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					console.log(resp_success['resp']);
					if(resp_success['dispositivo']=='celular'){
						window.location ="../mobile";
					}else{
						window.location ="../inicio";
					}
				}else{
					console.log(resp_success['resp']);
					window.location ="inicio";
				}
			},
			error: function(respuesta){ console.log('Error en el proceso TYC');}
		});
	}else{
		salirAlternativo();
	}
}
function cambiar_pass(){
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: app_url + 'usuarios/cambiar_password',
			type: 'POST',
			data: $("#chge_pass").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					console.log(resp_success['resp']);
					if(resp_success['dispositivo']=='celular'){
						window.location ="../mobile";
					}else{
						window.location ="../inicio";
					}
				}else{
					alerta('Alerta!','Error en el proceso PASS_CHGE 01');
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error en el proceso PASS_CHGE 02');}
		});
}
