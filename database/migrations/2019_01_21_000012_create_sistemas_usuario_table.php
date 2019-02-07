<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSistemasUsuarioTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'sistemas_usuario';

    /**
     * Run the migrations.
     * @table sistemas_usuario
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_sistemas_usuario');
            $table->unsignedInteger('id_sistema')->nullable()->default(null);
            $table->unsignedInteger('id_usuario')->nullable()->default(null);
            $table->unsignedInteger('id_rol')->nullable()->default(null);
            $table->unsignedInteger('cat_status')->nullable()->default(null);
            $table->integer('user_alta')->nullable()->default(null);
            $table->integer('user_mod')->nullable()->default(null);
            $table->dateTime('fecha_alta')->nullable()->default(null);
            $table->dateTime('fecha_mod')->nullable()->default(null);

            $table->index(["id_usuario"], 'fk_sistemas_usuario_fw_usuarios_1');

            $table->index(["id_sistema"], 'fk_sistemas_usuario_sistemas_1');

            $table->index(["id_rol"], 'fk_sistemas_usuario_roles_1');

            $table->index(["cat_status"], 'fk_sistemas_usuario_catalogo_1');


            $table->foreign('id_usuario', 'fk_sistemas_usuario_fw_usuarios_1')
                ->references('id_usuario')->on('fw_usuarios')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('id_sistema', 'fk_sistemas_usuario_sistemas_1')
                ->references('id_sistema')->on('sistemas')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('id_rol', 'fk_sistemas_usuario_roles_1')
                ->references('id_rol')->on('fw_roles')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('cat_status', 'fk_sistemas_usuario_catalogo_1')
                ->references('id_cat')->on('cm_catalogo')
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
