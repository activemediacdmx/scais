<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Permisos as ModelPermisos;
use App\Models\Sistemas;
use Helpme;

class Permisos extends Controller
{
  public function __construct()
  {
      $this->middleware('permiso:Controllers|index', ['only' => ['index','main']]);
      $this->middleware('permiso:Controllers|obtener_controllers', ['only' => ['obtener_controllers']]);
      $this->middleware('permiso:Controllers|modal_add_metodo', ['only' => ['modal_add_metodo']]);
      $this->middleware('permiso:Controllers|agregar_metodo', ['only' => ['agregar_metodo']]);
      $this->middleware('permiso:Controllers|data_controller', ['only' => ['data_controller']]);
      $this->middleware('permiso:Controllers|editar_metodo', ['only' => ['editar_metodo']]);
      $this->middleware('permiso:Controllers|eliminar_par', ['only' => ['eliminar_par']]);
  }
  public function index(){ return view('plantilla/404_full'); }

  public function main($id_sistema){
    $system_data = Sistemas::datos_sistema($id_sistema);
    $datos = [
        'id_sistema' => $id_sistema,
        'system_data' => $system_data
    ];
    return view('sistemas/listado_pares')->with('datos', $datos);
  }

  public function obtener_controllers($id_sistema){echo json_encode( ModelPermisos::obtenerControllers($id_sistema) );}

  public function modal_add_metodo($id_sistema){return view('modales/sistemas/nuevo_metodo')->with('id_sistema', $id_sistema);}

  public function agregar_metodo(Request $request){print json_encode(ModelPermisos::agregar_metodo($request));}

  public function data_controller($id){return view('modales/controllers/editar_metodo')->with('modelo', ModelPermisos::data_controller($id));}

  public function editar_metodo(Request $request){print json_encode(ModelPermisos::editar_metodo($request));}

  public function eliminar_par($id){print json_encode(ModelPermisos::eliminar_metodo($id));}
}
