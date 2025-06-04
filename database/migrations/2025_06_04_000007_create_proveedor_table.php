<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->id('idProveedor');
            $table->string('nomProveedor');
            $table->string('telefonoProveedor')->nullable();
            $table->string('emailProveedor')->nullable();
            $table->string('NITProveedor')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proveedor');
    }
};
