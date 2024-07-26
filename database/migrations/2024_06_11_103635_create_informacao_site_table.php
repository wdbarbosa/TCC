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
        Schema::create('informacao_site', function (Blueprint $table) {
            $table->id();
            $table->string('imagem')->nullable();
            $table->date('inicioinscricao')->nullable();
            $table->text('infogeral')->nullable();
            $table->date('fiminscricao')->nullable();
            $table->string('horario')->nullable();
            $table->string('endereco')->nullable();
            $table->timestamps();          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informacao_site');
    }
};
