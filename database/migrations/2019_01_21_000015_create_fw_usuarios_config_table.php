<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFwUsuariosConfigTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'fw_usuarios_config';

    /**
     * Run the migrations.
     * @table fw_usuarios_config
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_usuario_config');
            $table->unsignedInteger('id_usuario')->nullable()->default(null);
            $table->string('avatar')->nullable()->default(null);
            $table->integer('paginacion')->nullable()->default(null);
            $table->string('activar_paginado', 5)->nullable()->default(null);
            $table->string('aceptar_tyc', 2)->nullable()->default(null);
            $table->date('fecha_ingreso')->nullable()->default(null);
            $table->integer('user_alta')->nullable()->default(null);
            $table->integer('user_mod')->nullable()->default(null);
            $table->dateTime('fecha_alta')->nullable()->default(null);
            $table->dateTime('fecha_mod')->nullable()->default(null);

            $table->index(["id_usuario"], 'fk_usuarios_config_usuarios_1');


            $table->foreign('id_usuario', 'fk_usuarios_config_usuarios_1')
                ->references('id_usuario')->on('fw_usuarios')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
