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
            $table->increments('id_resumo');
            $table->string('titulo')->nullable();
            $table->string('conteudo')->nullable();
            $table->string('arquivo')->nullable();
            $table->boolean('deletado')->default(false);
            $table->date('datapublicado')->nullable();
            $table->date('dataeditado')->nullable();
            $table->foreignId('fk_aluno_fk_pessoa_id_pessoa')->constrained('aluno')->onDelete('restrict');
            $table->foreignId('fk_disciplina_id_disciplina')->constrained('disciplina')->onDelete('restrict');
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
