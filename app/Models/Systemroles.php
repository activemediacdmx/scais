<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Helpme;
use DB;

class Systemroles extends Model
{
  protected $table = 'fw_roles';
  protected $primaryKey = 'id_rol';
  public $timestamps = false;


  static function queryRoles($id_sistema){
    $roles = DB::table('cm_catalogo')
              ->join('fw_roles','fw_roles.cat_tiporol','=','cm_catalogo.id_cat')
              ->where('fw_roles.id_sistema', '=', $id_sistema)
              ->select('fw_roles.id_rol', 'cm_catalogo.etiqueta', 'fw_roles.descripcion')
              ->get();
    if(count($roles)>=1){
      return $roles;
    }
  }

  static function selectRolesSystemByTipo($cat_tiporol,$id_rol,$id_sistema,$select = NULL){
    $accesos = self::selectRolesByAccess($id_rol);

    $roles = DB::table('fw_roles')
              ->whereIn('cat_tiporol',explode(',',$cat_tiporol))
              ->whereIn('id_rol',explode(',',$accesos))
              ->where('id_sistema','=',$id_sistema)
              ->get();

    $array = array();
    if(count($roles)>=1){
      $cont = 0;
      foreach ($roles as $row) {
        $array[$cont]['value']=$row->id_rol;
        $array[$cont]['valor']=$row->descripcion;
        $cont++;
      }
    }
    return Helpme::setOption($array,$select);
  }

  static function selectRolesByAccess($id_rol){
    $access = DB::table('fw_acceso AS rolacc')
              ->join('fw_roles as rol','rolacc.id_access','=','rol.id_rol')
              ->select('rolacc.id_access', 'rol.descripcion')
              ->where('rolacc.id_propietario', '=', $id_rol)
              ->where('rolacc.propietario', '=', 'fw_roles')
              ->where('rolacc.access', '=', 'fw_roles')
              ->orderBy('rolacc.id_access','asc')
              ->get();
    $return = '';
    if(count($access)>=1){
      foreach ($access as $row) {
        $return .= $row->id_access.',';
      }
    }
    $return = rtrim($return, ",");
    return $return;
  }

  static function agregar_rol($request,$id_sistema){

    $query_resp = DB::table('fw_roles')->insert([
        [
          'descripcion' => $request->input('descripcion'),
          'cat_tiporol' => $request->input('cat_tiporol'),
          'id_sistema' => $id_sistema,
          'user_alta' => $_SESSION['id_usuario'],
          'fecha_alta' => date("Y-m-d H:i:s")
        ]
    ]);

    if($query_resp){
      $respuesta = array('resp' => true , 'mensaje' => 'Registro guardado correctamente.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al insertar registro.' );
    }

    return $respuesta;
  }

  static function get_rol($rol, $id_sistema){
    $rol = intval($rol);
    $descripcion = DB::table('fw_roles')
              ->where('id_rol','=',$rol)
              ->where('id_sistema','=',$id_sistema)
              ->select('descripcion')
              ->get();
    $array = array();
    if(count($descripcion)>=1){
      foreach ($descripcion as $row) {
          return $row->descripcion;
      }
    }
  }
  static function getMetodos($id_sistema){
    $metodos = DB::table('fw_metodos')
              ->where('id_sistema','=',$id_sistema)
              ->orderBy('controlador', 'asc')
              ->get();
    if(count($metodos)>=1){
      return $metodos;
    }
  }

  static function select_roles($id_sistema){
    $array = self::check_roles($id_sistema);
    return self::setOption_U($array);
  }

  static function setOption_U($arreglo){
    $opciones = "<option value='' disabled selected>Seleccione</option>";
      for($i=0;$i<count($arreglo);$i++){
        $opciones .= "<option value='".$arreglo[$i]['value']."'>".ucwords($arreglo[$i]['valor'])."</option>";
      }
    return $opciones;
  }

  static function check_roles($id_sistema){
    $roles = DB::table('fw_roles AS rol')
              ->join('cm_catalogo AS cat','rol.cat_tiporol','=','cat.id_cat')
              ->where('rol.id_sistema','=',$id_sistema)
              ->select('rol.id_rol', 'rol.descripcion', 'cat.etiqueta')
              ->get();
    if(count($roles)>=1){
      $cont = 0;
      $array = array();
      foreach ($roles as $row) {
        $array[$cont]['value']=$row->id_rol;
        $array[$cont]['valor']=strtoupper($row->descripcion);
        $array[$cont]['etiqueta']=strtoupper($row->etiqueta);
        $cont++;
      }
      return $array;
    }
  }
  static function getPermisos($rol,$metodo){
    $rol = intval($rol);
    $metodo = intval($metodo);

    return DB::table('fw_permisos')
              ->where('id_rol','=', $rol)
              ->where('id_metodo','=', $metodo)
              ->count();
  }

}
