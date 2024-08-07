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
            $table->unsignedBigInteger('fk_aluno_users_id');
            $table->unsignedBigInteger('fk_turma_id')->nullable();
            $table->primary('fk_aluno_users_id');
            $table->foreign('fk_aluno_users_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('aluno');
    }
};
