<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFwMetodosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'fw_metodos';

    /**
     * Run the migrations.
     * @table fw_metodos
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_metodo');
            $table->unsignedInteger('id_sistema')->nullable()->default(null);
            $table->string('controlador')->nullable()->default(null);
            $table->string('metodo')->nullable()->default(null);
            $table->string('nombre')->nullable()->default(null);
            $table->longText('descripcion')->nullable()->default(null);
            $table->integer('user_alta')->nullable()->default(null);
            $table->integer('user_mod')->nullable()->default(null);
            $table->dateTime('fecha_alta')->nullable()->default(null);
            $table->dateTime('fecha_mod')->nullable()->default(null);

            $table->index(["id_sistema"], 'fk_fw_metodos_sistemas_1');


            $table->foreign('id_sistema', 'fk_fw_metodos_sistemas_1')
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
