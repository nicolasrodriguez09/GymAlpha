<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->id('idInventario');
            $table->integer('cantEntrada')->default(0);
            $table->integer('cantSalida')->default(0);
            $table->foreignId('idSuplemento')
                  ->constrained('suplemento', 'idSuplemento')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventario');
    }
};
