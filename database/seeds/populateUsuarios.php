<?php

use Illuminate\Database\Seeder;

class populateUsuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('fw_usuarios')->insert(
      array(
        'id_usuario'=>1,
        'id_area'=>NULL,
        'password'=>'21232f297a57a5a743894a0e4a801fc3',
        'usuario'=>'admin',
        'correo'=>'framedev@gmail.com',
        'id_rol'=>1,
        'nombres'=>'Usuario1',
        'apellido_paterno'=>'ap',
        'apellido_materno'=>'ap',
        'id_ubicacion'=>1,
        'cat_pass_chge'=>11,
        'cat_status'=>3,
        'user_alta'=>1,
        'user_mod'=>1,
        'fecha_alta'=>'2016-11-16 14:41:31',
        'fecha_mod'=>'2017-11-22 07:23:02'
      ) );

    }
}
