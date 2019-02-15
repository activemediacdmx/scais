<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Viewsistemas;
use App\Models\Usuarios;
use App\Models\Catalogo;
use App\Models\Sistemas as ModelSistemas;
use App\Models\Systemsystemusers as SysUsr;
use Helpme;
use DB;

class Sistemas extends Controller
{
  public function __construct()
  {
      $this->middleware('permiso:Sistemas|index', ['only' => ['index','listado_sistemas']]);
      $this->middleware('permiso:Sistemas|relacionar_sistemas', ['only' => ['modal_relacionar_sistemas','vincular_sistema']]);
      $this->middleware('permiso:Sistemas|agregar_sistema', ['only' => ['modal_add_sys','agregar_sistema']]);
      $this->middleware('permiso:Sistemas|editar_sistema', ['only' => ['modal_editar_sistema','editar_sistema']]);
  }

  public function vincular_sistema($id_usuario, $id_sistema, $estado){
     $dataRelacion = ModelSistemas::getUserSysData($id_sistema, $id_usuario);

     if(count($dataRelacion) == 0){
          $id_sistemas_usuario = ModelSistemas::setear_permiso($id_usuario, $id_sistema);
          $cat_status =  13;
     }else{
          $cat_status =  $dataRelacion[0]->cat_status;
          $id_sistemas_usuario =  $dataRelacion[0]->id_sistemas_usuario;
     }

     if($estado === 'false'){
       ModelSistemas::update_permiso($id_usuario, $id_sistema, 4);
       $i = Usuarios::updateRemoteUser($id_usuario, $id_sistema);
     }else{
       $i = 'stateTrue';
     }


     $resp = array(
         'resp' => true ,
         'mensaje' => 'La SYSTEM KEY es correcta, se procede con la sincronización.',
         'remoteUpdate' => $i
     );
     return json_encode($resp);

  }

  public function sync_sistema($id_sistema){
    return view('modales/sistemas/sync_sistema')->with('id_sistema', $id_sistema);
  }

  public function sync_sistema_do($id_sistema, Request $request){

    $keys = ModelSistemas::systemKey($id_sistema);

    foreach ($keys as $key)
    {
        $app_secret =  $key->system_key;
    }

    if($app_secret != $request->input('system_key')){
      $resp = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'La SYSTEM KEY proporcionada no corresponde al sistema.' );
    }else{

      $post = Usuarios::getModelosRemotos($id_sistema);
      $ids_inserts = self::populateImports($post, $id_sistema);
      $result = Usuarios::populateRemote($id_sistema, $ids_inserts);

      $result = json_decode($result);

      $resp = array(
          'resp' => true ,
          'mensaje' => 'La SYSTEM KEY es correcta, se procede con la sincronización.',
          'last_id_metodo' => $result->last_id_metodo,
          'last_id_role' => $result->last_id_role,
          'last_id_permiso' => $result->last_id_permiso
      );
    }

