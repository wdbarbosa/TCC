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
            $table->increments('id_questao');
            $table->string('banca')->nullable();
            $table->string('alternativa_a')->nullable();
            $table->string('alternativa_b')->nullable();
            $table->string('alternativa_c')->nullable();
            $table->string('alternativa_d')->nullable();
            $table->string('alternativa_e')->nullable();
            $table->boolean('deletado')->default(false);
            $table->string('alternativacorreta')->nullable();
            $table->foreignId('fk_disciplina_id_disciplina')->constrained('disciplina')->onDelete('restrict');
            $table->timestamps();
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
