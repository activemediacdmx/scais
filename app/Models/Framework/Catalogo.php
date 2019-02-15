<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Catalogo extends Model
{
  protected $table = 'cm_catalogo';
  protected $primaryKey = 'id_cat';
  public $timestamps = false;

  static function editar_catalogo($request){
    $edit_cat = Catalogo::find($request->input('id_cat'));
    if($request->input('id_padre') != ''){
      $edit_cat->id_padre = $request->input('id_padre');
    }
    $edit_cat->catalogo = $request->input('catalogo');
    $edit_cat->etiqueta = $request->input('etiqueta');
    $edit_cat->activo = $request->input('activo');
    $edit_cat->orden = $request->input('orden');
    $edit_cat->valor = $request->input('valor');
    $edit_cat->user_mod = $_SESSION['id_usuario'];
    if($edit_cat->save())
    {
      $respuesta = array('resp' => true , 'mensaje' => 'Registro guardado correctamente.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al insertar registro.' );
    }
    return $respuesta;
  }

  static function data_catalogo($id){
    $metodo = Catalogo::all()->where('id_cat','=',$id);
    if(count($metodo)>=1){
      foreach ($metodo as $row) {
        $array=array(
          $row->id_cat,
          $row->id_padre,
          $row->catalogo,
          $row->etiqueta,
          $row->activo,
          $row->orden,
          $row->valor
        );
      }
      return $array;
    }
  }

  static function eliminar_elemento($id_cat){
    $query_resp = Catalogo::where('id_cat','=',$id_cat)->delete();
    if($query_resp){
      $respuesta = array('resp' => true , 'mensaje' => 'Registro eliminado correctamente.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al eliminar registro.' );
    }
    return $respuesta;
  }
  static function agregar_elemento($request){

    $store = new Catalogo;
    if(null !== ($request->input('id_padre')) && $request->input('id_padre') != ''){ $store->id_padre = $request->input('id_padre'); }
    if(null !== ($request->input('catalogo'))) { $store->catalogo = $request->input('catalogo'); }
    if(null !== ($request->input('etiqueta'))) { $store->etiqueta = $request->input('etiqueta'); }
    if(null !== ($request->input('activo'))) { $store->activo = $request->input('activo'); }
    if(null !== ($request->input('orden'))) { $store->orden = $request->input('orden'); }
    if(null !== ($request->input('valor'))) { $store->valor = $request->input('valor'); }

    $store->user_alta = $_SESSION['id_usuario'];
    $store->fecha_alta = date("Y-m-d H:i:s");

    if($store->save()){
      $respuesta = array('resp' => true , 'mensaje' => 'Registro guardado correctamente.' );
    }else{
      $respuesta = array('resp' => false , 'mensaje' => 'Error en el sistema.' , 'error' => 'Error al insertar registro.' );
    }
    return $respuesta;
  }

  static function selectCatalog($tipo,$id_cat=null){
      $array = array();
      $cat = Catalogo::where('catalogo','=',$tipo)
                  ->where('activo','=',1)
                  ->orderBy('orden','asc')
                  ->get();
      if(count($cat)>=1){
          $cont = 0;
          foreach ($cat as $row) {
              $array[$cont]['value']=$row->id_cat;
              $array[$cont]['valor']=$row->etiqueta;
              $cont++;
          }
      }
      return Helpme::setOption($array,$id_cat);
  }

  static function listaCatalogo(){
    $dataTable = new DT(
      Catalogo::where('id_cat', '>', 0),
      ['id_cat', 'id_padre', 'catalogo', 'etiqueta', 'activo', 'orden', 'valor']
    );
    return $dataTable->make();
  }

  static function getJsonCatalogo($name_cat,$id_padre,$other=null){
    //$data_catalogo = Catalogo::where('catalogo','=',$name_cat)->where('id_padre','=',$id_padre)->get();
      $data_catalogo = Catalogo::where('catalogo','=',$name_cat)->where('id_padre','=',$id_padre);

      if($other!=null){$data_catalogo->orWhere('valor','=','cat_lugar_nacimiento');}
      $data_catalogo = $data_catalogo->get();

      if(count($data_catalogo)>=1){
        foreach ($data_catalogo as $row) {
          $array[]=array('id'=>$row->id_cat,'value'=>$row->etiqueta);
        }
        return $array;
      }

      if(count($data_catalogo)>=1){
        foreach ($data_catalogo as $row) {
          $array[]=array('id'=>$row->id_cat,'value'=>$row->etiqueta);
        }
        return $array;
      }
  }

  /*static function getNameByIdCatalogo($id){
    $results = DB::select("SELECT etiqueta from framework.cm_catalogo where id_cat = '$id';");
    return $results[0]->etiqueta;
  }*/

  public function getNameByIdCatalogo($tabla,$campo,$whereName,$id){
      $results = DB::select("SELECT $campo from $tabla where $whereName = '$id';");
      if(count($results)>0){
          return $results[0]->$campo;
      }
  }
  public function getIdByName($tabla,$campo,$whereName,$name){
      $results = DB::select("SELECT $campo from $tabla where $whereName = '$name';");
      if(count($results)>0){
          return $results[0]->$campo;
      }
  }
  public function selectOtherCatalog($tabla, $id_cat, $campo, $id_set = null){
      $array = array();
      $cat = DB::select("SELECT $id_cat,$campo from $tabla;");

      if(count($cat)>=1){
          $cont = 0;
          foreach ($cat as $row) {
              $array[$cont]['value']=$row->$id_cat;
              $array[$cont]['valor']=$row->$campo;
              $cont++;
          }
      }
      return Helpme::setOption($array,$id_set);
  }

  public function getAllDataCatalogo($name_catalogo){
      $data = DB::table('cm_catalogo')
            ->select('*')
            ->where('catalogo',$name_catalogo)
            ->where('activo',1)
            ->get();
      return $data;
  }
}
