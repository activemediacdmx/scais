<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Helpme;
use DB;

class Ubicacion extends Model
{
  protected $table = 'fw_ubicacion';
  protected $primaryKey = 'id_ubicacion';
  public $timestamps = false;

  static function queryUbicaciones(){

    $ubicaciones = Ubicacion::all();

    if(count($ubicaciones)>=1){
      return $ubicaciones;
    }else{
      return false;
    }

  }
  static function obtener_ubicaciones(){
    $ubicaciones = self::queryUbicaciones();
    foreach ($ubicaciones as $row) {
      $array[]=array($row->id_ubicacion,$row->descripcion_ubicacion);
    }
    return $array;
  }
  static function select_ubicaciones($id_ubicacion){
    $ubicaciones = self::queryUbicaciones();
    $cont = 0;
    $array = array();
    if($ubicaciones){
      foreach ($ubicaciones as $row) {
        $array[$cont]['value']=$row->id_ubicacion;
        $array[$cont]['valor']=mb_strtoupper($row->descripcion_ubicacion);
        $cont++;
      }
    }
    return Helpme::setOption($array,$id_ubicacion);
  }
}
