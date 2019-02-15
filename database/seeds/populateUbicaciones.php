<?php

use Illuminate\Database\Seeder;

class populateUbicaciones extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('fw_ubicacion')->insert(
      array(
      'id_ubicacion'=>1,
      'descripcion_ubicacion'=>'Dirección General de Informática',
      'direccion'=>'Direccion',
      'cat_tipo_ubicacion'=>1,
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-09 07:31:50'
      ) );
    }
}
