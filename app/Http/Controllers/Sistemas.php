<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Viewsistemas;
use App\Models\Usuarios;
use App\Models\Catalogo;
use App\Models\Sistemas as ModelSistemas;
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

  public function sync_sistema($id_sistema){
    return view('modales/sistemas/sync_sistema')->with('id_sistema', $id_sistema);
  }

  public function sync_sistema_do($id_sistema, Request $request){

    $keys = ModelSistemas::systemKey($id_sistema);

    foreach ($keys as $key)
    {
        $app_secret =  $key->system_key;
        $app_name =  $key->nombre;
        $app_url =  $key->url;
    }

    if($app_secret != $request->input('system_key')){
      $resp = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'La SYSTEM KEY proporcionada no corresponde al sistema.' );
    }else{

      $post = self::getModelosRemotos($app_url, $app_secret, $app_name, $id_sistema);
      $ids_inserts = self::populateImports($post, $id_sistema);
      //{ids_metodos: [2067, 2108], ids_roles: [50, 50], ids_permisos: [2067, 2108]}

      $result = self::populateRemote($app_url, $app_secret, $app_name, $id_sistema, $ids_inserts);

      $resp = array(
          'resp' => true ,
          'mensaje' => 'La SYSTEM KEY es correcta, se procede con la sincronización.',
          'remote_data' => $result
      );
    }

    print json_encode($resp);
  }

  private function populateRemote($app_url, $app_secret, $app_name, $id_sistema, $ids_inserts){

    $post_send = json_encode(array('ids_inserts' => $ids_inserts));
    $sign = hash_hmac('sha256', $post_send, $app_secret, false);

    $headers = array(
       'systemverify-Signature:'.$sign,
       'system:'.$app_name,
       'system-id:'.$id_sistema,
       'ip:'.$_SERVER['REMOTE_ADDR']
    );

    $curl = null;
    $curl = curl_init($app_url.'webhook/populate');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_send);

    $res = curl_exec($curl);
    $data = explode("\n",$res);
    $status = $data[0];
    //return  $data[11];
    return $res;


  }

  private function getModelosRemotos($app_url, $app_secret, $app_name, $id_sistema){

    $post_send = json_encode(array('proceso' => 'backup'));
    $sign = hash_hmac('sha256', $post_send, $app_secret, false);

    $headers = array(
       'systemverify-Signature:'.$sign,
       'system:'.$app_name,
       'system-id:'.$id_sistema,
       'ip:'.$_SERVER['REMOTE_ADDR']
    );

    $curl = null;
    $curl = curl_init($app_url.'webhook/backup');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_send);

    $res = curl_exec($curl);
    $data = explode("\n",$res);
    $status = $data[0];
    return  $data[11];
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

    //$import_metodos = json_encode($id_metodos);
    //$import_roles = json_encode($id_roles);
    //$import_permisos = json_encode($id_accesos);

    //array_values($id_accesos)[0]

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

  public function vincular_sistema($id_usuario, $id_sistema, $estado){
     print json_encode(ModelSistemas::setear_permiso($id_usuario, $id_sistema, $estado));
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
