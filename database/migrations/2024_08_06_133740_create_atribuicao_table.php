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
            $table->id();
            $table->boolean('deletado')->default(false); 
            $table->unsignedBigInteger('fk_professor_fk_user_id');
            $table->unsignedBigInteger('fk_disciplina_id');
            $table->unsignedBigInteger('fk_turma_id');

            $table->foreign('fk_professor_fk_user_id')->references('id')->on('professor'); 
            $table->foreign('fk_disciplina_id')->references('id')->on('disciplina'); 
            $table->foreign('fk_turma_id')->references('id')->on('turma'); 
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
