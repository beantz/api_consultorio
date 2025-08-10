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
        Schema::create('procedimento', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('medicamente_pre')->nullable();
            $table->string('medicamente_pos')->nullable();
            $table->string('orientacoes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedimento');
    }
};
