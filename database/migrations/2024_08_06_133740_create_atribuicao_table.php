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
            $table->id('id'); 
            $table->boolean('deletado'); 
            $table->unsignedBigInteger('fk_professor_fk_users_id');
            $table->unsignedBigInteger('fk_disciplina_id'); 
            $table->unsignedBigInteger('fk_turma_id');
            
            // Definindo as chaves estrangeiras
            $table->foreign('fk_professor_fk_users_id')
                  ->references('fk_professor_users_id')
                  ->on('professor')
                  ->onDelete('cascade');
            
            $table->foreign('fk_disciplina_id')
                  ->references('id')
                  ->on('disciplina')
                  ->onDelete('restrict');
            
            $table->foreign('fk_turma_id')
                  ->references('id')
                  ->on('turma')
                  ->onDelete('restrict');
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
