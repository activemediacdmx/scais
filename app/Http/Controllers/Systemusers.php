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
use App\Models\Systemsystemusers as SysUsr;
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
    $dataRelacion = Sistemas::getUserSysData($id_sistema, $id_usuario);


    if(count($dataRelacion) == 0){
      //inserta usuario remoto
         Sistemas::setear_permiso($id_usuario, $id_sistema, $request->input('id_rol'));

         if(Usuarios::setRemoteUser($id_usuario, $id_sistema)){
           Sistemas::update_permiso($id_usuario, $id_sistema, 3);
           $remote = true;
         }

         $result = 'Exist';
    }else{
      //actualiza usuario remoto
         Sistemas::update_permiso($id_usuario, $id_sistema, 3);
         Usuarios::updateToken($id_usuario, $id_sistema);
         Usuarios::updateRemoteUser($id_usuario, $id_sistema);
         $remote = 'Exist';
         $result = ModelSystemusers::edita_rol_usuario($request);
    }

      $respuesta = array(
          'resp' => true ,
          'local_rol' => $result,
          'remote' => $remote

      );

      return $respuesta;
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
