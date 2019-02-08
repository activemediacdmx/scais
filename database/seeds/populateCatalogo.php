<?php

use Illuminate\Database\Seeder;

class populateCatalogo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>1,
      'id_padre'=>NULL,
      'catalogo'=>'tipo_ubicacion',
      'etiqueta'=>'Oficinas Centrales',
      'activo'=>'1',
      'orden'=>0,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2017-11-15 18:25:59'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>2,
      'id_padre'=>NULL,
      'catalogo'=>'tipo_ubicacion',
      'etiqueta'=>'Base',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>3,
      'id_padre'=>NULL,
      'catalogo'=>'status',
      'etiqueta'=>'Activo',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>4,
      'id_padre'=>NULL,
      'catalogo'=>'status',
      'etiqueta'=>'Inactivo',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>5,
      'id_padre'=>NULL,
      'catalogo'=>'status',
      'etiqueta'=>'Eliminado',
      'activo'=>'1',
      'orden'=>3,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>6,
      'id_padre'=>NULL,
      'catalogo'=>'tiporol',
      'etiqueta'=>'Framework',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>7,
      'id_padre'=>NULL,
      'catalogo'=>'tiporol',
      'etiqueta'=>'Cliente',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>8,
      'id_padre'=>NULL,
      'catalogo'=>'tiporol',
      'etiqueta'=>'Operacion',
      'activo'=>'1',
      'orden'=>3,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:14'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>9,
      'id_padre'=>NULL,
      'catalogo'=>'status',
      'etiqueta'=>'Login Fallido',
      'activo'=>'1',
      'orden'=>4,
      'valor'=>NULL,
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>10,
      'id_padre'=>NULL,
      'catalogo'=>'pass_chge',
      'etiqueta'=>'Requerir cambio de password',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>NULL,
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:52:04'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>11,
      'id_padre'=>NULL,
      'catalogo'=>'pass_chge',
      'etiqueta'=>'No requerir cambio de password',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>NULL,
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:52:40'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>12,
      'id_padre'=>NULL,
      'catalogo'=>'access_name',
      'etiqueta'=>'Acceso a Roles',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>NULL,
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2019-01-03 12:16:22',
      'fecha_mod'=>NULL
      ));


      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>13,
      'id_padre'=>NULL,
      'catalogo'=>'status',
      'etiqueta'=>'Unsync',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));


      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>14,
      'id_padre'=>NULL,
      'catalogo'=>'status_sistema',
      'etiqueta'=>'Activo',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2019-01-06 09:49:08',
      'fecha_mod'=>NULL
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>15,
      'id_padre'=>NULL,
      'catalogo'=>'status_sistema',
      'etiqueta'=>'Mantenimiento',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2019-01-06 09:49:29',
      'fecha_mod'=>NULL
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>16,
      'id_padre'=>NULL,
      'catalogo'=>'status_sistema',
      'etiqueta'=>'Suspendido',
      'activo'=>'1',
      'orden'=>3,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2019-01-06 09:50:13',
      'fecha_mod'=>NULL
      ));

    }
}
