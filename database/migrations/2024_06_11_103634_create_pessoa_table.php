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
            $table->bigIncrements('id_pessoa');
            $table->string('cpf', 11)->unique();
            $table->string('nome', 255);
            $table->string('email', 255)->unique();
            $table->string('senha', 255);
            $table->date('datanascimento');
            $table->string('telefone', 15)->nullable();
            $table->boolean('deletado')->default(false);
            $table->boolean('adm_')->default(false);
            $table->unsignedBigInteger('fk_pessoa_id_pessoa')->nullable();
            $table->unsignedBigInteger('fk_nivel_acesso_id_nivel');
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
