<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewLogins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `view_logins` AS select `fw_login`.`id_login` AS `id_login`,`fw_usuarios`.`usuario` AS `usuario`,concat(`fw_usuarios`.`nombres`,' ',`fw_usuarios`.`apellido_paterno`,' ',`fw_usuarios`.`apellido_materno`) AS `nombre`,`fw_login`.`fecha_login` AS `fecha_login`,`fw_login`.`ultima_verificacion` AS `ultima_verificacion`,`fw_login`.`ipv4` AS `ipv4`,`fw_login`.`session_id` AS `session_id`,`fw_usuarios`.`id_usuario` AS `id_usuario`,`sistemas_usuario`.`id_sistema` AS `id_sistema` from ((`fw_login` join `fw_usuarios` on((`fw_login`.`id_usuario` = `fw_usuarios`.`id_usuario`))) join `sistemas_usuario` on((`sistemas_usuario`.`id_usuario` = `fw_usuarios`.`id_usuario`))) where (`fw_login`.`open` = 1);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_logins");
    }
}
