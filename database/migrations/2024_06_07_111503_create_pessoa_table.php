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
        Schema::create('pessoa', function (Blueprint $table) {
            $table->increments('id_pessoa');
            $table->string('cpf', 11)->unique();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('senha');
            $table->date('datanascimento');
            $table->string('telefone', 15)->nullable();
            $table->boolean('deletado')->default(false);
            $table->boolean('adm_')->default(false);
            $table->foreignId('fk_pessoa_id_pessoa')->nullable()->constrained('pessoa');
            $table->foreignId('fk_nivel_acesso_id_nivel')->constrained('nivel_acesso')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoa');
    }
};
