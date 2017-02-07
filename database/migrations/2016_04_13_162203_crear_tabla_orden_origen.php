<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaOrdenOrigen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_origen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ordenid');
            $table->string('tip_iden',1);
            $table->string('identificacion');
            $table->string('cliente');
            
            $table->string('telefono');
            $table->string('mail');
            $table->integer('sucursalid');
            
            $table->float('subtotal');
            $table->float('impuesto');
            $table->float('total');
            
            $table->string('ciudad');
            $table->string('pais');
            $table->string('direccion');
            $table->string('estadopedido');
            $table->integer('asignado');
            $table->string('cuentaid');
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
        Schema::drop('orden_origen');
    }
}
