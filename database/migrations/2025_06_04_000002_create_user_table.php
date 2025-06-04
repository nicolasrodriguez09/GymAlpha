<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('idUsuario');
            $table->string('nombreUsu');
            $table->string('apellidoUsu');
            $table->string('emailUsu')->unique();
            $table->string('telefonoUsu')->nullable();
            $table->foreignId('idTipoDoc')
                  ->constrained('tipo_documento', 'idTipoDoc')
                  ->onDelete('cascade');
            $table->string('numero_identificacion')->unique();
            $table->foreignId('idRol')
                  ->constrained('rol', 'idRol')
                  ->onDelete('cascade')
                  ->default(1); // asume que 1 = 'cliente'
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
    }
};
