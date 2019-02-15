<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFwLostPasswordTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'fw_lost_password';

    /**
     * Run the migrations.
     * @table fw_lost_password
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_lost');
            $table->string('token', 64)->nullable()->default(null);
            $table->unsignedInteger('id_usuario')->nullable()->default(null);
            $table->string('correo', 64)->nullable()->default(null);
            $table->unsignedInteger('cat_status')->nullable()->default(null);
            $table->integer('user_alta')->nullable()->default(null);
            $table->integer('user_mod')->nullable()->default(null);
            $table->dateTime('fecha_alta')->nullable()->default(null);
            $table->dateTime('fecha_mod')->nullable()->default(null);

            $table->index(["cat_status"], 'fk_lost_password_ae_catalogo_1');

            $table->index(["id_usuario"], 'fk_lost_password_usuarios_1');


            $table->foreign('cat_status', 'fk_lost_password_ae_catalogo_1')
                ->references('id_cat')->on('cm_catalogo')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('id_usuario', 'fk_lost_password_usuarios_1')
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
