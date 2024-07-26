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
            $table->unsignedBigInteger('fk_pessoa_id_pessoa');
            $table->unsignedBigInteger('fk_turma_id_turma')->nullable();
            $table->primary('fk_pessoa_id_pessoa');
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
