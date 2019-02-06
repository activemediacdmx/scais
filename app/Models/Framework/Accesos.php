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


  static function getAll(){
    return Accesos::all();
  }
}
