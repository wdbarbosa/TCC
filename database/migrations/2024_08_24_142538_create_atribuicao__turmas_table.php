<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('atribuicao_turma', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('fk_atribuicao_id');
            $table->unsignedBigInteger('fk_turma_id');
            $table->timestamps();
            
            $table->foreign('fk_atribuicao_id')
                  ->references('id')
                  ->on('atribuicao')
                  ->onDelete('cascade');
            
            $table->foreign('fk_turma_id')
                  ->references('id')
                  ->on('turma')
                  ->onDelete('restrict');
            

            $table->unique(['fk_atribuicao_id', 'fk_turma_id']);
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('atribuicao_turma');
    }
};
