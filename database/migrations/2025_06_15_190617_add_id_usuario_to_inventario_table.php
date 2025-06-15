<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 1) Si la columna no existe, la agregamos
        if (! Schema::hasColumn('inventario', 'idUsuario')) {
            Schema::table('inventario', function (Blueprint $table) {
                $table->unsignedBigInteger('idUsuario')
                      ->nullable()
                      ->after('idInventario');
            });
        }

        // 2) Ahora creamos la clave foránea (si aún no existe)
        //    MySQL dará error si intentas duplicar la FK, así que en un entorno limpio
        //    esto solo la crea la primera vez.
        Schema::table('inventario', function (Blueprint $table) {
            $table->foreign('idUsuario')
                  ->references('idUsuario')   // PK real de tu tabla `user`
                  ->on('user')                // nombre exacto de tu tabla de usuarios
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('inventario', function (Blueprint $table) {
            // soltamos la FK y la columna
            $table->dropForeign(['idUsuario']);
            $table->dropColumn('idUsuario');
        });
    }
};
