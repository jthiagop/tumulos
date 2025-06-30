<?php

namespace App\Models;

use App\Enums\PagamentoStatus; // Importe o Enum
use App\Http\Requests\StorePagamentoRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tumulo_id',
        'descricao',
        'valor',
        'data_vencimento',
        'data_pagamento',
        'status',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'valor' => 'decimal:2', // Garante que o valor seja tratado como decimal
        'data_vencimento' => 'date',
        'data_pagamento' => 'date',
        'status' => PagamentoStatus::class, // Usa nosso Enum para o status!
    ];

    /**
     * Carrega o túmulo relacionado por padrão para otimizar as consultas.
     */
    protected $with = ['tumulo'];

    /**
     * Define o relacionamento: Um Pagamento PERTENCE A um Tumulo.
     */
    public function tumulo(): BelongsTo
    {
        return $this->belongsTo(Tumulo::class);
    }

        /**
     * Mutator para o atributo 'valor'.
     *
     * Este método é chamado automaticamente quando tentamos definir o valor do atributo 'valor'.
     * Ex: $pagamento->valor = "R$ 1.234,56";
     *
     * @param string $value
     * @return void
     */
    public function setValorAttribute(string $value): void
    {
        // Reutilizamos a mesma lógica de formatação do nosso FormRequest
        // para garantir consistência e evitar repetição de código.
        $this->attributes['valor'] = StorePagamentoRequest::formatCurrencyForDatabase($value);
    }
}