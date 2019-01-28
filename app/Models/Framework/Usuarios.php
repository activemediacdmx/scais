<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Helpme;
use DB;

class Usuarios extends Model
{
  protected $table = 'fw_usuarios';
  protected $primaryKey = 'id_usuario';
  public $timestamps = false;


  static function usuarios_bloqueados(){
    return DB::table('fw_usuarios')->where('cat_status','=',9)->count();
  }
  static function obtener_usuarios(){
    return DB::table('fw_usuarios')->get();
  }
  static function baja_usuario($id_usuario){
    $query_resp = DB::table('fw_usuarios')
            ->where('id_usuario', $id_usuario)
            ->update([
                'cat_status'=> 5,
                'user_mod'=> $_SESSION['id_usuario']
            ]);
    if($query_resp){
      $respuesta = array('resp' => true , 'mensaje' => 'La baja del usuario se realizó de manera correcta.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al dar de baja al usuario.' );
    }
    return $respuesta;
  }

  static function set_avatar($avatar){
    $perfil = self::perfil_usuario($_SESSION['id_usuario']);
    $avatar_actual = $perfil['avatar'];

      if($avatar_actual){
        unlink('../storage/perfiles/'.$avatar_actual);
      }

      DB::table('fw_usuarios_config')
      ->where('id_usuario', $_SESSION['id_usuario'])
      ->update([
          'avatar'=> $avatar,
          'user_mod'=> $_SESSION['id_usuario']
      ]);
      return array('resp' => true);
  }

  static function acceptTyc($stat){
    $result = DB::table('fw_usuarios_config')
            ->where('id_usuario', $_SESSION['id_usuario'])
            ->update([
                'aceptar_tyc'=> $stat,
                'user_mod'=> $_SESSION['id_usuario']
            ]);

    if($result){
      $_SESSION['tyc'] = 'SI';
      $respuesta = array('resp' => true , 'dispositivo' => $_SESSION['dispositivo'] );
    }else{
      $_SESSION['tyc'] = 'NO';
      $respuesta = array('resp' => false , 'dispositivo' => $_SESSION['dispositivo'] );
    }
    return $respuesta;
  }

  static function desbloquea_usuario($id_usuario){

    $query_resp = Usuarios::find($id_usuario);
    $query_resp->cat_status = 3;
    $query_resp->user_mod = $_SESSION['id_usuario'];
    $query_resp->save();

    if($query_resp){
      // intentos en cero
      $update_intentos = DB::table('fw_login_log')
              ->where('id_usuario', $id_usuario)
              ->orderBy('id_login_log', 'desc')
              ->limit(1)
              ->update([
                  'intentos'=> 0
              ]);

      if($update_intentos>=0){
           $respuesta = array('resp' => true , 'mensaje' => 'El usuario se desbloqueo correctamente.' );
      }else{
        $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al desbloquear usuario.' );
      }
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al desbloquear usuario.' );
    }
    return $respuesta;
  }

  static function desbloquear_usuarios(){

    $query_resp = DB::table('fw_usuarios')
                ->select('id_usuario')
                ->where('cat_status','=',9)->get();

    foreach ($query_resp as $usuarios)
    {
        // cambia estatus
        $cambia_estatus = Usuarios::find($usuarios->id_usuario);
        $cambia_estatus->cat_status = 3;
        $cambia_estatus->user_mod = $_SESSION['id_usuario'];
        $cambia_estatus->save();

        // intentos en cero
        $update_intentos = DB::table('fw_login_log')
                ->where('id_usuario', $usuarios->id_usuario)
                ->orderBy('id_login_log', 'desc')
                ->limit(1)
                ->update([
                    'intentos'=> 0
                ]);
    }

    if(count($query_resp)>=0){
      // intentos en cero
        $respuesta = array('resp' => true , 'mensaje' => 'Los usuarios se desbloquearon correctamente.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al desbloquear usuario.' );
    }
    return $respuesta;
  }

  static function pass_chge_stat($stat,$user){
    $result = DB::table('fw_usuarios')
            ->where('id_usuario', $user)
            ->update([
                'cat_pass_chge'=> $stat,
                'user_mod'=> $_SESSION['id_usuario']
            ]);

    return $result;
  }

