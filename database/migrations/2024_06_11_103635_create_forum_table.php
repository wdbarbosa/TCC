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
            $table->increments('id_forum');
            $table->date('dataforum')->nullable();
            $table->boolean('deletado')->default(false);
            $table->text('mensagem')->nullable();
            $table->unsignedBigInteger('fk_aluno_fk_pessoa_id_pessoa');
            $table->string('descricao_disciplina')->nullable();
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
