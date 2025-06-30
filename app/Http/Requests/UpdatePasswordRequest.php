<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer essa requisição.
     */
    public function authorize(): bool
    {
        return true; // Permitir que qualquer usuário autenticado faça a requisição
    }

    /**
     * Regras de validação para a atualização de senha.
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required', 'current_password'], // Verifica se a senha atual está correta
            'password' => [
                'required',
                Password::defaults(), // Senha forte (pode personalizar)
                'confirmed', // Exige um campo `password_confirmation`
            ],
        ];
    }

    /**
     * Mensagens personalizadas de erro (opcional).
     */
    public function messages(): array
    {
        return [
            'current_password.required' => 'A senha atual é obrigatória.',
            'current_password.current_password' => 'A senha atual está incorreta.',
            'password.required' => 'A nova senha é obrigatória.',
            'password.confirmed' => 'A confirmação da senha não coincide.',
        ];
    }
}