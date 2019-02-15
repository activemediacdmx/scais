<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFwPermisosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'fw_permisos';

    /**
     * Run the migrations.
     * @table fw_permisos
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_permiso');
            $table->unsignedInteger('id_metodo')->nullable()->default(null);
            $table->unsignedInteger('id_rol')->nullable()->default(null);
            $table->integer('user_alta')->nullable()->default(null);
            $table->integer('user_mod')->nullable()->default(null);
            $table->dateTime('fecha_alta')->nullable()->default(null);
            $table->dateTime('fecha_mod')->nullable()->default(null);

            $table->index(["id_rol"], 'fk_permisos_roles_1');

            $table->index(["id_metodo"], 'fk_permisos_metodos_1');


            $table->foreign('id_metodo', 'fk_permisos_metodos_1')
                ->references('id_metodo')->on('fw_metodos')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('id_rol', 'fk_permisos_roles_1')
                ->references('id_rol')->on('fw_roles')
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
