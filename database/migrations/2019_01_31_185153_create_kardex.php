<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKardex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardex', function (Blueprint $table) {
            $table->increments('id')->comment('Ide Clave de la tabla kardex');
            $table->unsignedInteger('user_id')->comment('Ide Clave de la tabla usuario');
            $table->unsignedInteger('producto_id')->comment('FK Ide de Productos');
            $table->unsignedInteger('empresa_id')->comment('FK Ide de empresa');
            /*$table->unsignedInteger('bodega_id')->comment('FK Ide de Bodega para en caso de traslado');
*/            $table->bigInteger('factura')->unsigned()->comment('Numero de factura ya sea de Venta o de Compra');
            $table->string('tipo',2)->comment('1=modulo Compra, 2=modulo Venta, 3=Devolucion de Compra, 4=Devolucion de Venta, 5=modulo de productos 0=Insercion de productos');
            $table->double('existen_anter', 16, 2)->comment('Existencia anterior');
            $table->double('cantidad', 16, 2)->comment('Cantidad de Compra o de Venta');
            $table->double('existen_post', 16, 2)->comment('Existencia Posterior');
            $table->decimal('precio_momento', 11, 2)->comment('Precio de venta al momento del movimiento');
            $table->integer('impuesto')->unsigned()->comment('Impuesto al momento de venta');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('empresa_id')->references('id')->on('list_empresa');
            /*$table->foreign('bodega_id')->references('id')->on('bodega');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kardex', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['producto_id']);
            $table->dropForeign(['empresa_id']);
           }); 
    
        Schema::dropIfExists('kardex');
    }
}
