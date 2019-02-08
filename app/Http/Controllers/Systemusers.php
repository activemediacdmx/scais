<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Viewsystemusers;
use App\Models\Viewsystemlog;
use App\Models\Viewlogins;
use App\Models\Sistemas;
use App\Models\Usuarios;
use App\Models\Systemroles;
use App\Models\Systemusers as ModelSystemusers;
use Helpme;

class Systemusers extends Controller
{
  public function __construct()
  {
      $this->middleware('permiso:Usuarios|index', ['only' => ['index','listado']]);
      $this->middleware('permiso:Usuarios|obtener_usuarios', ['only' => ['obtener_usuarios']]);
      $this->middleware('permiso:Login|loginlogger', ['only' => ['loginlogger','loginlogger_get']]);
      $this->middleware('permiso:Login|loginlogger', ['only' => ['logueados','logueados_get']]);
      $this->middleware('permiso:Usuarios|datos_usuario', ['only' => ['datos_usuario']]);
  }
  public function index()  {/*nothing :(*/}

  public function listado($id_sistema){
    $system_data = Sistemas::datos_sistema($id_sistema);
    $datos = [
        'bloqueados' => ModelSystemusers::usuarios_bloqueados(),
        'id_sistema' => $id_sistema,
        'system_data' => $system_data,
    ];
    return view('sistemas/usuarios')->with('datos', $datos);
  }

  public function edita_rol_usuario(Request $request){

      $id_usuario = $request->input('id_usuario');
      $id_sistema = $request->input('id_sistema');
      $id_rol = $request->input('id_rol');
      $data = self::updateRemoteUser($id_usuario, $id_sistema, $id_rol);

      print json_encode(ModelSystemusers::edita_rol_usuario($request));
  }

  public function updateRemoteUser($id_usuario, $id_sistema, $id_rol){
    $keys = Sistemas::systemKey($id_sistema);

    foreach ($keys as $key)
    {
        $app_secret =  $key->system_key;
        $app_name =  $key->nombre;
        $app_url =  $key->url;
    }

    return  self::updateRemoteUser_do($app_url, $app_secret, $app_name, $id_usuario, $id_sistema, $id_rol);
  }

  private function updateRemoteUser_do($app_url, $app_secret, $app_name, $id_usuario, $id_sistema, $id_rol){

    $post_send = json_encode(array('proceso' => 'updateuserrol'));
    $sign = hash_hmac('sha256', $post_send, $app_secret, false);

    $headers = array(
       'systemverify-Signature:'.$sign,
       'system:'.$app_name,
       'system-id:'.$id_sistema,
       'ip:'.$_SERVER['REMOTE_ADDR'],
       'id-rol:'.$id_rol,
       'id-usuario:'.$id_usuario
    );

    $curl = null;
    $curl = curl_init($app_url.'webhook/updateuserrol');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_send);

    $res = curl_exec($curl);
    $data = explode("\r\n",$res);
    $status = $data[0];
    //return  $data[9];
    return $res;
  }


  public function datos_usuario($user_id, $id_sistema)
  {
      $usuario = Usuarios::datos_usuario($user_id);
      $id_rol = Systemroles::getIdRol($user_id, $id_sistema);
      $roles = Systemroles::selectRolesSystemByTipo('8,6',$_SESSION['id_rol'],$id_sistema,$id_rol);
      $datos = [
          'usuario' => $usuario,
          'roles' => $roles,
          'id_sistema' => $id_sistema
      ];
      return view('modales/sistemas/editar_usuario')->with('datos', $datos);
  }


  public function obtener_usuarios($id_sistema){print json_encode(Viewsystemusers::obtener_usuarios($id_sistema));  }

  public function loginlogger($id_sistema){
    $system_data = Sistemas::datos_sistema($id_sistema);
    $datos = [
        'bloqueados' => ModelSystemusers::usuarios_bloqueados(),
        'id_sistema' => $id_sistema,
        'system_data' => $system_data,
    ];
    return view('sistemas/logger')->with('datos', $datos);
  }

  public function loginlogger_get($id_sistema){print json_encode(Viewsystemlog::logger($id_sistema));}

  public function logueados($id_sistema) {
    $system_data = Sistemas::datos_sistema($id_sistema);
    $datos = [
        'bloqueados' => ModelSystemusers::usuarios_bloqueados(),
        'id_sistema' => $id_sistema,
        'system_data' => $system_data,
    ];
    return view('sistemas/logueados')->with('datos', $datos);
  }

  public function logueados_get($id_sistema) { print json_encode(Viewlogins::logueadossystem_get($id_sistema)); }

}
