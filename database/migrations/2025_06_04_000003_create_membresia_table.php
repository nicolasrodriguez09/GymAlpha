<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('membresia', function (Blueprint $table) {
            $table->id('idMembresia');
            $table->string('nombreMembresia')->unique();     // ej. 'Mensual', 'Anual'
            $table->text('descripcionMembresia')->nullable();
            $table->decimal('precioMembresia', 10, 2);        // valor en moneda
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('membresia');
    }
};
