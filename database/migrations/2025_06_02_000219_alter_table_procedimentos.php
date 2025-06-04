<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('procedimento', function(Blueprint $table) {
            $table->string('raio-x')->nullable()->after('orientacoes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('procedimento', function(Blueprint $table) {
            $table->dropColumn('raio-x');
        });
    }
};
