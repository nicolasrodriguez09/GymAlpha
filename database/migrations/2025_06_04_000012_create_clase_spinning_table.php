<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clase_spinning', function (Blueprint $table) {
            $table->id('idClaseSpinning');
            $table->string('diaClase');
            $table->time('horaClase');
            $table->integer('cantidadCuposClase')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clase_spinning');
    }
};
