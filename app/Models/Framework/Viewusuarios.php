<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;

class Viewusuarios extends Model
{
  protected $table = 'view_usuarios';
  protected $primaryKey = 'id_usuario';
  public $timestamps = false;

  static function obtener_usuarios(){
    $users = new Viewusuarios();
    $dataTable = new DT(
      $users,
      ['id_usuario', 'usuario', 'correo', 'nombres', 'apellido_paterno', 'apellido_materno', 'descripcion', 'cat_status']
    );

    $dataTable->setFormatRowFunction(function ($users) {
      return [
        $users->id_usuario ,
        $users->usuario ,
        $users->correo ,
        $users->nombres ,
        $users->apellido_paterno ,
        $users->apellido_materno ,
        $users->descripcion ,
        self::ou2($users->id_usuario,$users->cat_status)
      ];
    });
    return $dataTable->make();
  }

  static function ou2($id_usuario, $cat_status){


    $salida = '
    <a data-function="'.$id_usuario.'" class="usr_js_fn_03 btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
      <i class="flaticon-cogwheel"></i>
    </a>
    ';
    if($cat_status == 9){
        $salida .= '
        <a data-function="'.$id_usuario.'" id="usr_js_fn_07" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
          <i class="flaticon-lock"></i>
        </a>
        ';
    }

    if(Helpme::tiene_permiso('Sistemas|relacionar_sistemas')){
      $salida .= '
      <a data-function="'.$id_usuario.'" class="sys_js_fn_05 btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
        <i class="flaticon-imac"></i>
      </a>
      ';
    }

    if(Helpme::tiene_permiso('Login|auditoria')){
      $salida .= '
      <a data-function="'.$id_usuario.'" class="usr_js_fn_09 btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
        <i class="flaticon-eye"></i>
      </a>
      ';
    }

    return $salida;
  }
}
