<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Viewsistemas;
use App\Models\Usuarios;
use App\Models\Catalogo;
use App\Models\Sistemas as ModelSistemas;
use Helpme;

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

  public function sync_sistema_do($id_sistema){

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
