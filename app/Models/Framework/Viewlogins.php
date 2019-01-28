<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;

class Viewlogins extends Model
{
  protected $table = 'view_logins';
  protected $primaryKey = 'id_login';
  public $timestamps = false;

  static function logueados_get(){
    $logins = new Viewlogins();
    $dataTable = new DT(
      $logins->where('id_sistema','=', 1),
      ['id_login', 'usuario','nombre','fecha_login', 'ultima_verificacion', 'ipv4', 'session_id', 'id_usuario']
    );

    $dataTable->setFormatRowFunction(function ($logins) {
      return [
        $logins->id_login ,
        $logins->usuario ,
        $logins->nombre ,
        $logins->fecha_login ,
        $logins->ultima_verificacion ,
        $logins->ipv4 ,
        $logins->session_id ,
        self::lg1($logins->id_usuario)
      ];
    } );
    return $dataTable->make();
  }

  static function logueadossystem_get($id_sistema){
    $logins = new Viewlogins();
    $dataTable = new DT(
      $logins->where('id_sistema','=', $id_sistema),
      ['id_login', 'usuario','nombre','fecha_login', 'ultima_verificacion', 'ipv4', 'session_id', 'id_usuario']
    );

    $dataTable->setFormatRowFunction(function ($logins) {
      return [
        $logins->id_login ,
        $logins->usuario ,
        $logins->nombre ,
        $logins->fecha_login ,
        $logins->ultima_verificacion ,
        $logins->ipv4 ,
        $logins->session_id ,
        self::lg1($logins->id_usuario)
      ];
    } );
    return $dataTable->make();
  }




  static function lg1($id_usuario){
    $salida = '';
    if(Helpme::tiene_permiso('Login|force_sign_out')){
      $salida .= '
      <a data-function="'.$id_usuario.'" id="comm_js_fn_04" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
        <i class="la la-power-off"></i>
      </a>
      ';
    }
    return $salida;
  }
}
