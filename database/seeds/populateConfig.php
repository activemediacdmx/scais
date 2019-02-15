<?php

use Illuminate\Database\Seeder;

class populateConfig extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('fw_config')->insert(
      array(
      'id_config'=>1,
      'id_site'=>1,
      'cat_config'=>NULL,
      'descripcion'=>'login_permitido',
      'valor'=>'1',
      'tmp_val'=>'0',
      'data'=>'0',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-05-28 21:15:57',
      'fecha_mod'=>'2017-08-30 05:22:03'
      ));
    }
}
