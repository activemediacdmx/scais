<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFwLoginLogTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'fw_login_log';

    /**
     * Run the migrations.
     * @table fw_login_log
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_login_log');
            $table->unsignedInteger('id_usuario')->nullable()->default(null);
            $table->string('ip', 15)->nullable()->default(null);
            $table->dateTime('fecha')->nullable()->default(null);
            $table->string('intentos', 3)->nullable()->default(null);

            $table->index(["id_usuario"], 'fk_login_log_usuarios_1');


            $table->foreign('id_usuario', 'fk_login_log_usuarios_1')
                ->references('id_usuario')->on('fw_usuarios')
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
