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
        Schema::create('forum', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('deletado')->default(false);
            $table->string('mensagem')->nullable();
        
            $table->unsignedBigInteger('fk_aluno_users_id');
            $table->foreign('fk_aluno_users_id')
                  ->references('fk_aluno_users_id') 
                  ->on('aluno')
                  ->onDelete('restrict');
        
            $table->unsignedBigInteger('fk_professor_users_id');
            $table->foreign('fk_professor_users_id')
                  ->references('fk_professor_users_id') 
                  ->on('professor')
                  ->onDelete('restrict');
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum');
    }
};
