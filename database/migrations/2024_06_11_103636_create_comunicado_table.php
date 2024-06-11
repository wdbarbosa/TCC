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
            $table->increments('id_comunicado');
            $table->text('comunicado')->nullable();
            $table->date('datacomunicado')->nullable();
            $table->unsignedBigInteger('id_professor');
            $table->unsignedBigInteger('id_turma');
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
