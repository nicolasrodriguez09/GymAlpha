<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('factura_suplemento', function (Blueprint $table) {
            $table->id('idFacturaSuplemento');
            $table->dateTime('fechaCompra')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignId('idUsuario')
                  ->constrained('user', 'idUsuario')
                  ->onDelete('cascade');
            $table->foreignId('idInventario')
                  ->constrained('inventario', 'idInventario')
                  ->onDelete('cascade');
            $table->foreignId('idFormaPago')
                  ->constrained('forma_pago', 'idFormaPago')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('factura_suplemento');
    }
};