  static function updateIngreso($fecha_ingreso,$id_usuario){
    DB::table('fw_usuarios_config')
            ->where('id_usuario', $id_usuario)
            ->update([
                'fecha_ingreso'=> $fecha_ingreso,
                'user_mod'=> $_SESSION['id_usuario']
            ]);
  }

  static function editar_perfil($request){
    if(($request->input('password') != '') && ($request->input('password2') != '')){
      if(($request->input('password') == $request->input('password2'))&&($request->input('password'))){
        DB::table('fw_usuarios')
                ->where('id_usuario', $_SESSION['id_usuario'])
                ->update(['password'=> md5($request->input('password'))]);
      }
    }

        DB::table('fw_usuarios')
                ->where('id_usuario', $_SESSION['id_usuario'])
                ->update([
                    'correo'=> $request->input('correo'),
                    'nombres'=> $request->input('nombres'),
                    'apellido_paterno'=> $request->input('apellido_paterno'),
                    'apellido_materno'=> $request->input('apellido_materno'),
                    'user_mod'=> $_SESSION['id_usuario']
                ]);

        if(self::crear_perfil($_SESSION['id_usuario'])){

          $activar_paginado = (!empty ($request->input('activar_paginado'))) ? 1 : 0;
          $paginacion = $request->input('paginacion') ? $request->input('paginacion') : 0;

          DB::table('fw_usuarios_config')
                ->where('id_usuario', $_SESSION['id_usuario'])
                ->update([
                    'paginacion'=> $paginacion,
                    'activar_paginado'=> $activar_paginado,
                    'user_mod'=> $_SESSION['id_usuario']
                ]);
        }

        $respuesta = array('resp' => true , 'mensaje' => 'El perfil guardado correctamente.', 'chackbox' => $activar_paginado, 'new_name' => $request->input('nombres') );

    return $respuesta;
  }

  static function editar_usuario($request){
    if(($request->input('password') != '') && ($request->input('password2') != '')){
      if(($request->input('password') == $request->input('password2'))&&($request->input('password'))){
        DB::table('fw_usuarios')
                ->where('id_usuario', $request->input('id_usuario'))
                ->update(['password'=> md5($request->input('password'))]);
      }
    }
        $query_resp = DB::table('fw_usuarios')
                          ->where('id_usuario', $request->input('id_usuario'))
                          ->update([
                              'id_ubicacion' => $request->input('id_ubicacion'),
                              'cat_status'=> $request->input('cat_status'),
                              'cat_pass_chge'=> $request->input('change_pass'),
                              'correo'=> $request->input('correo'),
                              'id_rol'=> $request->input('id_rol'),
                              'nombres'=> $request->input('nombres'),
                              'apellido_paterno'=> $request->input('apellido_paterno'),
                              'apellido_materno'=> $request->input('apellido_materno'),
                              'user_mod'=> $_SESSION['id_usuario']
                          ]);

    if($query_resp){
      self::updateIngreso($request->input('fecha_ingreso'),$request->input('id_usuario'));
      $respuesta = array('resp' => true , 'mensaje' => 'Registro guardado correctamente.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al insertar registro.' );
    }
    return $respuesta;
  }

  static function eliminar_token($token){
    $query_resp = DB::table('fw_lost_password')
                          ->where('token', $token)
                          ->delete();
    return $query_resp;
  }

  static function cambiar_password($pass,$id_usuario){

    if(isset($_SESSION['id_usuario'])){$mod_user = $_SESSION['id_usuario'];}else{$mod_user = $id_usuario;}

    $query_resp = DB::table('fw_usuarios')
                          ->where('id_usuario', $id_usuario)
                          ->update([
                              'password' => md5($pass),
                              'user_mod'=>$mod_user
                          ]);
    return $query_resp;
  }

  static function verifica_token($token){
    $lost_pass = DB::table('fw_lost_password')->where('token','=',$token)->get();

    $array = array();

    if(count($lost_pass)>=1){
      foreach ($lost_pass as $row) {
        $array['token'] 		= $row->token;
        $array['id_usuario'] 	= $row->id_usuario;
        $array['correo'] 		= $row->correo;
        $array['valid'] 		= true;
      }
    }else{
      $array['valid'] 		= false;
    }
    return $array;
  }

