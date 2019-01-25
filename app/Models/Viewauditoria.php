<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Viewauditoria extends Model
{
  protected $table = 'view_auditoria';
  protected $primaryKey = 'id_auditoria';
  public $timestamps = false;

  static function auditar(){
    $audit = new Viewauditoria();
    $dataTable = new DT(
      $audit,
      ['id_auditoria', 'id_sistema', 'permiso', 'ip', 'url', 'token_session', 'usuario', 'id_usuario', 'fecha_alta']
    );

    $dataTable->setFormatRowFunction(function ($audit) {
      return [
        $audit->id_auditoria ,
        $audit->id_sistema ,
        $audit->permiso ,
        $audit->ip ,
        $audit->url ,
        $audit->token_session ,
        $audit->usuario ,
        $audit->id_usuario ,
        $audit->fecha_alta
      ];
    });
    return $dataTable->make();
  }


  static function descriptivo($id_usuario, $date = null){

    $facha = ($date == null)?date('Y-m-d'):$date;
    $out = DB::table('fw_auditoria as fwa')
              ->join('fw_usuarios as fwu','fwa.user_alta','=','fwu.id_usuario')
              ->join('fw_metodos as fwm','fwa.id_metodo','=','fwm.id_metodo')
              ->select('fwa.id_auditoria', 'fwu.id_usuario','fwu.usuario', 'fwm.id_metodo', 'fwa.fecha_alta', 'fwm.descripcion')
              ->where('fwu.id_usuario', '=', $id_usuario)
              ->where('fwa.fecha_alta', 'LIKE', $facha.'%')
              ->orderBy('fwa.id_auditoria', 'DESC')
              ->get();
    return $out;
  }

}
