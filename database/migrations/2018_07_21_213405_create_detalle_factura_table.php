<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_factura', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('factura_id');
            $table->foreign('factura_id')->references('id')->on('facturas');

            $table->unsignedInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->integer('cantidad');
            $table->integer('precio_total_producto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_factura',function (Blueprint $table){
            $table->dropForeign(['factura_id']);
            $table->dropForeign(['producto_id']);
        });
        Schema::dropIfExists('detalle_factura');
    }
}
