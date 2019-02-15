<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `view_usuarios` AS select `fw_usuarios`.`id_usuario` AS `id_usuario`,`fw_usuarios`.`usuario` AS `usuario`,`fw_usuarios`.`correo` AS `correo`,`fw_usuarios`.`nombres` AS `nombres`,`fw_usuarios`.`apellido_paterno` AS `apellido_paterno`,`fw_usuarios`.`apellido_materno` AS `apellido_materno`,`fw_roles`.`descripcion` AS `descripcion`,`fw_usuarios`.`cat_status` AS `cat_status` from (`fw_usuarios` join `fw_roles` on((`fw_usuarios`.`id_rol` = `fw_roles`.`id_rol`)));");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_usuarios");
    }
}
