<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListImpuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_impuestos', function (Blueprint $table) {
            $table->increments('id')->index()->comment('Ide del Impuesto');
            $table->unsignedInteger('user_id')->comment('Ide Clave de la tabla usuario');
            $table->string('descripcion',100)->index()->comment('Descripcion de Impuesto');
            $table->string('status',2)->comment('0 activa, 1 inactiva status de Impuesto');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('list_impuestos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('list_impuestos');
    }
}
