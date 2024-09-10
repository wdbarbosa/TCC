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
        Schema::create('material_didatico', function (Blueprint $table) {
            $table->id('id'); 
            $table->boolean('deletado');
            $table->string('conteudo');
            $table->string('titulo');
            $table->unsignedBigInteger('fk_disciplina_id');
            $table->string('slide');
            $table->string('pdf');
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
        Schema::dropIfExists('material_didatico');
    }
};
