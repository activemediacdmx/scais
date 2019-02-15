<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmCatalogoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'cm_catalogo';

    /**
     * Run the migrations.
     * @table cm_catalogo
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_cat');
            $table->unsignedInteger('id_padre')->nullable()->default(null);
            $table->string('catalogo', 100)->nullable()->default(null);
            $table->string('etiqueta', 200)->nullable()->default(null);
            $table->string('activo', 5)->nullable()->default(null);
            $table->integer('orden')->nullable()->default(null);
            $table->string('valor')->nullable()->default(null);
            $table->integer('user_alta')->nullable()->default(null);
            $table->integer('user_mod')->nullable()->default(null);
            $table->dateTime('fecha_alta')->nullable()->default(null);
            $table->dateTime('fecha_mod')->nullable()->default(null);

            $table->index(["id_padre"], 'fk_cm_catalogo_cm_catalogo_1');


            $table->foreign('id_padre', 'fk_cm_catalogo_cm_catalogo_1')
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
