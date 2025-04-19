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
        Schema::create('agendamento_procedimento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_procedimento')->constrained('procedimento');
            $table->foreignId('id_agendamento')->constrained('agendamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agendamento_procedimento', function(Blueprint $table) {
            $table->dropForeign('agendamento_procedimento_id_procedimento_foreign');
            $table->dropForeign('agendamento_procedimento_id_agendamento_foreign');
        });

        Schema::dropIfExists('agendamento_procedimento');
    }
};
