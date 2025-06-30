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
        Schema::create('pessoa_falecidas', function (Blueprint $table) {
            // --- Colunas de Identificação ---
            $table->id();
            $table->string('codigo', 100)->unique()->comment('Código único de identificação da pessoa');
            $table->string('nome_completo');
            $table->string('foto_path')->nullable()->comment('Caminho para a foto do falecido');
            $table->string('cpf', 14)->nullable()->unique()->comment('CPF do falecido');

            // --- Colunas de Datas ---
            $table->date('data_nascimento')->nullable();
            $table->date('data_falecimento')->nullable();
            $table->date('data_sepultamento')->nullable();

            // --- Colunas de Informações Adicionais ---
            $table->string('status_social')->nullable()->comment('Ex: Solteiro(a), Casado(a), etc.');
            $table->string('causa_morte')->nullable();
            $table->text('descricao')->nullable()->comment('Uma breve biografia ou descrição');
            $table->json('tags')->nullable()->comment('Tags para busca e categorização em formato JSON');

            // --- Colunas do Responsável ---
            $table->string('nome_responsavel')->nullable();
            $table->string('telefone_responsavel')->nullable();
            $table->string('email')->nullable()->unique()->comment('Email de contato do responsável ou do falecido');

            // --- Timestamps ---
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoa_falecidas');
    }
};
