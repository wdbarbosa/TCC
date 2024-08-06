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
            $table->increments('id');
            $table->string('nomecomunicado')->nullable();
            $table->string('comunicado')->nullable();
            $table->date('datacomunicado')->nullable();
            $table->foreignId('fk_user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('fk_turma_id')->constrained('turma')->onDelete('restrict');
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
