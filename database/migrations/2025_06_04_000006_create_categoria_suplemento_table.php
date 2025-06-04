<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categoria_suplemento', function (Blueprint $table) {
            $table->id('idCategoria');
            $table->string('nombreCategoria')->unique();     // ej. 'Proteínas', 'Vitaminas'
            $table->string('descripcionCategoria')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categoria_suplemento');
    }
};
