<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Permisos extends Model
{
  protected $table = 'fw_metodos';
  protected $primaryKey = 'id_metodo';
  public $timestamps = false;


  static function obtenerControllers($id_sistema){
    $dataTable = new DT(
      Permisos::where('id_metodo', '>', 0)->where('id_sistema','=',$id_sistema),
      ['id_metodo', 'controlador', 'metodo', 'nombre', 'descripcion']
    );
    return $dataTable->make();
  }


  static function agregar_metodo($request){

    $id_metodo = DB::table('fw_metodos')->insertGetId(
        [
            'controlador' => $request->input('controlador'),
            'metodo' => $request->input('metodo'),
            'id_sistema' => $request->input('id_sistema'),
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'user_alta' => $_SESSION['id_usuario'],
            'fecha_alta' => date("Y-m-d H:i:s")
        ]
    );


    if($id_metodo){
      $datametodo = self::data_controller($id_metodo);
      Usuarios::setRemoteMetodo($datametodo);
          $respuesta = array(
                    'resp' => true ,
                    'mensaje' => 'Registro guardado correctamente.'
          );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al insertar registro.' );
    }
    return $respuesta;
  }


  static function eliminar_metodo($id_metodo){
    $sql0 = DB::table('fw_permisos')->where('id_metodo', '=', $id_metodo)->delete();
    if($sql0){
      $sql1 = Permisos::where('id_metodo','=',$id_metodo)->delete();
    }
    if($sql1){
      $respuesta = array('resp' => true , 'mensaje' => 'Registro eliminado correctamente.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al eliminar registro.' );
    }
    return $respuesta;
  }

  static function editar_metodo($request){

    $upd_metodo = Permisos::find($request->input('id_metodo'));
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
    $metodo = Permisos::all()->where('id_metodo','=',$id);
    if(count($metodo)>=1){
      foreach ($metodo as $row) {
        $array[]=array(
          'id_metodo' => $row->id_metodo,
          'id_sistema' => $row->id_sistema,
          'controlador' => $row->controlador,
          'metodo' => $row->metodo,
          'nombre' => $row->nombre,
          'descripcion' => $row->descripcion
        );
      }
    }
    return $array;
  }


}
