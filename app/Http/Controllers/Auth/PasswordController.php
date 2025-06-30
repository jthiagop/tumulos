<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(UpdatePasswordRequest $request): RedirectResponse
    {
        try {
            // CORREÇÃO: Usamos o método validated() para obter os dados que passaram na validação.
            // A validação, incluindo a verificação da senha atual, já aconteceu automaticamente.
            $validated = $request->validated();

            // Atualiza a senha do usuário com o novo hash.
            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);

            return back()->with('success', 'Senha atualizada com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocorreu um erro ao atualizar a senha: ' . $e->getMessage());
        }
    }
}
