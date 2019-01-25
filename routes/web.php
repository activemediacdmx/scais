<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'systemroles'], function(){
        Route::get('/', 'Systemroles@index');
        Route::get('/modal_roles/{id_sistema}', 'Systemroles@modal_roles');
        Route::post('/agregar_rol/{id_sistema}', 'Systemroles@agregar_rol');
        Route::get('/permisos/{id_rol}/{id_sistema}', 'Systemroles@permisos');
});

Route::group(['prefix' => 'permisos'], function(){
        Route::get('/', 'Permisos@index');
        Route::get('/main/{id_sistema}', 'Permisos@main');
        Route::post('/obtener_controllers/{id_sistema}', 'Permisos@obtener_controllers');
        Route::get('/modal_add_metodo/{id_sistema}', 'Permisos@modal_add_metodo');
        Route::post('/agregar_metodo', 'Permisos@agregar_metodo');
        Route::any('/data_controller/{id}', 'Permisos@data_controller');
        Route::any('/editar_metodo', 'Permisos@editar_metodo');
        Route::any('/eliminar_par/{id}', 'Permisos@eliminar_par');
});

Route::group(['prefix' => 'systemusers'], function(){
        Route::get('/', 'Systemusers@index');
        Route::get('/listado/{id_sistema}', 'Systemusers@listado');
        Route::post('/obtener_usuarios/{id_sistema}', 'Systemusers@obtener_usuarios');
        Route::get('/loginlogger/{id_sistema}', 'Systemusers@loginlogger');
        Route::post('/loginlogger_get/{id_sistema}', 'Systemusers@loginlogger_get');
        Route::get('/logueados/{id_sistema}', 'Systemusers@logueados');
        Route::post('/logueados_get/{id_sistema}', 'Systemusers@logueados_get');
});

Route::group(['prefix' => 'catalogo'], function(){
        Route::get('/', 'Catalogo@index');
        Route::post('/obtener_catalogo', 'Catalogo@obtener_catalogo');
        Route::any('/editar_catalogo', 'Catalogo@editar_catalogo');
        Route::get('/eliminar_elemento/{ID}', 'Catalogo@eliminar_elemento');
        Route::get('/modal_add_elemento', 'Catalogo@modal_add_elemento');
        Route::post('/agregar_elemento', 'Catalogo@agregar_elemento');
        Route::any('/getCatalogoSecundario/{id_padre}/{nombre_cat}/{other?}', 'Catalogo@getCatalogoSecundario');
        Route::get('/data_catalogo/{id}', 'Catalogo@data_catalogo');
});

Route::group(['prefix' => 'roles'], function(){
        Route::any('/', 'Roles@index');
        Route::any('/index', 'Roles@index');
        Route::get('/establecer_permiso/{role}/{metodo}/{estado}', 'Roles@establecer_permiso');
        Route::any('/establecer_acceso/{id_rol}/{access}/{estado}', 'Roles@establecer_acceso');
        Route::any('/clonar/{id_rol}/{transfer}', 'Roles@clonar');
        Route::post('/agregar_rol', 'Roles@agregar_rol');
        Route::get('/modal_roles', 'Roles@modal_roles');
        Route::get('/permisos/{rol}', 'Roles@permisos');
});

Route::group(['prefix' => 'controllers'], function(){
        Route::get('/', 'Controllers@index');
        Route::post('/obtener_controllers', 'Controllers@obtener_controllers');
        Route::get('/data_controller/{id}', 'Controllers@data_controller');
        Route::post('/editar_metodo', 'Controllers@editar_metodo');
        Route::get('/modal_add_metodo', 'Controllers@modal_add_metodo');
        Route::post('/agregar_metodo', 'Controllers@agregar_metodo');
        Route::get('/eliminar_par/{id}', 'Controllers@eliminar_par');
});

