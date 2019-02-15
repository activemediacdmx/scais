<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFwNivelTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'fw_nivel';

    /**
     * Run the migrations.
     * @table fw_nivel
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_nivel');
            $table->unsignedInteger('id_origen')->nullable()->default(null);
            $table->unsignedInteger('cat_level')->nullable()->default(null);
            $table->string('origen')->nullable()->default(null);
            $table->integer('nivel')->nullable()->default(null);
            $table->integer('n0')->nullable()->default(null);
            $table->integer('n1')->nullable()->default(null);
            $table->integer('n2')->nullable()->default(null);
            $table->integer('n3')->nullable()->default(null);
            $table->integer('n4')->nullable()->default(null);
            $table->integer('n5')->nullable()->default(null);
            $table->integer('n6')->nullable()->default(null);
            $table->integer('n7')->nullable()->default(null);
            $table->integer('n8')->nullable()->default(null);
            $table->integer('n9')->nullable()->default(null);
            $table->integer('user_alta')->nullable()->default(null);
            $table->integer('user_mod')->nullable()->default(null);
            $table->dateTime('fecha_alta')->nullable()->default(null);
            $table->dateTime('fecha_mod')->nullable()->default(null);

            $table->index(["cat_level"], 'fk_fw_nivel_cm_catalogo_1');

            $table->index(["id_origen"], 'fk_nivel_area_1');


            $table->foreign('cat_level', 'fk_fw_nivel_cm_catalogo_1')
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
