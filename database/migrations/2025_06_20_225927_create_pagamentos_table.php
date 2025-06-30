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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();

            // Chave estrangeira para a tabela de túmulos
            $table->foreignId('tumulo_id')->constrained('tumulos');

            $table->string('descricao');
            $table->decimal('valor', 10, 2); // 10 dígitos no total, 2 casas decimais
            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable(); // Pode ser nulo até o pagamento ser efetuado
            $table->string('status')->default('Pendente')->comment('Ex: Pendente, Pago, Atrasado');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
