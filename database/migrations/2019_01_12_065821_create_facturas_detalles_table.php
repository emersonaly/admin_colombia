<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas_detalles', function (Blueprint $table) {
            $table->increments('id')->comment('Ide Clave de la tabla facturas_detalles');
            $table->unsignedInteger('user_id')->comment('Ide Clave de la tabla usuario');
            $table->unsignedInteger('facturas_id')->comment('Ide de la tabla facturas');
            $table->unsignedInteger('productos_id')->comment('Ide de la tabla productos');
            $table->double('cantidad', 8, 2)->comment('Cantida del producto');
            $table->double('precio', 8, 2)->comment('Precio del produto');
            $table->string('impuesto', 2)->comment('Impuesto del produto');
            $table->double('descuento', 8, 2)->comment('Descuento del produto');
            $table->double('total_sin_impuesto', 8, 2)->comment('Resultado de la operación');
            $table->double('total_impuestos', 8, 2)->comment('Resultado de la operación');
            $table->double('total_pagar', 8, 2)->comment('Resultado de la operación');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('facturas_id')->references('id')->on('facturas');
            $table->foreign('productos_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facturas_detalles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['facturas_id']);
            $table->dropForeign(['productos_id']);
        });
        Schema::dropIfExists('facturas_detalles');
    }
}
