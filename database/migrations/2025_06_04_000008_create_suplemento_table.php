<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('suplemento', function (Blueprint $table) {
            $table->id('idSuplemento');
            $table->string('nombreSuplemento');
            $table->text('descripcionSuplemento')->nullable();
            $table->string('marcaSuplemento')->nullable();
            $table->decimal('precioSuplemento', 10, 2)->default(0);
            $table->foreignId('idCategoria')
                  ->constrained('categoria_suplemento', 'idCategoria')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('suplemento');
    }
};
