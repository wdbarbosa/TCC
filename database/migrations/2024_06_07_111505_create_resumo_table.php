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
        Schema::create('resumo', function (Blueprint $table) {
            $table->id('id'); 
            $table->string('titulo'); 
            $table->text('conteudo'); 
            $table->string('arquivo'); 
            $table->boolean('deletado'); 
            $table->date('datapublicado');
            $table->date('dataeditado'); 
            $table->unsignedBigInteger('fk_aluno_users_id');
            $table->unsignedBigInteger('fk_disciplina_id');

            // Definindo as chaves estrangeiras
            $table->foreign('fk_aluno_users_id')
                  ->references('fk_aluno_users_id')
                  ->on('aluno')
                  ->onDelete('cascade');
            
            $table->foreign('fk_disciplina_id')
                  ->references('id')
                  ->on('disciplina')
                  ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumo');
    }
};
