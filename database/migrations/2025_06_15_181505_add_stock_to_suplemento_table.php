<?php
// database/migrations/xxxx_xx_xx_add_stock_to_suplemento_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('suplemento', function (Blueprint $table) {
            $table->integer('stock')->default(0)->after('imagenSuplemento');
        });
    }

    public function down(): void
    {
        Schema::table('suplemento', function (Blueprint $table) {
            $table->dropColumn('stock');
        });
    }
};
