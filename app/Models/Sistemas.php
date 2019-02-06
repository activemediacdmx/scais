<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Helpme;
use DB;

class Sistemas extends Model
{
  protected $table = 'sistemas';
  protected $primaryKey = 'id_sistema';
  public $timestamps = false;

  static function listado_sistemas(){
    return Sistemas::all();
  }

  static public function systemKey($system_id){
    return  DB::table('sistemas')
                    ->select('nombre','system_key','url')
                    ->where('id_sistema', '=', $system_id)
                    ->get();
  }
  static function sistemas_accesibles($id_usuario){
    return DB::table('sistemas as s')
                    ->join('sistemas_usuario as su','su.id_sistema','=','s.id_sistema')
                    ->where('s.id_sistema', '!=', 1)
                    ->where('su.id_usuario', '=', $id_usuario)
                    ->get();
  }

  static function setear_permiso($id_usuario, $id_sistema, $estado){
    if($estado == 'true'){
        $query_resp = DB::table('sistemas_usuario')->insert([
          [
            'id_sistema' => $id_sistema,
            'id_usuario' => $id_usuario,
            'user_alta' => $_SESSION['id_usuario'],
            'fecha_alta' => date("Y-m-d H:i:s")
          ]
      ]);
    }else if ($estado == 'false'){
      $query_resp = DB::table('sistemas_usuario')
                          ->where('id_sistema', '=', $id_sistema)
                          ->where('id_usuario', '=', $id_usuario)
                          ->delete();
    }
    if($query_resp){
      $respuesta = array('resp' => true , 'mensaje' => 'Se actualizo el acceso al sistema de manera satisfactoria.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Ocurrio un error mientras se ejectutaba la query.' );
    }
    return $respuesta;
  }

  static 	function getAccesos($id_sistema, $id_usuario){
      $id_sistema = intval($id_sistema);
      $id_usuario = intval($id_usuario);
      return DB::table('sistemas_usuario')
                ->where('id_sistema','=', $id_sistema)
                ->where('id_usuario','=', $id_usuario)
                ->count();
  }

  static function listado_sistemas_SINUSAR(){
    $dataTable = new DT(
      Sistemas::where('id_sistema', '!=', 1),
      ['id_sistema', 'nombre', 'nombre_largo', 'descripcion']
    );
    return $dataTable->make();
  }

  static function agregar_sistema($request){
    $store = new Sistemas;

    if(null !== ($request->input('nombre'))) { $store->nombre = $request->input('nombre'); }
    if(null !== ($request->input('nombre_largo'))) { $store->nombre_largo = $request->input('nombre_largo'); }
    if(null !== ($request->input('descripcion'))) { $store->descripcion = $request->input('descripcion'); }
    if(null !== ($request->input('url'))) { $store->url = $request->input('url'); }

    $store->system_key = strtoupper(Helpme::token(40));

    if(null !== ($request->input('cat_status_sistema'))) { $store->cat_status_sistema = $request->input('cat_status_sistema'); }

    $store->user_alta = $_SESSION['id_usuario'];
    $store->fecha_alta = date("Y-m-d H:i:s");

    if($store->save()){
      $respuesta = array('resp' => true , 'mensaje' => 'Sistema guardado correctamente.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al insertar el sistema.' );
    }
    return $respuesta;
  }

  static function datos_sistema($id_sistema){
    return Sistemas::find($id_sistema);
  }
  static function editar_sistema($request){
    $query_resp = DB::table('sistemas')
            ->where('id_sistema', $request->input('id_sistema'))
            ->update([
                'nombre'=> $request->input('nombre'),
                'nombre_largo'=> $request->input('nombre_largo'),
                'descripcion'=> $request->input('descripcion'),
                'url'=> $request->input('url'),
                'system_key'=> strtoupper(Helpme::token(40)),
                'cat_status_sistema'=> $request->input('cat_status_sistema'),
                'user_mod'=> $_SESSION['id_usuario'],
                'fecha_mod'=> date("Y-m-d H:i:s")
            ]);
    if($query_resp){
      $respuesta = array('resp' => true , 'mensaje' => 'Se actualizó la información del sistema correctamente.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al editar el sistema.' );
    }
    return $respuesta;
  }
}
