<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Controllers extends Model
{
  protected $table = 'fw_metodos';
  protected $primaryKey = 'id_metodo';
  public $timestamps = false;


  static function eliminar_metodo($id_metodo){
    $sql0 = DB::table('fw_permisos')->where('id_metodo', '=', $id_metodo)->delete();
    if($sql0 >= 0){
      $sql1 = Controllers::where('id_metodo','=',$id_metodo)->delete();
    }
    if($sql0 >= 0){
      $respuesta = array('resp' => true , 'mensaje' => 'Registro eliminado correctamente.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al eliminar registro.' );
    }
    return $respuesta;
  }

  static function agregar_metodo($request){

    $store = new Controllers;
    $store->controlador = $request->input('controlador');
    $store->metodo = $request->input('metodo');
    $store->id_sistema = 1;
    $store->nombre = $request->input('nombre');
    $store->descripcion = $request->input('descripcion');
    $store->user_alta = $_SESSION['id_usuario'];
    $store->fecha_alta = date("Y-m-d H:i:s");
    if($store->save()){
      $respuesta = array('resp' => true , 'mensaje' => 'Registro guardado correctamente.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al insertar registro.' );
    }
    return $respuesta;
  }

  static function editar_metodo($request){

    $upd_metodo = Controllers::find($request->input('id_metodo'));
    $upd_metodo->controlador = $request->input('controlador');
    $upd_metodo->metodo = $request->input('metodo');
    $upd_metodo->nombre = $request->input('nombre');
    $upd_metodo->descripcion = $request->input('descripcion');
    $upd_metodo->user_mod = $_SESSION['id_usuario'];
    if($upd_metodo->save())
    {
      $respuesta = array('resp' => true , 'mensaje' => 'Registro guardado correctamente.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al insertar registro.' );
    }

    return $respuesta;
  }

  static function data_controller($id){
    return Controllers::find($id);
  }

  static function obtenerControllers(){
    $dataTable = new DT(
      Controllers::where('id_metodo', '>', 0),
      ['id_metodo', 'controlador', 'metodo', 'nombre', 'descripcion']
    );
    return $dataTable->make();
  }
}
