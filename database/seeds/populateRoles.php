<?php

use Illuminate\Database\Seeder;

class populateRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('fw_roles')->insert(
      array(
      'id_rol'=>1,
      'cat_tiporol'=>6,
      'id_sistema'=>1,
      'descripcion'=>'Desarrollador',
      'token'=>'9iILD7Q7FGfwj9QhOb7boMPbgiuQV7Kt',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ) );

      DB::table('fw_roles')->insert(
      array(
      'id_rol'=>2,
      'cat_tiporol'=>6,
      'id_sistema'=>2,
      'descripcion'=>'Desarrollador',
      'token'=>'9iILD7Q7FGfwj9QhOb7boMPbgiuQV7Kt',
      'user_alta'=>0,
      'user_mod'=>0,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ) );


    }
}
