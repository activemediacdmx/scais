<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSistemasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'sistemas';

    /**
     * Run the migrations.
     * @table sistemas
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_sistema');
            $table->unsignedInteger('cat_status_sistema')->nullable()->default(null);
            $table->string('nombre', 100)->nullable()->default(null);
            $table->text('nombre_largo')->nullable()->default(null);
            $table->longText('descripcion')->nullable()->default(null);
            $table->string('system_key')->nullable()->default(null);
            $table->integer('user_alta')->nullable()->default(null);
            $table->integer('user_mod')->nullable()->default(null);
            $table->dateTime('fecha_alta')->nullable()->default(null);
            $table->dateTime('fecha_mod')->nullable()->default(null);

            $table->index(["cat_status_sistema"], 'fk_sistemas_cm_catalogo_1');


            $table->foreign('cat_status_sistema', 'fk_sistemas_cm_catalogo_1')
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
