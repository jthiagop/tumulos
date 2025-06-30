<?php

namespace App\Http\Requests;

use App\Enums\PagamentoStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePagamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Permite que usuários logados atualizem
    }
            /**
     * Prepara os dados para validação.
     *
     * Este método é executado ANTES das regras de validação serem aplicadas.
     * É o lugar perfeito para limpar/transformar os dados do formulário.
     */
    protected function prepareForValidation(): void
    {
        // Pega o valor do campo 'valor' (ex: "R$ 1.234,56")
        $valor = $this->input('valor');

        // Se o valor não estiver vazio, limpa a formatação
        if ($valor) {
            $this->merge([
                'valor' => static::formatCurrencyForDatabase($valor),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'tumulo_id' => 'required|exists:tumulos,id',
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data_vencimento' => 'required|date',
            // A regra Rule::enum() garante que o status enviado seja um dos valores válidos do nosso Enum.
            'status' => ['required', Rule::enum(PagamentoStatus::class)],
            // A data de pagamento só é obrigatória se o status for 'Pago'.
            'data_pagamento' => 'nullable|required_if:status,Pago|date',
        ];
    }

    public function messages(): array
    {
        return [
            // Mensagens gerais
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser um texto.',
            'numeric' => 'O campo :attribute deve ser um valor numérico.',
            'date' => 'O campo :attribute deve ser uma data válida.',
            'max' => 'O campo :attribute não pode ter mais que :max caracteres.',
            'min' => 'O campo :attribute deve ser no mínimo :min.',

            // Mensagens específicas por campo
            'tumulo_id.required' => 'É necessário selecionar um túmulo.',
            'tumulo_id.exists' => 'O túmulo selecionado não existe em nossos registros.',

            'descricao.required' => 'Por favor, informe uma descrição para o pagamento.',
            'descricao.max' => 'A descrição não pode ultrapassar 255 caracteres.',

            'valor.required' => 'O valor do pagamento é obrigatório.',
            'valor.numeric' => 'O valor deve ser um número válido.',
            'valor.min' => 'O valor não pode ser negativo.',

            'data_vencimento.required' => 'A data de vencimento é obrigatória.',
            'data_vencimento.date' => 'Informe uma data de vencimento válida.',

            'status.required' => 'O status do pagamento é obrigatório.',
            'status.enum' => 'O status selecionado é inválido.',

            'data_pagamento.required_if' => 'A data de pagamento é obrigatória quando o status é "Pago".',
            'data_pagamento.date' => 'Informe uma data de pagamento válida.',
        ];
    }

    public function attributes(): array
    {
        return [
            'tumulo_id' => 'Túmulo',
            'descricao' => 'Descrição',
            'valor' => 'Valor',
            'data_vencimento' => 'Data de Vencimento',
            'status' => 'Status',
            'data_pagamento' => 'Data do Pagamento',
        ];
    }
    /**
 * Função INTELIGENTE para converter a string de moeda para um formato de banco de dados.
 * Agora ela verifica se o valor já está em formato numérico antes de tentar limpá-lo.
 *
 * @param string|float|int|null $value
 * @return string|null
 */
public static function formatCurrencyForDatabase($value): ?string
{
    // Se o valor for nulo ou vazio, retorna nulo.
    if (empty($value)) {
        return null;
    }

    // Se o valor já for numérico (ex: 1234.56), retorna-o sem modificação.
    // Isso EVITA a dupla formatação e corrige o bug.
    if (is_numeric($value)) {
        return (string) $value;
    }

    // Se não for numérico, assume que é uma string mascarada (ex: "R$ 1.234,56") e a limpa.
    $value = str_replace(['R$ ', '.'], '', $value);
    $value = str_replace(',', '.', $value);

    return $value;
}
}
