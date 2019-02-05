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
      'url'=>'http://10.1.25.41/',
      'descripcion'=>'Sistema para centralizar la gestión de usuarios',
      'system_key'=>'XDKFXRENTHC0Y8AOQDLI6B2UUBZLMTRIJZOQ4YVM',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2019-01-05 19:13:09',
      'fecha_mod'=>'2019-01-06 01:01:35'
      ));

      DB::table('sistemas')->insert(
      array(
      'id_sistema'=>2,
      'cat_status_sistema'=>13,
      'nombre'=>'Framedev',
      'nombre_largo'=>'Marco de trabajo para desarrollo ágil de aplicaciones administrativas',
      'url'=>'http://10.1.25.41:8080/',
      'descripcion'=>'Framedev Basado en el framework laravel 5.7 es un marco de trabajo con una impronta normativa que cumple con los estandares y las normas juridicas y normativas aplicables para el desarrolo de aplicaciones administrativas de la Secretaría de Administración y Finanzas de la Ciudad de México',
      'system_key'=>'5KYHRGFW2ZJKCVXFNU0EXDA4PLHG81T3ATQY76VZ',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2019-01-05 19:13:09',
      'fecha_mod'=>'2019-01-06 01:01:35'
      ));

    }
}
