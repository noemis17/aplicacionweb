<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoPromocionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_promociones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idPromociones');
            $table->bigInteger('idProducto');
            $table->string('fecha_inicio');
            $table->string('fecha_fin');
            $table->string('precio');
            $table->string('estado_del')->default("1");
            $table->string('nome_token');
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
        Schema::dropIfExists('producto_promociones');
    }
}
