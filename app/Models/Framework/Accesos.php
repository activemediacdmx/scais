<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Accesos extends Model
{
  protected $table = 'fw_permisos';
  protected $primaryKey = 'id_permiso';
  public $timestamps = false;


  static function getAll($accesos){
    return Accesos::where('id_permiso','>=',$accesos[0])
                  ->where('id_permiso','<=',$accesos[1])
                  ->get();
  }
}
