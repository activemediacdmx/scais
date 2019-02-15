<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Controllers as ModelController;
use App\Models\Sistemas;

class Controllers extends Controller
{
  public function __construct()
  {
      $this->middleware('permiso:Controllers|index', ['only' => ['index']]);
      $this->middleware('permiso:Controllers|obtener_controllers', ['only' => ['obtener_controllers']]);
      $this->middleware('permiso:Controllers|data_controller', ['only' => ['data_controller']]);
      $this->middleware('permiso:Controllers|editar_metodo', ['only' => ['editar_metodo']]);
      $this->middleware('permiso:Controllers|modal_add_metodo', ['only' => ['modal_add_metodo']]);
      $this->middleware('permiso:Controllers|agregar_metodo', ['only' => ['agregar_metodo']]);
      $this->middleware('permiso:Controllers|eliminar_par', ['only' => ['eliminar_par']]);
  }
  public function index()
  {
      $system_data = Sistemas::datos_sistema(1);
      $datos = [
          'system_data' => $system_data
      ];
      return view('controllers/index')->with('datos', $datos);
  }
  public function obtener_controllers()
  {
      echo json_encode( ModelController::obtenerControllers());
  }
  public function data_controller($id)
  {
      $model = ModelController::data_controller($id);
      return view('modales/controllers/editar_metodo')->with('modelo', $model);
  }
  public function editar_metodo(Request $request)
  {
      print json_encode(ModelController::editar_metodo($request));
  }
  public function modal_add_metodo()
  {
      return view('modales/controllers/nuevo_metodo');
  }
  public function agregar_metodo(Request $request)
  {
      print json_encode(ModelController::agregar_metodo($request));
  }
  public function eliminar_par($id)
  {
      print json_encode(ModelController::eliminar_metodo($id));
  }
}
