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
            $table->string('banca', 255)->nullable();
            $table->string('alternativa_a', 255)->nullable();
            $table->string('alternativa_b', 255)->nullable();
            $table->string('alternativa_c', 255)->nullable();
            $table->string('alternativa_d', 255)->nullable();
            $table->string('alternativa_e', 255)->nullable();
            $table->boolean('deletado')->default(false);
            $table->string('alternativacorreta', 255)->nullable();
            $table->unsignedBigInteger('fk_disciplina_id_disciplina');
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
