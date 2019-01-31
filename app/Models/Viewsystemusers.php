<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;

class Viewsystemusers extends Model
{
  protected $table = 'view_usuarios_sistemas';
  protected $primaryKey = 'id_usuario';
  public $timestamps = false;

  static function obtener_usuarios($id_sistema){
    $users = new Viewsystemusers();
    $dataTable = new DT(
      $users->where('id_sistema','=', $id_sistema),
      ['id_usuario', 'usuario', 'correo', 'nombres', 'apellido_paterno', 'apellido_materno', 'descripcion', 'cat_status', 'id_sistema']
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
        self::ou2($users->id_usuario,$users->cat_status,$users->id_sistema)
      ];
    });
    return $dataTable->make();
  }

  static function ou2($id_usuario, $cat_status, $id_sistema){

    $salida = '
    <a data-function="'.$id_usuario.'" data-system="'.$id_sistema.'" class="sys_js_fn_10 btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
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

    return $salida;
  }
}
