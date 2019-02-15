<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `view_log` AS select `fw_login`.`id_login` AS `id_login`,`fw_login`.`open` AS `open`,`fw_login`.`fecha_login` AS `fecha_login`,`fw_login`.`ultima_verificacion` AS `ultima_verificacion`,`fw_login`.`fecha_logout` AS `fecha_logout`,`fw_login`.`tiempo_session` AS `tiempo_session`,`fw_login`.`ipv4` AS `ipv4`,`fw_usuarios`.`usuario` AS `usuario`,`fw_roles`.`descripcion` AS `descripcion`,`sistemas_usuario`.`id_sistema` AS `id_sistema` from (((`fw_login` join `fw_usuarios` on((`fw_login`.`id_usuario` = `fw_usuarios`.`id_usuario`))) join `fw_roles` on((`fw_usuarios`.`id_rol` = `fw_roles`.`id_rol`))) join `sistemas_usuario` on((`sistemas_usuario`.`id_usuario` = `fw_usuarios`.`id_usuario`)));");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_log");
    }
}
