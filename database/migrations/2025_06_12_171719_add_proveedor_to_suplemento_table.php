<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('suplemento', function (Blueprint $table) {
            
            $table->unsignedBigInteger('idProveedor')->after('idCategoria');

            
            $table->foreign('idProveedor')
                  ->references('idProveedor')
                  ->on('proveedor')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('suplemento', function (Blueprint $table) {
            
            $table->dropForeign(['idProveedor']);
            
            $table->dropColumn('idProveedor');
        });
    }
};
