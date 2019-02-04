<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;

class Viewsistemas extends Model
{
  protected $table = 'view_sistemas';
  protected $primaryKey = 'id_sistema';
  public $timestamps = false;

  static function listado_sistemas(){
    $system = new Viewsistemas();
    $dataTable = new DT(
      $system,
      ['id_sistema', 'nombre', 'nombre_largo', 'descripcion', 'system_key']
    );

    $dataTable->setFormatRowFunction(function ($system) {
      return [
        $system->id_sistema ,
        $system->nombre ,
        $system->nombre_largo ,
        $system->descripcion,
        $system->system_key,
        self::ou1($system->id_sistema)
      ];
    });
    return $dataTable->make();
  }

  static function ou1($id_sistema){

    $salida = '';

    if(Helpme::tiene_permiso('Sistemas|inicializar')){
      $salida .= '
      <a data-function="'.$id_sistema.'" class="sys_js_fn_17 btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
        <i class="flaticon-rocket"></i>
      </a>
      ';
    }

    if(Helpme::tiene_permiso('Sistemas|editar_sistema')){
      $salida .= '
      <a data-function="'.$id_sistema.'" class="sys_js_fn_03 btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
        <i class="flaticon-cogwheel"></i>
      </a>
      ';
    }
    return $salida;
  }
}
