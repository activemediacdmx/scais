<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFwRolesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'fw_roles';

    /**
     * Run the migrations.
     * @table fw_roles
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_rol');
            $table->unsignedInteger('cat_tiporol')->nullable()->default(null);
            $table->unsignedInteger('id_sistema')->nullable()->default(null);
            $table->string('descripcion')->nullable()->default(null);
            $table->string('token')->nullable()->default(null);
            $table->integer('user_alta')->nullable()->default(null);
            $table->integer('user_mod')->nullable()->default(null);
            $table->dateTime('fecha_alta')->nullable()->default(null);
            $table->dateTime('fecha_mod')->nullable()->default(null);

            $table->index(["id_sistema"], 'fk_fw_roles_sistemas_1');

            $table->index(["cat_tiporol"], 'fk_fw_roles_cm_catalogo_1');


            $table->foreign('cat_tiporol', 'fk_fw_roles_cm_catalogo_1')
                ->references('id_cat')->on('cm_catalogo')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('id_sistema', 'fk_fw_roles_sistemas_1')
                ->references('id_sistema')->on('sistemas')
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