  static function consulta_correo($correo){

    $query_resp = DB::table('fw_usuarios')->where('correo','=',$correo)->count();

    if($query_resp > 0){
      $respuesta = array('resp' => true, 'datos' => $query_resp );
    }else{
      $respuesta = array('resp' => false, 'mensaje' => 'Sin resultados en busqueda.'  );
    }
    return $respuesta;
  }

  static function consulta_login($usuario){

    $query_resp = DB::table('fw_usuarios')->where('usuario','=',$usuario)->count();

    if($query_resp > 0){
      $respuesta = array('resp' => true, 'datos' => $query_resp );
    }else{
      $respuesta = array('resp' => false, 'mensaje' => 'Sin resultados.'  );
    }
    return $respuesta;
  }

  static function valida_login_correo($usuario,$correo){
    $resp = true;
    $error = "";
    $mensaje = "";

    $resp_login = self::consulta_login($usuario);
    $resp_correo = self::consulta_correo($correo);
    if($resp_login['resp'] == true ){
      $resp=false;
      $mensaje = 'Error por duplicidad de datos.';
      $error.= 'Nombre de usuario no disponible.<br />';
    }
    if($resp_correo['resp'] == true ){
      $resp=false;
      $mensaje = 'Error por duplicidad de datos.';
      $error.= 'Cuenta de correo electrónico no disponible.';
    }
    return array('resp' => $resp, 'mensaje' => $mensaje, 'error' => $error );
  }

  static function guardar_usuario($request){

    $respuesta = self::valida_login_correo($request->input('usuario'),$request->input('correo'));

    if($respuesta['resp'] == true ){

      $id_usuario = DB::table('fw_usuarios')->insertGetId(
          [
              'id_ubicacion' => $request->input('id_ubicacion'),
              'password' => md5($request->input('password')),
              'cat_pass_chge' => $request->input('change_pass'),
              'cat_status' => $request->input('cat_status'),
              'usuario' => trim($request->input('usuario')),
              'correo' => $request->input('correo'),
              'id_rol' => $request->input('id_rol'),
              'nombres' => $request->input('nombres'),
              'apellido_paterno' => $request->input('apellido_paterno'),
              'apellido_materno' => $request->input('apellido_materno'),
              'user_alta' => $_SESSION['id_usuario'],
              'fecha_alta' => date("Y-m-d H:i:s")
          ]
      );

      self::crear_perfil($id_usuario);
      self::updateIngreso($request->input('fecha_ingreso'),$id_usuario);

      if($id_usuario){
        $respuesta = array('resp' => true , 'mensaje' => 'Registro guardado correctamente.', 'id_rol' =>  $request->input('id_rol'), 'id_usuario' => $id_usuario);
      }else{
        $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al insertar registro.' );
      }

    }
    return $respuesta;
  }

  static function agregar_usuario($request){

    if( $request->input('password') == $request->input('password2') ){
      $respuesta = self::guardar_usuario($request);
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en captura de datos.' , 'error' => 'Las contraseñas ingresadas no son iguales.' );
    }

    return $respuesta;
  }

  static function perfil_usuario($user_id){
    $perfil = DB::table('fw_usuarios_config')->where('id_usuario', $user_id)->get();

    if($perfil[0]->id_usuario){
      foreach ($perfil as $row) {
          $array['avatar'] 			= $row->avatar;
          $array['paginacion'] 		= $row->paginacion;
          $array['activar_paginado'] 	= $row->activar_paginado;
      }
    }else{
      self::crear_perfil($user_id);
      self::perfil_usuario($user_id);
    }
    return $array;
  }

  static function crear_perfil($id_usuario){
    $count = DB::table('fw_usuarios_config')->where('id_usuario', '=', $id_usuario)->count();
    if($count == 1){
      return true;
    }else{
      DB::table('fw_usuarios_config')->insert(
          [
              'id_usuario' => $id_usuario,
              'user_alta' => $_SESSION['id_usuario'],
              'fecha_alta' => date("Y-m-d H:i:s")
          ]
      );
      return true;
    }
  }

  static function datos_usuario($user_id){
    return Usuarios::find($user_id);
  }
}
