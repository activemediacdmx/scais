$("body").on("click", "#sys_js_fn_01", function() {
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'sistemas/modal_add_sys',
			dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){
						/**/
					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SYS-01');}
		});
});

$("body").on("click", "#sys_js_fn_02", function() {
	var msj_error="";
	if( $('#nombre').get(0).value == "" )	msj_error+='El Nombre es requerido.<br />';
	if( $('#nombre_largo').get(0).value == "")	msj_error+='La Nombre largo es requerido.<br />';
	if( $('#descripcion').get(0).value == "")	msj_error+='La descripción es requerida.<br />';
	if( !msj_error == "" ){
		alerta('Alerta!','Campos requeridos SYS-02 - ' +  msj_error);
		return false;
	}
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'sistemas/agregar_sistema',
			type: 'POST',
			data: $("#nuevo_sistema").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$('#sistemas').DataTable().ajax.reload();
					$('#myModal').modal('hide');
				}else{
					alerta('Alerta!','Error de conectividad de red SYS-03');
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SYS-04');}
		});
});


$("body").on("click", ".sys_js_fn_03", function() {
		id_sistema = $(this).attr('data-function');
			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: 'sistemas/modal_editar_sistema/' + id_sistema,
				dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){

					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
				error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SYS-05');}
			});
});

$("body").on("click", "#sys_js_fn_04", function() {
	var msj_error="";
	if( $('#nombre').get(0).value == "" )	msj_error+='El Nombre es requerido.<br />';
	if( $('#nombre_largo').get(0).value == "")	msj_error+='La Nombre largo es requerido.<br />';
	if( $('#descripcion').get(0).value == "")	msj_error+='La descripción es requerida.<br />';
	if( !msj_error == "" ){
		alerta('Alerta!','Campos requeridos SYS-06 - ' +  msj_error);
		return false;
	}
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'sistemas/editar_sistema',
			type: 'POST',
			data: $("#edita_sistema").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$('#sistemas').DataTable().ajax.reload();
					$('#myModal').modal('hide');
				}else{
					alerta('Alerta!','Error de conectividad de red SYS-07');
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SYS-08');}
		});
});

$("body").on("click", ".sys_js_fn_05", function() {
		id_usuario = $(this).attr('data-function');
			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: 'sistemas/modal_relacionar_sistemas/' + id_usuario,
				dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){

					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
				error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SYS-09');}
			});
});

function vincular_sistema(id_sistema) {
		var id_sistema = escape(id_sistema);
		var estado = document.getElementById("system_access_" + id_sistema).checked;
		var id_usuario = document.getElementById("id_usuario").value;
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: app_url + 'sistemas/vincular_sistema/' + id_usuario + '/' + id_sistema + '/' + estado ,
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					if(estado == true){
							$.ajax({
								headers: {
											'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								url: 'systemusers/datos_usuario/' + id_usuario + '/' + id_sistema,
								dataType: 'html',
								success: function(resp_success){
									var modal =  resp_success;
									$(modal).modal().on('shown.bs.modal',function(){
											$('#system_menu_' + id_sistema).show();
									}).on('hidden.bs.modal',function(){
											$(this).remove();
									});
								},
								error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SYS-15');}
							});


					}else{
						$('#system_menu_' + id_sistema).hide();
					}
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SYS-10');}
		});

}

$("body").on("click", "#sys_js_fn_06", function() {
	  id_sistema = $(this).attr('data-function');
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'systemroles/modal_roles/' + id_sistema,
			dataType: 'html',
			success: function(resp_success){
				var modal =  resp_success;
				$(modal).modal().on('shown.bs.modal',function(){
							$('#roles').dataTable({
								"language": {
		                "url": "assets/plugins/datatables/Spanish.json"
		            },
								"dom": '<"top"p>'
							});
							$( "#add" ).click(function() {
							$("#add_field").css({ display: "" });
							$("#add").css({ display: "none" });

					});
				}).on('hidden.bs.modal',function(){
					$(this).remove();
				});
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SYS-11');}
		});

});


$("body").on("click", "#sys_js_fn_07", function() {
	  id_sistema = $(this).attr('data-function');
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'systemroles/agregar_rol/' + id_sistema,
			type: 'POST',
			data: $("#nuevo_rol").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$("#add_field").addClass("hidden");
					$('#myModal').modal('hide');
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SYS-12');}
		});
});
$("body").on("click", "#sys_js_fn_08", function() {
	  id_sistema = $(this).attr('data-function');
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'permisos/modal_add_metodo/' + id_sistema,
			dataType: 'html',
			success: function(resp_success){
				var modal =  resp_success;
				$(modal).modal().on('shown.bs.modal',function(){
					//console.log(modal);
				}).on('hidden.bs.modal',function(){
					$(this).remove();
				});
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SYS-13');}
		});
});
$("body").on("click", "#sys_js_fn_09", function() {
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
			url: 'permisos/agregar_metodo',
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
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SYS-14');}
		});
});


$("body").on("click", ".sys_js_fn_10", function() {
		id_usuario = $(this).attr('data-function');
		id_sistema = $(this).attr('data-system');
			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: 'systemusers/datos_usuario/' + id_usuario + '/' + id_sistema,
				dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){

					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
				error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SYS-15');}
			});
});

$("body").on("click", "#sys_js_fn_11", function() {
	var msj_error="";
	if( $('#id_rol').get(0).value == "" )	msj_error+='Olvidó seleccionar Rol de usuario.<br />';
	if( !msj_error == "" ){
		alerta('Faltan datos', msj_error);
		return false;
	}

		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'systemusers/edita_rol_usuario',
			type: 'POST',
			data: $("#edita_rol_usuario").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$('#myModalRol').modal('hide');
					$('#usuarios').DataTable().ajax.reload();
				}else{
					alerta_div('error_alerta',resp_success['mensaje'],resp_success['error']);
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SYS-16');}
		});

});


$("body").on("click", ".sys_js_fn_17", function() {
		id_sistema = $(this).attr('data-function');
			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: 'sistemas/sync_sistema/' + id_sistema,
				dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){

					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
				error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SYS-17');}
			});
});

$("body").on("click", "#sys_js_fn_11", function() {
	  id_sistema = $(this).attr('data-function');
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'sistemas/sync_sistema_do/' + id_sistema,
			type: 'POST',
			dataType: 'json',
			success: function(resp_success){
				if (resp_success['resp'] == true) {
					$('#myModal').modal('hide');
					$('#sistemas').DataTable().ajax.reload();
				}else{
					alerta_div('error_alerta',resp_success['mensaje'],resp_success['error']);
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SYS-18');}
		});

});
