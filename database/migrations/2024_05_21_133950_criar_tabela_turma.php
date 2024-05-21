<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('turma', function(Blueprint $table)
        {
            $table->id();
            $table->string('nome');
            $table->string('descricao');
            $table->timestamps();
        });

    }
    
    public function down(): void
    {
        
    }
};
