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
        Schema::create('questao', function (Blueprint $table) {
            $table->id('id');
            $table->string('banca'); 
            $table->string('conteudo');
            $table->string('assunto');
            $table->string('image_path');
            $table->string('alternativa_a'); 
            $table->string('alternativa_b'); 
            $table->string('alternativa_c');
            $table->string('alternativa_d');
            $table->string('alternativa_e');
            $table->boolean('deletado')->default(false);
            $table->string('alternativacorreta'); 
            $table->unsignedBigInteger('fk_disciplina_id');

            // Definindo a chave estrangeira
            $table->foreign('fk_disciplina_id')
                  ->references('id')
                  ->on('disciplina')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questao');
    }
};
