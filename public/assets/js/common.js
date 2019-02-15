
$("body").on("click", "#comm_js_fn_01", function() {
	$.ajax({
		headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: app_url + 'login/salir',
		type: 'POST',
		dataType: "json",
		success: function(respuesta){
			if(respuesta[0].resp='correcto'){
				window.location = app_url +  "login";
			}else{
				alerta('Alerta!','Error en el sistema');
			}
		},
		error: function(){alerta('Alerta!','Error de conectividad de red CMMN-01');}
	});
});

function salirAlternativo(){
	$.ajax({
		headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: app_url + 'login/salirAlternativo',
		type: 'POST',
		dataType: "json",
		success: function(respuesta){
			if(respuesta[0].resp='correcto'){
				window.location = app_url +  "login";
			}else{
				alerta('Alerta!','Error en el sistema');
			}
		},
		error: function(){alerta('Alerta!','Error de conectividad de red CMMN-02');}
	});
}

$("body").on("click", ".loginfn", function() {
		if($('#usuario').get(0).value==""){
			alerta('Alerta!','Olvido ingresar usuario');
			return false;
		}else if($('#password').get(0).value==""){

			alerta('Alerta!','Olvido ingresar password');
			return false;
		}else{
			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: app_url + 'login/logear',
				type: 'POST',
				data: 'usuario='+$('#usuario').get(0).value+"&password="+$('#password').get(0).value,
				dataType: "json",
				beforeSend: function() {
		        /**/
		    },
				success: function(respuesta){
					if(respuesta[0].resp=='acceso_correcto'){
						if(respuesta[2].via == 'correcta'){
							if(respuesta[1].dispositivo=='celular'){
								window.location = app_url + "mobile";
							}else{
								window.location = app_url + "inicio";
							}
						}else if(respuesta[2].via == 'disabled'){
							alerta('Alerta!','El logueo esta deshabilitado de manera temporal por el administrador');
						}
					}else if(respuesta[0].resp=="acceso_incorrecto"){
						$('#usuario').value="";
						$('#password').value="";
						alerta('Alerta!','Usuario o password incorrecto');
					}else if(respuesta[0].resp=="inhabilitado"){
						$('#usuario').value="";
						$('#password').value="";
						alerta('Alerta!','Su cuenta está inhabilitada por exceder el número de intentos de acceso permitidos, notifíquelo a su administrador');
					}
				},
				error: function(){ alerta('Alerta!','Error de conectividad de red CMMN-03');}
			});
		}
});

$("body").on("click", "#comm_js_fn_04", function() {
    id_usuario = $(this).attr('data-function');
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'login/modal_sign_out/' + id_usuario,
			dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){
						//console.log(modal);
					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red CMMN-04');}
		});
});

$("body").on("click", "#comm_js_fn_06", function() {
    id_usuario = $(this).attr('data-function');
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'login/sign_out/' + id_usuario,
			dataType: 'json',
				success: function(resp_success){
					if (resp_success['resp'] == true) {
						$('#myModal').modal('hide');
						$('#loginusr').DataTable().ajax.reload();
					}else{
						alerta('Alerta!','Error de conectividad de red CMMN-05');
					}
				},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red CMMN-06');}
		});

});

$("body").on("click", "#comm_js_fn_07", function() {

		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'login/modal_all_sign_out',
			dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){
						//console.log(modal);
					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red CMMN-07');}
		});

});
$("body").on("click", "#comm_js_fn_09", function() {

		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'login/sign_all_out',
			dataType: 'json',
				success: function(resp_success){
					if (resp_success['resp'] == true) {
						$('#myModal').modal('hide');
						location.reload();
					}else{
						alerta('Alerta!','Error de conectividad de red CMMN-08');
					}
				},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red CMMN-09');}
		});

});
$("body").on("click", ".mnufocus", function() {
    $('.m-menu__item--expanded').addClass( "mnufocus" );
    $('.m-menu__item--expanded').removeClass( "m-menu__item--expanded" );
	  $(this).addClass( "m-menu__item--expanded" );
});
$("body").on("click", ".sbmnufocus", function() {
    $('.m-menu__item--active').addClass( "sbmnufocus" );
    $('.m-menu__item--active').removeClass( "m-menu__item--active" );
	  $(this).addClass( "m-menu__item--active" );
});

function valida_enter(e, decReq) {
	var key = e.which;
	if (key == 13) {
		return true;
	} else {
		return false;
	}
}
function valida_logeo(e,decReq,boton){

	if(valida_enter(e,decReq)==true || boton==1){
		if($('#usuario').get(0).value==""){
			alerta('Alerta!','Olvido ingresar usuario');
			return false;
		}else if($('#password').get(0).value==""){

			alerta('Alerta!','Olvido ingresar password');
			return false;
		}else{
			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: app_url + 'login/logear',
				type: 'POST',
				data: 'usuario='+$('#usuario').get(0).value+"&password="+$('#password').get(0).value,
				dataType: "json",
				success: function(respuesta){
					if(respuesta[0].resp=='acceso_correcto'){
						if(respuesta[2].via == 'correcta'){
							if(respuesta[1].dispositivo=='celular'){
								window.location = app_url + "mobile";
							}else{
								window.location = app_url + "inicio";
							}
						}else if(respuesta[2].via == 'disabled'){
							alerta('Alerta!','El logueo esta deshabilitado de manera temporal por el administrador');
						}
					}else if(respuesta[0].resp=="acceso_incorrecto"){
						$('#usuario').value="";
						$('#password').value="";
						alerta('Alerta!','Usuario o password incorrecto');
					}else if(respuesta[0].resp=="inhabilitado"){
						$('#usuario').value="";
						$('#password').value="";
						alerta('Alerta!','Su cuenta está inhabilitada por exceder el número de intentos de acceso permitidos, notifíquelo a su administrador');
					}
				},
				error: function(){ alerta('Alerta!','Error de conectividad de red CMMN-03');}
			});
		}
	}

}
