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
        Schema::table('agendamento', function(Blueprint $table) {
            $table->dropForeign('agendamento_paciente_id_foreign');
            $table->dropColumn('paciente_id');

            $table->foreignId('user_patients_id')->nullable()->constrained('users');
        });

        Schema::table('users', function(Blueprint $table) {
            $table->integer('years')->nullable()->after('email');
            $table->string('phone', 20)->nullable()->after('years');
            $table->string('allergies')->nullable()->after('phone');
            $table->string('medicines_used')->nullable()->after('allergies');
        });

        Schema::dropIfExists('Pacientes');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('idade')->nullable();
            $table->string('contato', 20);
            $table->string('alergias')->nullable();
            $table->string('medicamentos_usados')->nullable();
            $table->timestamps();
        });

        Schema::table('agendamento', function(Blueprint $table) {
            $table->dropForeign('user_patients_id');
            $table->dropColumn('user_patients_id');

            $table->foreignId('pacientes_id')->nullable()->constrained('pacientes');
        });

        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('years');
            $table->dropColumn('phone');
            $table->dropColumn('allergies');
            $table->dropColumn('medicines_used');
        });

    }
};
