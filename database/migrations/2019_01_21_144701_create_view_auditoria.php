<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewAuditoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `view_auditoria` AS select `fw_auditoria`.`id_auditoria` AS `id_auditoria`,`fw_metodos`.`id_sistema` AS `id_sistema`,`fw_metodos`.`controlador` AS `controlador`,`fw_metodos`.`metodo` AS `metodo`,`fw_auditoria`.`permiso` AS `permiso`,`fw_auditoria`.`ip` AS `ip`,`fw_auditoria`.`url` AS `url`,`fw_auditoria`.`method` AS `method`,`fw_auditoria`.`token_session` AS `token_session`,`fw_auditoria`.`fecha_alta` AS `fecha_alta`,`fw_usuarios`.`usuario` AS `usuario`,`fw_usuarios`.`id_usuario` AS `id_usuario` from ((`fw_auditoria` join `fw_metodos` on((`fw_auditoria`.`id_metodo` = `fw_metodos`.`id_metodo`))) join `fw_usuarios` on((`fw_auditoria`.`user_alta` = `fw_usuarios`.`id_usuario`)));");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_auditoria");
    }
}
