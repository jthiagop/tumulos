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
        Schema::create('tumulos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 100)->unique()->comment('Código único para identificação rápida');
            $table->string('rua', 100)->nullable();
            $table->string('quadra', 50);
            $table->string('numero', 20);
            $table->string('tipo')->comment('Ex: Jazigo, Gaveta, Cova Simples');
            $table->string('status')->default('Disponível')->comment('Ex: Disponível, Ocupado, Reservado');
            $table->string('local')->comment('Santa Rita, São José ou Basílica da Penha');
            $table->text('localizacao_detalhada')->nullable();
            $table->json('tags')->nullable()->comment('Tags para categorização em formato JSON');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tumulos');
    }
};
