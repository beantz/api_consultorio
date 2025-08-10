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
        Schema::table('users', function(Blueprint $table) {
            $table->renameColumn('user_type', 'tipo_usuario');
            $table->renameColumn('name', 'nome');
            $table->renameColumn('years', 'idade');
            $table->renameColumn('phone', 'telefone');
            $table->renameColumn('allergies', 'alergias');
            $table->renameColumn('medicines_used', 'usando_medicamentos');
            $table->renameColumn('password', 'senha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table) {
            $table->renameColumn('tipo_usuario', 'user_type');
            $table->renameColumn('nome', 'name');
            $table->renameColumn('idade', 'years');
            $table->renameColumn('telefone', 'phone');
            $table->renameColumn('alergias', 'allergies');
            $table->renameColumn('usando_medicamentos', 'medicines_used');
            $table->renameColumn('senha', 'password');
        });
    }
};
