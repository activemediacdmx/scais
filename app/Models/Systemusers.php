<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Helpme;
use DB;

class Systemusers extends Model
{
  protected $table = 'fw_usuarios';
  protected $primaryKey = 'id_usuario';
  public $timestamps = false;

  static function usuarios_bloqueados(){
    return DB::table('fw_usuarios as fwu')
                  ->join('sistemas_usuario as su','su.id_usuario','=','fwu.id_usuario')
                  ->where('fwu.cat_status','=',9)
                  ->where('fwu.id_usuario','IN','su.id_usuario')
                  ->groupBy('fwu.id_usuario')
                  ->count();
  }

  static function edita_rol_usuario($request){
    $query_resp = DB::table('sistemas_usuario')
          ->where('id_usuario', $request->input('id_usuario'))
          ->where('id_sistema', $request->input('id_sistema'))
          ->update([
              'id_rol'=> $request->input('id_rol'),
              'user_mod'=> $_SESSION['id_usuario']
          ]);

    if($query_resp){
      $respuesta = array('resp' => true , 'mensaje' => 'Registro guardado correctamente.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al insertar registro.' );
    }
    return $respuesta;
  }

}
