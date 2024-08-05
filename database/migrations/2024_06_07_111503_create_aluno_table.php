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
        Schema::create('aluno', function (Blueprint $table) {
            $table->string('matricula', 10)->unique();
            $table->foreignId('fk_pessoa_id_pessoa')->constrained('pessoa')->onDelete('cascade')->primary();
            $table->foreignId('fk_turma_id_turma')->nullable()->constrained('turma')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aluno');
    }
};
