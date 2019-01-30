<?php

use Illuminate\Database\Seeder;

class populateSistemas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('sistemas')->insert(
      array(
      'id_sistema'=>1,
      'cat_status_sistema'=>13,
      'nombre'=>'SCAIS',
      'nombre_largo'=>'Sistema de control de acceso a infraestructura y servicios',
      'descripcion'=>'Sistema para centralizar la gestión de usuarios',
      'system_key'=>'XDKFXRENTHC0Y8AOQDLI6B2UUBZLMTRIJZOQ4YVM',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2019-01-05 19:13:09',
      'fecha_mod'=>'2019-01-06 01:01:35'
      ));
    }
}
