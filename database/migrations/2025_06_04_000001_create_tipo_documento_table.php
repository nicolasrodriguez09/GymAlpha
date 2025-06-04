<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tipo_documento', function (Blueprint $table) {
            $table->id('idTipoDoc');
            $table->string('nombreTipoDoc')->unique();    // ej. 'C.C.', 'T.I.', 'Pasaporte'
            $table->string('descripcionTipoDoc')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_documento');
    }
};
