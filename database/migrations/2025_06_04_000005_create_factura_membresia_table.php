<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('factura_membresia', function (Blueprint $table) {
            $table->id('idFacturaMembresia');
            $table->dateTime('fechaCompra')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignId('idUsuario')
                  ->constrained('user', 'idUsuario')
                  ->onDelete('cascade');
            $table->foreignId('idMembresia')
                  ->constrained('membresia', 'idMembresia')
                  ->onDelete('cascade');
            $table->foreignId('idFormaPago')
                  ->constrained('forma_pago', 'idFormaPago')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('factura_membresia');
    }
};
