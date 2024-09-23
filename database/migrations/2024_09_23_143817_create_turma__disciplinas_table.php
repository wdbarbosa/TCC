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
        Schema::create('turma_disciplinas', function (Blueprint $table) {
            $table->id('id'); 
            $table->unsignedBigInteger('fk_turma_id'); 
            $table->unsignedBigInteger('fk_disciplina_id'); 
            $table->timestamps();
            
            $table->foreign('fk_turma_id')
                  ->references('id')
                  ->on('turma')
                  ->onDelete('cascade'); 
            
            $table->foreign('fk_disciplina_id')
                  ->references('id')
                  ->on('disciplina')
                  ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turma_disciplinas');
    }
};
