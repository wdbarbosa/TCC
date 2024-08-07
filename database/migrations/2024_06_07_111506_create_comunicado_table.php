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
        Schema::create('comunicado', function (Blueprint $table) {
            $table->id('id');
            $table->string('comunicado'); 
            $table->unsignedBigInteger('fk_professor_id');
            $table->unsignedBigInteger('fk_turma_id');

            // Definindo as chaves estrangeiras
            $table->foreign('fk_professor_id')
                  ->references('fk_professor_users_id')
                  ->on('professor')
                  ->onDelete('restrict');

            $table->foreign('fk_turma_id')
                  ->references('id')
                  ->on('turma')
                  ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comunicado');
    }
};