    print json_encode($resp);
  }

  private function populateImports($post, $system_id){

    $post = base64_decode($post);
    $post = json_decode($post, true);

    $metodos = json_decode($post['metodos'], true);
    $roles = json_decode($post['roles'], true);
    $accesos = json_decode($post['accesos'], true);

    for($i=0; $i < count($metodos); $i++){
      $id_metodo = DB::table('fw_metodos')->insertGetId(
          [
            'id_sistema'=>$system_id,
            'controlador'=>$metodos[$i]['controlador'],
            'metodo'=>$metodos[$i]['metodo'],
            'nombre'=>$metodos[$i]['nombre'],
            'descripcion'=>$metodos[$i]['descripcion'],
            'user_alta'=>$metodos[$i]['user_alta'],
            'user_mod'=>$metodos[$i]['user_mod'],
            'fecha_alta'=>$metodos[$i]['fecha_alta'],
            'fecha_mod'=>$metodos[$i]['fecha_mod']
          ]
      );
      $id_metodos[$metodos[$i]['id_metodo']] = $id_metodo;
    }

    for($i=0; $i < count($roles); $i++){
      $id_rol = DB::table('fw_roles')->insertGetId(
          [
            'cat_tiporol'=>$roles[$i]['cat_tiporol'],
            'id_sistema'=>$system_id,
            'descripcion'=>$roles[$i]['descripcion'],
            'token'=>$roles[$i]['token'],
            'user_alta'=>$roles[$i]['user_alta'],
            'user_mod'=>$roles[$i]['user_mod'],
            'fecha_alta'=>$roles[$i]['fecha_alta'],
            'fecha_mod'=>$roles[$i]['fecha_mod']
          ]
      );
      $id_roles[$roles[$i]['id_rol']] = $id_rol;
    }

    for($i=0; $i < count($accesos); $i++){
      $id_permiso = DB::table('fw_permisos')->insertGetId(
          [
            'id_metodo'=>$id_metodos[$accesos[$i]['id_metodo']],
            'id_rol'=>$id_roles[$accesos[$i]['id_rol']],
            'user_alta'=>$accesos[$i]['user_alta'],
            'user_mod'=>$accesos[$i]['user_mod'],
            'fecha_alta'=>$accesos[$i]['fecha_alta'],
            'fecha_mod'=>$accesos[$i]['fecha_mod']
          ]
      );
      $id_accesos[$accesos[$i]['id_permiso']] = $id_permiso;
    }

    $metodos_send = array(array_values($id_metodos)[0], array_values($id_metodos)[count($id_metodos)-1]);
    $roles_send = array(array_values($id_roles)[0], array_values($id_roles)[count($id_roles)-1]);
    $accesos_send = array(array_values($id_accesos)[0], array_values($id_accesos)[count($id_accesos)-1]);

    return array(
            'ids_metodos' => $metodos_send ,
            'ids_roles' => $roles_send,
            'ids_permisos' => $accesos_send
          );

  }

  public function modal_relacionar_sistemas($id_usuario){

    $user = Usuarios::datos_usuario($id_usuario);
    $lista_sistemas = ModelSistemas::listado_sistemas();

    for($i=0;$i < count($lista_sistemas); $i++){
        $acceso[$i] = ModelSistemas::getAccesos($lista_sistemas[$i]->id_sistema, $id_usuario);
    }
    $datos = [
        'user' => $user,
        'lista_sistemas' => $lista_sistemas,
        'id_usuario' => $id_usuario,
        'acceso' => $acceso,

    ];
    return view('modales/sistemas/relacionar_sistemas')->with('datos', $datos);
  }

  public function index()
  {
    $system_data = ModelSistemas::datos_sistema(1);
    $datos = [
        'system_data' => $system_data
    ];
    return view('sistemas/sistemas')->with('datos', $datos);
  }

  public function listado_sistemas(){
    print json_encode(Viewsistemas::listado_sistemas());
  }


  public function modal_add_sys(){
    $status_sistema = Catalogo::selectCatalog('status_sistema');
    $datos = [
        'status_sistema' => $status_sistema

    ];
    return view('modales/sistemas/nuevo_sistema')->with('datos', $datos);
  }
  public function agregar_sistema(Request $request){
    print json_encode(ModelSistemas::agregar_sistema($request));
  }
  public function modal_editar_sistema($id_sistema){
    $sis_data = ModelSistemas::datos_sistema($id_sistema);
    $status_sistema = Catalogo::selectCatalog('status_sistema', $sis_data->cat_status_sistema);
    $datos = [
        'status_sistema' => $status_sistema,
        'sis_data' => $sis_data

    ];
    return view('modales/sistemas/editar_sistema')->with('datos', $datos);
  }
  public function editar_sistema(Request $request){
    print json_encode(ModelSistemas::editar_sistema($request));
  }
}
