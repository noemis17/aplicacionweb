<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kits', function (Blueprint $table) {
            $table->bigIncrements('id');
           
            $table->unsignedBigInteger('idRegistro');
            $table->unsignedBigInteger('idProducto'); 
            $table->Integer('cantidad');
            $table->string('estado_del')->default("1");
            $table->timestamps();
           //$table->foreign('idRegistro')->references('id')->on('registro_promociones');
           $table->foreign('idProducto')->references('id')->on('productos');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kits');
    }
}
