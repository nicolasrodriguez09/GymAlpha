<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('forma_pago', function (Blueprint $table) {
            $table->id('idFormaPago');
            $table->string('nombreBanco')->nullable();    // ej. 'BBVA', 'Bancolombia'
            $table->string('nombreTitular')->nullable();
            $table->string('numeroCuenta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('forma_pago');
    }
};
