<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('suplemento_proveedor', function (Blueprint $table) {
            $table->id('idSuplementoProveedor');
            $table->foreignId('idSuplemento')
                  ->constrained('suplemento', 'idSuplemento')
                  ->onDelete('cascade');
            $table->foreignId('idProveedor')
                  ->constrained('proveedor', 'idProveedor')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('suplemento_proveedor');
    }
};
