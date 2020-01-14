<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeleteOnCascadeToDetallesPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalles_pedido', function (Blueprint $table) {
            $table->dropForeign('detalles_pedido_producto_id_foreign');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalles_pedido', function (Blueprint $table) {
            $table->foreign('producto_id')->references('id')->on('productos');
        });
    }
}
