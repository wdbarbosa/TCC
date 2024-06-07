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
        Schema::create('atribuicao', function (Blueprint $table) {
            $table->increments('id_atribuicao');
            $table->date('dataatribuicao')->nullable();
            $table->boolean('deletado')->default(false);
            $table->foreignId('fk_professor_fk_pessoa_id_pessoa')->constrained('professor');
            $table->foreignId('fk_disciplina_id_disciplina')->constrained('disciplina');
            $table->foreignId('fk_turma_id_turma')->constrained('turma');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atribuicao');
    }
};
