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
    Schema::create('sepultamentos', function (Blueprint $table) {
        $table->id();

        // Chave estrangeira para a tabela de túmulos
        $table->foreignId('tumulo_id')->constrained('tumulos');

        // Chave estrangeira para a tabela de pessoas falecidas
        $table->foreignId('pessoa_falecida_id')->constrained('pessoa_falecidas');

        $table->dateTime('data_sepultamento');
        $table->text('observacoes')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sepultamentos');
    }
};
