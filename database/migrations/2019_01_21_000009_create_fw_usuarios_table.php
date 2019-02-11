<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFwUsuariosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'fw_usuarios';

    /**
     * Run the migrations.
     * @table fw_usuarios
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_usuario');
            $table->unsignedInteger('id_area')->nullable()->default(null);
            $table->string('password')->nullable()->default(null);
            $table->string('usuario')->nullable()->default(null);
            $table->string('correo')->nullable()->default(null);
            $table->unsignedInteger('id_rol')->nullable()->default(null);
            $table->string('nombres')->nullable()->default(null);
            $table->string('apellido_paterno')->nullable()->default(null);
            $table->string('apellido_materno')->nullable()->default(null);
            $table->unsignedInteger('id_ubicacion')->nullable()->default(null);
            $table->unsignedInteger('cat_pass_chge')->nullable()->default(null);
            $table->unsignedInteger('cat_status')->nullable()->default(null);
            $table->string('token')->nullable()->default(null);
            $table->integer('user_alta')->nullable()->default(null);
            $table->integer('user_mod')->nullable()->default(null);
            $table->dateTime('fecha_alta')->nullable()->default(null);
            $table->dateTime('fecha_mod')->nullable()->default(null);

            $table->index(["cat_status"], 'fk_fw_usuarios_cm_catalogo_1');

            $table->index(["id_rol"], 'fk_usuarios_roles_1');

            $table->index(["id_ubicacion"], 'fk_usuarios_ubicacion_1');

            $table->index(["id_area"], 'fk_usuarios_area_1');


            $table->foreign('cat_status', 'fk_fw_usuarios_cm_catalogo_1')
                ->references('id_cat')->on('cm_catalogo')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('id_area', 'fk_usuarios_area_1')
                ->references('id_area')->on('fw_area')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('id_rol', 'fk_usuarios_roles_1')
                ->references('id_rol')->on('fw_roles')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('id_ubicacion', 'fk_usuarios_ubicacion_1')
                ->references('id_ubicacion')->on('fw_ubicacion')
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
