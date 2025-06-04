<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reserva', function (Blueprint $table) {
            $table->id('idReserva');
            $table->dateTime('fechaReserva')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignId('idClaseSpinning')
                  ->constrained('clase_spinning', 'idClaseSpinning')
                  ->onDelete('cascade');
            $table->foreignId('idUsuario')
                  ->constrained('user', 'idUsuario')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reserva');
    }
};
