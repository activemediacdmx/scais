<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFwConfigTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'fw_config';

    /**
     * Run the migrations.
     * @table fw_config
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_config');
            $table->unsignedInteger('id_site')->nullable()->default(null);
            $table->unsignedInteger('cat_config')->nullable()->default(null);
            $table->string('descripcion', 64)->nullable()->default(null);
            $table->string('valor', 16)->nullable()->default(null);
            $table->string('tmp_val', 16)->nullable()->default(null);
            $table->longText('data')->nullable()->default(null);
            $table->integer('user_alta')->nullable()->default(null);
            $table->integer('user_mod')->nullable()->default(null);
            $table->dateTime('fecha_alta')->nullable()->default(null);
            $table->dateTime('fecha_mod')->nullable()->default(null);

            $table->index(["cat_config"], 'fk_fw_config_cm_catalogo_1');


            $table->foreign('cat_config', 'fk_fw_config_cm_catalogo_1')
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
