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
            $table->increments('id_material');
            $table->date('datamaterial')->nullable();
            $table->boolean('deletado')->default(false);
            $table->string('conteudo')->nullable();
            $table->string('titulo')->nullable();
            $table->foreignId('fk_disciplina_id_disciplina')->constrained('disciplina')->onDelete('restrict');
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
