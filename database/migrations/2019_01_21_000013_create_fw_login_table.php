<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFwLoginTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'fw_login';

    /**
     * Run the migrations.
     * @table fw_login
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_login');
            $table->unsignedInteger('id_usuario')->nullable()->default(null);
            $table->string('session_id', 32)->nullable()->default(null);
            $table->integer('open')->nullable()->default(null);
            $table->dateTime('fecha_login')->nullable()->default(null);
            $table->dateTime('ultima_verificacion')->nullable()->default(null);
            $table->dateTime('fecha_logout')->nullable()->default(null);
            $table->string('tiempo_session', 20)->nullable()->default(null);
            $table->string('ipv4', 15)->nullable()->default(null);
            $table->string('ipv6', 42)->nullable()->default(null);
            $table->integer('user_alta')->nullable()->default(null);
            $table->integer('user_mod')->nullable()->default(null);
            $table->dateTime('fecha_alta')->nullable()->default(null);
            $table->dateTime('fecha_mod')->nullable()->default(null);

            $table->index(["id_usuario"], 'fk_fw_login_fw_usuarios_1');


            $table->foreign('id_usuario', 'fk_fw_login_fw_usuarios_1')
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