Route::group(['prefix' => 'sistemas'], function(){
        Route::get('/', 'Sistemas@index');
        Route::post('/listado_sistemas', 'Sistemas@listado_sistemas');
        Route::get('/modal_add_sys', 'Sistemas@modal_add_sys');
        Route::post('/agregar_sistema', 'Sistemas@agregar_sistema');
        Route::get('/modal_editar_sistema/{id_sistema}', 'Sistemas@modal_editar_sistema');
        Route::post('/editar_sistema', 'Sistemas@editar_sistema');
        Route::get('/modal_relacionar_sistemas/{id_usuario}', 'Sistemas@modal_relacionar_sistemas');
        Route::get('/vincular_sistema/{id_usuario}/{id_sistema}/{estado}', 'Sistemas@vincular_sistema');
});

Route::group(['prefix' => 'usuarios'], function(){
        Route::get('/', 'Usuarios@index');
        Route::post('/upload_dropzone/{ruta}/{permisos}', 'Usuarios@upload_dropzone');
        Route::post('/update_avatar/{file}', 'Usuarios@update_avatar');
        Route::post('/editar_perfil', 'Usuarios@editar_perfil');
        Route::get('/perfil', 'Usuarios@perfil');
        Route::post('/obtener_usuarios', 'Usuarios@obtener_usuarios');
        Route::get('/modal_add_usr', 'Usuarios@modal_add_usr');
        Route::post('/agregar_usuario', 'Usuarios@agregar_usuario');
        Route::get('/datos_usuario/{id_usuario}', 'Usuarios@datos_usuario');
        Route::get('/desbloquea_usuario/{id_usuario}', 'Usuarios@desbloquea_usuario');
        Route::get('/desbloquear_usuarios', 'Usuarios@desbloquear_usuarios');
        Route::post('/editar_usuario', 'Usuarios@editar_usuario');
        Route::get('/logueados', 'Usuarios@logueados');
        Route::post('/logueados_get', 'Usuarios@logueados_get');
        Route::post('/cambiar_password', 'Usuarios@cambiar_password');
        Route::get('/tyc/{stat}', 'Usuarios@tyc');
});

Route::group(['prefix' => 'inicio'], function(){
        Route::get('/', 'Inicio@index');
        Route::get('/load_start', 'Inicio@load_start');
});

Route::group(['prefix' => 'login'], function(){
        Route::get('/', 'Login@index');
        Route::post('/logear', 'Login@logear');
        Route::any('/recuperar_datos', 'Login@recuperar_datos');
        Route::get('/403', 'Login@error403');
        Route::get('/error404', 'Login@error404');
        Route::get('/tyc', 'Login@tyc');
        Route::get('/pass_chge', 'Login@pass_chge');
        Route::get('/lockSession', 'Login@lockSession');
        Route::post('/salir', 'Login@salir');
        Route::post('/verifica_session', 'Login@verifica_session');
        Route::get('/keepAliveReset', 'Login@keepAliveReset');
        Route::get('/keepAlive', 'Login@keepAlive');
        Route::get('/modal_sign_out/{id_usuario}', 'Login@modal_sign_out');
        Route::get('/sign_out/{id_usuario}', 'Login@sign_out');
        Route::get('/loginlogger', 'Login@loginlogger');
        Route::post('/loginlogger_get', 'Login@loginlogger_get');
        Route::get('/modal_all_sign_out', 'Login@modal_all_sign_out');
        Route::get('/sign_all_out', 'Login@sign_all_out');
        Route::get('/auditoria', 'Login@auditoria');
        Route::post('/auditoria_get', 'Login@auditoria_get');
        Route::get('/modal_auditoria/{id_usuario}', 'Login@modal_auditoria');
        Route::post('/getAuditoriaUserDate/{id_usuario}/{date}', 'Login@getAuditoriaUserDate');
});

Route::get('/', 'Site@index');
Route::group(['prefix' => 'site'], function(){
        Route::get('/', 'Site@index');
});


Route::fallback('Login@error404');
