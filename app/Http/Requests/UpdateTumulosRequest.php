<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTumulosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Alterado para true para permitir a atualização
    }

    /**
     * Regras de validação para atualização
     */
    public function rules(): array
    {
        return [
            'quadra' => 'nullable|string|max:255',
            'rua' => 'nullable|string|max:255',
            'numero' => 'nullable|integer|min:1',
            'tipo' => 'nullable|string|in:Cova Simples,Jazigo,Gaveta',
            'localizacao_detalhada' => 'nullable|string|max:500',
            'codigo' => [
                'required',
                'string',
                'max:100',
                Rule::unique('tumulos', 'codigo')->ignore($this->tumulo)
            ],
            'status' => 'required|string|in:Disponível,Ocupado,Reservado,Em Manutenção',
            'tags' => 'nullable|string',
        ];
    }

    /**
     * Mensagens de validação personalizadas
     */
    public function messages(): array
    {
        return [
            // Regras genéricas
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser um texto.',
            'integer' => 'O campo :attribute deve ser um número inteiro.',
            'min' => 'O campo :attribute deve ser no mínimo :min.',
            'max' => 'O campo :attribute não pode ter mais que :max caracteres.',
            'in' => 'O valor selecionado para :attribute é inválido.',
            'unique' => 'Este :attribute já está em uso.',

            // Mensagens específicas por campo
            'quadra.max' => 'A quadra não pode ter mais que 255 caracteres.',

            'rua.max' => 'A rua não pode ter mais que 255 caracteres.',

            'numero.integer' => 'O número deve ser um valor inteiro.',
            'numero.min' => 'O número deve ser pelo menos 1.',

            'tipo.in' => 'O tipo deve ser Cova Simples, Jazigo ou Gaveta.',

            'localizacao_detalhada.max' => 'A localização detalhada não pode ter mais que 500 caracteres.',

            'codigo.required' => 'O código do túmulo é obrigatório.',
            'codigo.max' => 'O código não pode ter mais que 100 caracteres.',
            'codigo.unique' => 'Este código de túmulo já está em uso.',

            'status.required' => 'O status do túmulo é obrigatório.',
            'status.in' => 'O status deve ser: Disponível, Ocupado, Reservado ou Em Manutenção.',
        ];
    }

    /**
     * Atributos personalizados para as mensagens
     */
    public function attributes(): array
    {
        return [
            'quadra' => 'quadra',
            'rua' => 'rua',
            'numero' => 'número',
            'tipo' => 'tipo de túmulo',
            'localizacao_detalhada' => 'localização detalhada',
            'codigo' => 'código',
            'status' => 'status',
            'tags' => 'tags'
        ];
    }
}
