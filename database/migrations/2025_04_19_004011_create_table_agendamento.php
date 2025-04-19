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
        Schema::create('agendamento', function (Blueprint $table) {
            $table->id();
            $table->date('data_consulta');
            $table->string('relatotio_consulta')->nullable();
            $table->foreignId('paciente_id')->nullable()->constrained();
            $table->foreignId('procedimento_id')->nullable()->constrained('procedimento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agendamento', function (Blueprint $table) {
            $table->dropForeign('agendamento_paciente_id_foreign');
            $table->dropForeign('agendamento_procedimento_id_foreign');
        });

        Schema::dropIfExists('agendamento');
    }
};
