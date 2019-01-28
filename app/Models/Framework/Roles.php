<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Helpme;
use DB;

class Roles extends Model
{
  protected $table = 'fw_roles';
  protected $primaryKey = 'id_rol';
  public $timestamps = false;


  static function setOption_U($arreglo){
    $opciones = "<option value='' disabled selected>Seleccione</option>";
      for($i=0;$i<count($arreglo);$i++){
        $opciones .= "<option value='".$arreglo[$i]['value']."'>".ucwords($arreglo[$i]['valor'])."</option>";
      }
    return $opciones;
  }

  static function select_roles(){
    return self::setOption_U(self::check_roles());
  }

  static function check_roles(){

    $roles = DB::table('fw_roles AS rol')
              ->join('cm_catalogo AS cat','rol.cat_tiporol','=','cat.id_cat')
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

  static function getPermiso($role,$metodo){

    $metodos = DB::table('fw_permisos')
              ->where('id_metodo','=', $metodo)
              ->count();

    if(count($metodos)>=1){
      return $metodos;
    }
  }

  static 	function getAccesos($id_rol,$access,$propietario,$acceso){
      $id_rol = intval($id_rol);
      $access = intval($access);
      return DB::table('fw_acceso')
                ->where('id_propietario','=', $id_rol)
                ->where('id_access','=', $access)
                ->where('propietario','=', $propietario)
                ->where('access','=', $acceso)
                ->count();
  }

  static function setear_acceso($id_rol,$access,$estado,$propietario,$acceso){
    if($estado == 'true'){
        $query_resp = DB::table('fw_acceso')->insert([
            [
              'id_propietario' => $id_rol,
              'cat_access_name' => 12,
              'id_access' => $access,
              'propietario' => $propietario,
              'access' => $acceso,
              'user_alta' => $_SESSION['id_usuario'],
              'fecha_alta' => date("Y-m-d H:i:s")
            ]
        ]);
    }else if ($estado == 'false'){
      $query_resp = DB::table('fw_acceso')
                          ->where('id_propietario','=', $id_rol)
                          ->where('id_access','=', $access)
                          ->where('propietario','=', $propietario)
                          ->where('access','=', $acceso)
                          ->delete();
    }
    if($query_resp){
      $respuesta = array('resp' => true , 'mensaje' => 'Se actualizo el permiso de manera satisfactoria.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Ocurrio un error mienras se ejectutaba la query.' );
    }
    return $respuesta;
  }

  static function setear_permiso($role,$metodo,$estado){
    if($estado == 'true'){
        $query_resp = DB::table('fw_permisos')->insert([
          [
            'id_metodo' => $metodo,
            'id_rol' => $role,
            'user_alta' => $_SESSION['id_usuario'],
            'fecha_alta' => date("Y-m-d H:i:s")
          ]
      ]);
    }else if ($estado == 'false'){
      $query_resp = DB::table('fw_permisos')
                          ->where('id_metodo', '=', $metodo)
                          ->where('id_rol', '=', $role)
                          ->delete();
    }
    if($query_resp){
      $respuesta = array('resp' => true , 'mensaje' => 'Se actualizo el permiso de manera satisfactoria.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Ocurrio un error mienras se ejectutaba la query.' );
    }
    return $respuesta;
  }

  static function getPermisos($rol,$metodo){
    $rol = intval($rol);
    $metodo = intval($metodo);

    return DB::table('fw_permisos')
              ->where('id_rol','=', $rol)
              ->where('id_metodo','=', $metodo)
              ->count();
  }

  static function getMetodos(){
    $metodos = DB::table('fw_metodos')
              ->orderBy('controlador', 'asc')
              ->get();
    if(count($metodos)>=1){
      return $metodos;
    }
  }

  static function get_rol($rol){
    $rol = intval($rol);
    $descripcion = DB::table('fw_roles')
              ->where('id_rol','=',$rol)
              ->select('descripcion')
              ->get();
    $array = array();
    if(count($descripcion)>=1){
      foreach ($descripcion as $row) {
          return $row->descripcion;
      }
    }
  }

  static function agregar_rol($request){

    $query_resp = DB::table('fw_roles')->insert([
        [
          'descripcion' => $request->input('descripcion'),
          'cat_tiporol' => $request->input('cat_tiporol'),
          'id_sistema' => 1,
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
  static function selectRoles($id){
    $array = array();
    $roles = Roles::all();
    if(count($roles)>=1){
      $cont = 0;
      foreach ($roles as $row) {
        $array[$cont]['value']=$row->id_rol;
        $array[$cont]['valor']=strtoupper($row->descripcion);
        $cont++;
      }
    }
    return Helpme::setOption($array,$id);
  }

  static function obtenerRoles(){
    $roles = self::queryRoles();
    foreach ($roles as $row) {
      $array[]=array($row->id_rol,$row->descripcion);
    }
    return $array;
  }

  static function queryRoles(){
    $roles = DB::table('cm_catalogo')
              ->join('fw_roles','fw_roles.cat_tiporol','=','cm_catalogo.id_cat')
              ->where('fw_roles.id_sistema', '=', 1)
              ->select('fw_roles.id_rol', 'cm_catalogo.etiqueta', 'fw_roles.descripcion')
              ->get();
    if(count($roles)>=1){
      return $roles;
    }
  }
  static function rol(){
       $id_rol = isset($_SESSION['id_rol']) ? $_SESSION['id_rol'] : '';
       return Roles::find($id_rol);
  }
  static function clonar_permisos($id_rol,$transfer){
    $rolxprocesar = self::obtenerPermisosRol($id_rol);
    $info = "SIN PROCESAR";
    if(count($rolxprocesar)>=1){
      self::vaciarPermisosRol($transfer);
      foreach ($rolxprocesar as $row) {
        self::insertPermiso($row,$transfer);
        $new_permission = self::getDescription($transfer);
        $info = self::connerInfo($row, $new_permission);
      }
    }
    return $info;
  }
  static function vaciarPermisosRol($transfer){
    DB::table('fw_permisos')
              ->where('id_rol', '=', $transfer)
              ->delete();
  }
  static function obtenerPermisosRol($id_rol){
    return DB::table('fw_permisos')
              ->join('fw_roles','fw_permisos.id_rol','=','fw_roles.id_rol')
              ->select('fw_permisos.id_permiso', 'fw_permisos.id_metodo', 'fw_permisos.id_rol')
              ->where('fw_roles.id_rol', '=', $id_rol)
              ->get();
  }
  static function connerInfo($row, $new_permission){
    $roles = DB::table('fw_permisos')
              ->join('fw_roles','fw_permisos.id_rol','=','fw_roles.id_rol')
              ->join('fw_metodos','fw_permisos.id_metodo','=','fw_metodos.id_metodo')
              ->select('fw_metodos.metodo', 'fw_metodos.controlador', 'fw_roles.descripcion')
              ->where('fw_permisos.id_permiso', '=', $row->id_permiso)
              ->get();

    if(count($roles)>=1){
      foreach ($roles as $perm) {
        return 'Se clono el permiso '.$perm->controlador.'|'.$perm->metodo.' del '.$perm->descripcion.' al '.$new_permission.'<br>';
      }
    }
  }
  static function getDescription($transfer){
    $roles = Roles::all()
              ->where('id_rol','=',$transfer);
    if(count($roles)>=1){
      foreach ($roles as $new) {
        echo $new->descripcion;
      }
    }
  }
  static function insertPermiso($row,$transfer){
    DB::table('fw_permisos')->insert([
        [
          'id_metodo' => $row->id_metodo,
          'id_rol' => $transfer,
          'user_alta' => $_SESSION['id_usuario'],
          'fecha_alta' => date("Y-m-d H:i:s")
        ]
    ]);
  }
  static function selectUsersByRoles($ids_roles,$id_usuario){
    $array = array();
    $access = DB::table('fw_usuarios')
              ->join('fw_roles','fw_roles.id_rol','=','fw_usuarios.id_rol')
              ->select(DB::raw('CONCAT(nombres," ",apellido_paterno," ", apellido_materno) AS nombre'),'id_usuario')
              ->whereIn('fw_usuarios.id_rol', explode(',',$ids_roles))
              ->get();
    if(count($access)>=1){
      $cont = 0;
      foreach ($access as $row) {
          $array[$cont]['value']=$row->nombre;
          $array[$cont]['valor']=$row->nombre;
          $cont++;
      }
    }
    return Helpme::setOption($array,$id_usuario);
  }

  static function selectRolesByTipo($cat_tiporol,$id_rol,$select = NULL){
    $accesos = self::selectRolesByAccess($id_rol);
    //Controlador::bug('selectRolesByAccess >> '.$accesos);

    $roles = DB::table('fw_roles')
              ->whereIn('cat_tiporol',explode(',',$cat_tiporol))
              ->whereIn('id_rol',explode(',',$accesos))->get();

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
}
