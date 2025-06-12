<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('suplemento', function (Blueprint $table) {
            // String para la ruta o nombre de archivo; nullable por si inicialmente no hay imagen
            $table->string('imagenSuplemento')->nullable()
                  ->after('marcaSuplemento');
        });
    }

    public function down(): void
    {
        Schema::table('suplemento', function (Blueprint $table) {
            $table->dropColumn('imagenSuplemento');
        });
    }
};
