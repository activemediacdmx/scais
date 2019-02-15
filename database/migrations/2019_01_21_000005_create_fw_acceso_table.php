<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFwAccesoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'fw_acceso';

    /**
     * Run the migrations.
     * @table fw_acceso
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_acceso');
            $table->unsignedInteger('cat_access_name')->nullable()->default(null);
            $table->string('propietario', 64)->nullable()->default(null);
            $table->integer('id_propietario')->nullable()->default(null);
            $table->string('access', 64)->nullable()->default(null);
            $table->integer('id_access')->nullable()->default(null);
            $table->integer('user_alta')->nullable()->default(null);
            $table->integer('user_mod')->nullable()->default(null);
            $table->dateTime('fecha_alta')->nullable()->default(null);
            $table->dateTime('fecha_mod')->nullable()->default(null);

            $table->index(["cat_access_name"], 'fk_fw_acceso_cm_catalogo_1');


            $table->foreign('cat_access_name', 'fk_fw_acceso_cm_catalogo_1')
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
