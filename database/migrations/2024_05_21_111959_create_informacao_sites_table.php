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
        Schema::create('informacao_sites', function (Blueprint $table) {
            $table->string('imagem');
            $table->date('inicio_inscricao');
            $table->date('fim_inscricao');
            $table->string('info_geral');
            $table->string('endereco');
            $table->string('horario');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('informacao_sites');
    }
};
