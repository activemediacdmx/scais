<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFwAreaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'fw_area';

    /**
     * Run the migrations.
     * @table fw_area
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_area');
            $table->unsignedInteger('id_ubicacion')->nullable()->default(null);
            $table->unsignedInteger('cat_status')->nullable()->default(null);
            $table->string('area_area', 100)->nullable()->default(null);
            $table->integer('user_alta')->nullable()->default(null);
            $table->integer('user_mod')->nullable()->default(null);
            $table->dateTime('fecha_alta')->nullable()->default(null);
            $table->dateTime('fecha_mod')->nullable()->default(null);

            $table->index(["id_ubicacion"], 'fk_area_ubicacion_1');

            $table->index(["cat_status"], 'fk_area_ae_catalogo_1');


            $table->foreign('cat_status', 'fk_area_ae_catalogo_1')
                ->references('id_cat')->on('cm_catalogo')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('id_ubicacion', 'fk_area_ubicacion_1')
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
