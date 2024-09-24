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
        Schema::create('professor_disciplinas', function (Blueprint $table) {
            $table->id('id'); 
            $table->unsignedBigInteger('fk_professor_users_id'); 
            $table->unsignedBigInteger('fk_disciplina_id'); 
            $table->timestamps();

            $table->foreign('fk_professor_users_id')
                  ->references('fk_professor_users_id')
                  ->on('professor')
                  ->onDelete('cascade'); 
            
            $table->foreign('fk_disciplina_id')
                  ->references('id')
                  ->on('disciplina')
                  ->onDelete('cascade'); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('professor_disciplinas');
    }
};
