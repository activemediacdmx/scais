<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFwAuditoriaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'fw_auditoria';

    /**
     * Run the migrations.
     * @table fw_auditoria
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_auditoria');
            $table->unsignedInteger('id_metodo')->nullable()->default(null);
            $table->string('permiso', 64)->nullable()->default(null);
            $table->string('controlador')->nullable()->default(null);
            $table->string('metodo')->nullable()->default(null);
            $table->text('post')->nullable()->default(null);
            $table->text('headers')->nullable()->default(null);
            $table->text('server')->nullable()->default(null);
            $table->string('ip', 16)->nullable()->default(null);
            $table->text('session')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->string('path')->nullable()->default(null);
            $table->string('method')->nullable()->default(null);
            $table->string('token_session', 64)->nullable()->default(null);
            $table->unsignedInteger('user_alta')->nullable()->default(null);
            $table->dateTime('fecha_alta')->nullable()->default(null);

            $table->index(["id_metodo"], 'fk_fw_auditoria_fw_metodos_1');

            $table->index(["user_alta"], 'fk_fw_auditoria_fw_usuarios_1');


            $table->foreign('id_metodo', 'fk_fw_auditoria_fw_metodos_1')
                ->references('id_metodo')->on('fw_metodos')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('user_alta', 'fk_fw_auditoria_fw_usuarios_1')
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
