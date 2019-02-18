<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Helpme;
use DB;

class Systemsystemusers extends Model
{
  protected $table = 'sistemas_usuario';
  protected $primaryKey = 'id_sistemas_usuario';
  public $timestamps = false;

  static function getSysOfUser($id_usuario){
    return Systemsystemusers::where('id_usuario','=',$id_usuario)->get();
  }

  static function getRolOfUserSys($id_usuario, $id_sistema){
    $i =  Systemsystemusers::select('id_rol')
                    ->where('id_usuario','=',$id_usuario)
                    ->where('id_sistema','=',$id_sistema)
                    ->first();
    return $i->id_rol;
  }

  static function getCatStatusOfUserSys($id_usuario, $id_sistema){
    $i =  Systemsystemusers::select('cat_status')
                    ->where('id_usuario','=',$id_usuario)
                    ->where('id_sistema','=',$id_sistema)
                    ->first();
    return $i->cat_status;
  }

  static function updateRelationStatus($id_usuario, $id_sistema, $cat_status){
    return Systemsystemusers::where('id_usuario', $id_usuario)
            ->where('id_sistema', $id_sistema)
            ->update([
                'cat_status'=> $cat_status
            ]);
  }

}
