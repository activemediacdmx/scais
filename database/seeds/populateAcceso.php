<?php

use Illuminate\Database\Seeder;

class populateAcceso extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('fw_acceso')->insert(
      array(
      'id_acceso'=>1,
      'cat_access_name'=>12,
      'propietario'=>'fw_roles',
      'id_propietario'=>1,
      'access'=>'fw_roles',
      'id_access'=>1,
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2019-01-03 12:14:05',
      'fecha_mod'=>NULL
      ));
    }
}
