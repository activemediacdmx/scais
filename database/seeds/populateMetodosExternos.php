<?php

use Illuminate\Database\Seeder;

class populateMetodosExternos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>50,
      'id_sistema'=>2,
      'controlador'=>'Area',
      'metodo'=>'index',
      'nombre'=>'Indice',
      'descripcion'=>'No tiene acción asignada envía a un error 404',
      'user_alta'=>0,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2017-11-15 18:26:17'
      ));

      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>51,
      'id_sistema'=>2, 'controlador'=>'Area',
      'metodo'=>'select_area',
      'nombre'=>'Seleccionar areas',
      'descripcion'=>'Muestra un combo de seleccion con las areas',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>52,
      'id_sistema'=>2, 'controlador'=>'Controllers',
      'metodo'=>'index',
      'nombre'=>'Indice',
      'descripcion'=>'Muestra la tabla con los metodos que se pueden relacionar a los roles',
      'user_alta'=>0,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-17 20:11:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>53,
      'id_sistema'=>2, 'controlador'=>'Controllers',
      'metodo'=>'obtener_controllers',
      'nombre'=>'Lista de Controladores',
      'descripcion'=>'Realiza la peticion al modelo para obtener la lista de modelos',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>54,
      'id_sistema'=>2, 'controlador'=>'Controllers',
      'metodo'=>'data_controller',
      'nombre'=>'Modal Metodos',
      'descripcion'=>'Solicita una ventana modal para la edicion de metodos',
      'user_alta'=>0,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-06-17 18:59:56'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>55,
      'id_sistema'=>2, 'controlador'=>'Controllers',
      'metodo'=>'editar_metodo',
      'nombre'=>'Editar Metodo',
      'descripcion'=>'Envia los datos para editar el metodo',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>56,
      'id_sistema'=>2, 'controlador'=>'Controllers',
      'metodo'=>'modal_add_metodo',
      'nombre'=>'Modal Agregar Metodo',
      'descripcion'=>'Solicita una modal para el alta de un nuevo par Controlador - Metodo',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>57,
      'id_sistema'=>2, 'controlador'=>'Controllers',
      'metodo'=>'agregar_metodo',
      'nombre'=>'Agregar Metodo',
      'descripcion'=>'Envía datos para un nuevo par de Controlador - Método',
      'user_alta'=>0,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2017-11-09 02:07:04'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>58,
      'id_sistema'=>2, 'controlador'=>'Controllers',
      'metodo'=>'eliminar_par',
      'nombre'=>'Elimina Metodo',
      'descripcion'=>'Envía la petición para eliminar el par Controlador - Método, esta acción elimina en cascada los identificadores que se ligaron dentro de la tabla permisos',
      'user_alta'=>0,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2017-11-09 02:07:33'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>59,
      'id_sistema'=>2, 'controlador'=>'Inicio',
      'metodo'=>'index',
      'nombre'=>'Ventana Principal',
      'descripcion'=>'Muestra la ventana principal que se muestra al usuario despues de loguearse',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>60,
      'id_sistema'=>2, 'controlador'=>'Login',
      'metodo'=>'salir',
      'nombre'=>'Salir',
      'descripcion'=>'Sale del sistema, es necesario hacer universal para todos los usuarios',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>61,
      'id_sistema'=>2, 'controlador'=>'Roles',
      'metodo'=>'index',
      'nombre'=>'Indice',
      'descripcion'=>'No tiene accion asignada envia a un error 404',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>62,
      'id_sistema'=>2, 'controlador'=>'Roles',
      'metodo'=>'modal_roles',
      'nombre'=>'Modal Roles',
      'descripcion'=>'Muestra una ventana modal donde se listan los Roles',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>63,
      'id_sistema'=>2, 'controlador'=>'Roles',
      'metodo'=>'agregar_rol',
      'nombre'=>'Inserta Nivel',
      'descripcion'=>'Inserta un nuevo nivel o rol a la lista de roles del sistema',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>64,
      'id_sistema'=>2, 'controlador'=>'Roles',
      'metodo'=>'permisos',
      'nombre'=>'Administracion de permisos',
      'descripcion'=>'Pagina donde se listan todos los permisos para asignarlos a los roles',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>65,
      'id_sistema'=>2, 'controlador'=>'Roles',
      'metodo'=>'establecer_permiso',
      'nombre'=>'Setear permiso',
      'descripcion'=>'Setea el permiso de una actividad en true o false',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>66,
      'id_sistema'=>2, 'controlador'=>'Roles',
      'metodo'=>'clonar',
      'nombre'=>'Clonar roles',
      'descripcion'=>'clona los permisos de un rol a otro para facilitar la creacion de roles basados en uno ya establecido',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>67,
      'id_sistema'=>2, 'controlador'=>'Ubicacion',
      'metodo'=>'index',
      'nombre'=>'Indice',
      'descripcion'=>'No tiene accion asignada envia a un error 404',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>68,
      'id_sistema'=>2, 'controlador'=>'Ubicacion',
      'metodo'=>'obtener_ubicaciones',
      'nombre'=>'Obtiene ubicaciones',
      'descripcion'=>'Obtiene un arreglo con las ubicaciones',
      'user_alta'=>0,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2015-10-08 20:13:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>69,
      'id_sistema'=>2, 'controlador'=>'Usuarios',
      'metodo'=>'index',
      'nombre'=>'Indice',
      'descripcion'=>'Muestra la lista de los usuarios del sistema',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>70,
      'id_sistema'=>2, 'controlador'=>'Usuarios',
      'metodo'=>'obtener_usuarios',
      'nombre'=>'Lista de usuarios',
      'descripcion'=>'Obtiene los datos de todos los usuarios para presentarlos en una lista para su administracion',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>71,
      'id_sistema'=>2, 'controlador'=>'Usuarios',
      'metodo'=>'datos_usuario',
      'nombre'=>'Datos de usuario',
      'descripcion'=>'Obtiene los datos de un usuario en particular para mostrarlo en una ventana modal',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>72,
      'id_sistema'=>2, 'controlador'=>'Usuarios',
      'metodo'=>'modal_add_usr',
      'nombre'=>'Modal agregar usuario',
      'descripcion'=>'Muestra una ventana modal con un formulario para dar de alta un nuevo usuario',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>73,
      'id_sistema'=>2, 'controlador'=>'Usuarios',
      'metodo'=>'agregar_usuario',
      'nombre'=>'Insert Usuario',
      'descripcion'=>'Inserta un nuevo registro para un nuevo usuario',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>74,
      'id_sistema'=>2, 'controlador'=>'Usuarios',
      'metodo'=>'editar_usuario',
      'nombre'=>'Update Usuario',
      'descripcion'=>'Realiza la actualizacion de datos de usuario',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>75,
      'id_sistema'=>2, 'controlador'=>'Usuarios',
      'metodo'=>'baja_usuario',
      'nombre'=>'Update status baja',
      'descripcion'=>'marca a un usuario para su baja ya que no esta permitido en el sistema la eliminacion de usuarios',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>76,
      'id_sistema'=>2, 'controlador'=>'Usuarios',
      'metodo'=>'perfil',
      'nombre'=>'Modificar Perfil',
      'descripcion'=>'Obtiene la vista de edicion del perfil para el usuario actual.',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>77,
      'id_sistema'=>2, 'controlador'=>'Usuarios',
      'metodo'=>'editar_perfil',
      'nombre'=>'Actualiza el perfil',
      'descripcion'=>'Envia la solicitud de actualizacion de perfil al modelo.',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>78,
      'id_sistema'=>2, 'controlador'=>'Usuarios',
      'metodo'=>'upload_avatar',
      'nombre'=>'Subir o cambiar avatar',
      'descripcion'=>'Establece el avatar para el usuario, de manera predeterminada el usuario tiene un avatar generico, que se puede cambiar con esta opcion, tambien establece los permisos para tres funciones estaticas complementarias y relacionadas a esta funcion.',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>79,
      'id_sistema'=>2, 'controlador'=>'Sidebar',
      'metodo'=>'obtenerExtensiones',
      'nombre'=>'Obtener extensiones con controladores y metodos',
      'descripcion'=>'Obtiene un arreglo con las extensiones sus controladores y metodos de acuerdo a los permisos asignados para los usuarios, es necesario para renderear el menu lateral o sidebar, y deberia de estar disponible para todos los usuarios que tienen acceso a las ',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>80,
      'id_sistema'=>2, 'controlador'=>'Usuarios',
      'metodo'=>'logueados',
      'nombre'=>'Logueados',
      'descripcion'=>'Muestra los usuarios que tienen una sessión abierta actual',
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2016-04-13 13:56:42',
      'fecha_mod'=>'2016-04-13 19:56:42'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>81,
      'id_sistema'=>2, 'controlador'=>'Login',
      'metodo'=>'force_sign_out',
      'nombre'=>'Forzar Deslogueo del sistema',
      'descripcion'=>'Forza la salida del usuario deslogueandolo del sistema',
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2016-04-13 18:54:04',
      'fecha_mod'=>'2016-04-14 00:54:04'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>82,
      'id_sistema'=>2, 'controlador'=>'Login',
      'metodo'=>'force_all_sign_out',
      'nombre'=>'Forzar el deslogueo glabal',
      'descripcion'=>'Elimina las sesiones de todos los usuarios y provoca una nueva solicitud de logueo',
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2016-05-09 18:05:18',
      'fecha_mod'=>'2016-05-10 00:05:18'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>83,
      'id_sistema'=>2, 'controlador'=>'Login',
      'metodo'=>'switch_login_op',
      'nombre'=>'Deshabilita y habilita el logueo de los operadores',
      'descripcion'=>'Permite permutar entre permitir el logueo y des habilitar el logueo de los operadores',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-05-10 02:24:20',
      'fecha_mod'=>'2017-11-06 06:14:55'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>84,
      'id_sistema'=>2, 'controlador'=>'Catalogo',
      'metodo'=>'index',
      'nombre'=>'Indice',
      'descripcion'=>'Lista el catalogo de claves ',
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2016-06-17 18:29:49',
      'fecha_mod'=>'2016-06-17 18:29:49'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>85,
      'id_sistema'=>2, 'controlador'=>'Catalogo',
      'metodo'=>'editar_catalogo',
      'nombre'=>'Edita los elementos del catalogo',
      'descripcion'=>'Muestra un a modal que permite la edición de un elemento del catalogo seleccionado',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-06-17 18:52:32',
      'fecha_mod'=>'2016-06-17 19:01:26'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>86,
      'id_sistema'=>2, 'controlador'=>'Catalogo',
      'metodo'=>'eliminar_elemento',
      'nombre'=>'Eliminar elemento de catalogo',
      'descripcion'=>'Permite eliminar un elemento del catalogo',
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2016-06-17 23:46:29',
      'fecha_mod'=>'2016-06-17 23:46:29'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>87,
      'id_sistema'=>2, 'controlador'=>'Catalogo',
      'metodo'=>'add_elemento',
      'nombre'=>'Agrega un nuevo elemento',
      'descripcion'=>'Agrega un nuevo elemento al catalogo',
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2016-06-18 00:19:02',
      'fecha_mod'=>'2016-06-18 00:19:02'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>88,
      'id_sistema'=>2, 'controlador'=>'Usuarios',
      'metodo'=>'desbloquea_usuario',
      'nombre'=>'Usuarios Bloqueados',
      'descripcion'=>'Desbloquea un usuario ',
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2017-11-20 03:10:59',
      'fecha_mod'=>'2017-11-20 09:10:59'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>89,
      'id_sistema'=>2, 'controlador'=>'Usuarios',
      'metodo'=>'desbloquear_usuarios',
      'nombre'=>'Desbloquear usuarios',
      'descripcion'=>'Desbloquea a todos los usuarios',
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2017-11-20 03:12:09',
      'fecha_mod'=>'2017-11-20 09:12:09'
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>90,
      'id_sistema'=>2, 'controlador'=>'Login',
      'metodo'=>'loginlogger',
      'nombre'=>'Registro de accesos',
      'descripcion'=>'Muestra el registro de accesos al sistema',
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2018-05-20 05:26:47',
      'fecha_mod'=>NULL
      ));



      DB::table('fw_metodos')->insert(
      array (
      'id_metodo'=>91,
      'id_sistema'=>2, 'controlador'=>'Login',
      'metodo'=>'auditoria',
      'nombre'=>'Listado de auditoria',
      'descripcion'=>'Muestra un listado con el log de auditoria para registro de altas, bajas y cambios',
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2019-01-06 13:17:07',
      'fecha_mod'=>NULL
      ));

    }
}
