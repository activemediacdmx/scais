<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;

class Viewlog extends Model
{
  protected $table = 'view_log';
  protected $primaryKey = 'id_login';
  public $timestamps = false;

  static function logger(){
    $logins = new Viewlog();
    $dataTable = new DT(
      $logins,
      ['id_login', 'open', 'fecha_login', 'ultima_verificacion', 'fecha_logout', 'tiempo_session', 'ipv4', 'usuario', 'descripcion']
    );
    $dataTable->setFormatRowFunction(function ($logins) {
      return [
        $logins->id_login ,
        $logins->open ,
        $logins->fecha_login ,
        $logins->ultima_verificacion ,
        $logins->fecha_logout ,
        $logins->tiempo_session ,
        $logins->ipv4 ,
        $logins->usuario ,
        $logins->descripcion
      ];
    } );
    return $dataTable->make();
  }
}
