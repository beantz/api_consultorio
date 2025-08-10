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
            $table->dropColumn('medicamente_pre');
            $table->dropColumn('medicamente_pos');

            $table->string('medicamento_pre');
            $table->string('medicamento_pos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('procedimento', function(Blueprint $table) {
            $table->dropColumn('medicamento_pre');
            $table->dropColumn('medicamento_pos');

            $table->string('medicamente_pre');
            $table->string('medicamente_pos');
        });
    }
};
