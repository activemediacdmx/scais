<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Catalogo as ModelCatalogo;
use App\Models\Sistemas;
use Helpme;

class Catalogo extends Controller
{
  public function __construct()
  {
      $this->middleware('permiso:Catalogo|index', ['only' => ['index','obtener_catalogo']]);
      $this->middleware('permiso:Catalogo|editar_catalogo', ['only' => ['data_catalogo','editar_catalogo']]);
      $this->middleware('permiso:Catalogo|eliminar_elemento', ['only' => ['eliminar_elemento']]);
      $this->middleware('permiso:true', ['only' => ['getCatalogoSecundario']]);
  }

  public function index(){
    $system_data = Sistemas::datos_sistema(1);
    $datos = [
        'system_data' => $system_data
    ];
    return view('catalogo/index')->with('datos', $datos);
  }

  public function obtener_catalogo(Request $request){echo json_encode( ModelCatalogo::listaCatalogo($request) );}

  public function editar_catalogo(Request $request){print json_encode(ModelCatalogo::editar_catalogo($request));}

  public function eliminar_elemento($id){print json_encode(ModelCatalogo::eliminar_elemento($id));}

  public function modal_add_elemento(){return view('modales/catalogo/nuevo_elemento');}

  public function agregar_elemento(Request $request){print json_encode(ModelCatalogo::agregar_elemento($request));}

  public function getCatalogoSecundario($id_padre,$nombre_cat,$other=null){print json_encode(ModelCatalogo::getJsonCatalogo($nombre_cat,$id_padre,$other));}

  public function data_catalogo($id)
  {
      $modelo = ModelCatalogo::data_catalogo($id);
      if($modelo[4]==1){$chk_activo = "checked";$activo = 1;}else{$chk_activo = "";$activo = $modelo[4];}

      $datos = [
          'chk_activo' => $chk_activo,
          'modelo' => $modelo,
          'activo' => $activo
      ];
      return view('modales/catalogo/editar_catalogo')->with('datos', $datos);
  }
}
