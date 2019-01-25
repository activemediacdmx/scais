<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewSistemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `view_sistemas` AS select `sistemas`.`id_sistema` AS `id_sistema`,`sistemas`.`nombre` AS `nombre`,`sistemas`.`nombre_largo` AS `nombre_largo`,`sistemas`.`descripcion` AS `descripcion` from `sistemas` where (`sistemas`.`id_sistema` <> 1);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_sistemas");
    }
}
