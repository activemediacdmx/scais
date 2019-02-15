<?php

use Illuminate\Database\Seeder;

class populateUsuariosConfig extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('fw_usuarios_config')->insert(
      array(
        'id_usuario_config'=>1,
        'id_usuario'=>1,
        'avatar'=>'JCydUQ.jpg',
        'paginacion'=>20,
        'activar_paginado'=>'1',
        'aceptar_tyc'=>'SI',
        'fecha_ingreso'=>'1900-01-01',
        'user_alta'=>NULL,
        'user_mod'=>1,
        'fecha_alta'=>NULL,
        'fecha_mod'=>'2017-11-23 01:39:47'
      ) );
    }
}
