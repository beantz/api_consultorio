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
        Schema::create('exame', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('exame_procedimento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_procedimento')->constrained('procedimento');
            $table->foreignId('id_exame')->constrained('exame');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('senha', 'password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('exame');
        Schema::dropIfExists('exame_procedimento');
        Schema::enableForeignKeyConstraints();
    }
};
