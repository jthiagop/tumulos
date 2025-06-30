<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Altere para true para permitir a validação
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tumulo_id' => 'required|exists:tumulos,id',
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0.01', // Exige que seja um número e maior que zero
            'data_vencimento' => 'required|date',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'tumulo_id.required' => 'O campo túmulo é obrigatório.',
            'tumulo_id.exists' => 'O túmulo selecionado não existe.',
            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.max' => 'A descrição não pode ter mais que 255 caracteres.',
            'valor.required' => 'O campo valor é obrigatório.',
            'valor.numeric' => 'O valor deve ser um número.',
            'valor.min' => 'O valor não pode ser negativo.',
            'data_vencimento.required' => 'O campo data de vencimento é obrigatório.',
            'data_vencimento.date' => 'A data de vencimento deve ser uma data válida.',
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