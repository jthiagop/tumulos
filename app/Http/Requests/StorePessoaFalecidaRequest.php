<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePessoaFalecidaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome_completo'      => 'nullable|string|max:255',
            'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cpf'                => 'nullable|string|max:14|unique:pessoa_falecidas,cpf',
            'data_nascimento'    => 'nullable|date',
            'status_social'      => 'nullable|string|max:50',
            'data_falecimento'   => 'nullable|date',
            'causa_morte'        => 'nullable|string|max:255',
            'descricao'          => 'nullable|string',
            'endereco_responsavel'=> 'nullable|string',
            'tags'               => 'nullable|string',
            'nome_responsavel'   => 'nullable|string|max:255',
            'telefone_responsavel' => 'nullable|string|max:20',
            'email'              => 'nullable|email|max:255|unique:pessoa_falecidas,email',

            // REGRAS PARA O SEPULTAMENTO (NOVAS)
            'tumulo_id'          => 'required|integer|exists:tumulos,id', // Garante que o ID do túmulo existe na tabela 'tumulos'
            'data_sepultamento'  => 'nullable|date',
            'observacoes'        => 'nullable|string', // Observações do sepultamento

        ];
    }

    public function messages(): array
    {
        return [
            // Nome Completo
            'nome_completo.required' => 'O campo nome completo é obrigatório.',
            'nome_completo.max'      => 'O nome não pode ter mais que 255 caracteres.',

            // Foto
            'foto.image'             => 'O arquivo deve ser uma imagem válida.',
            'foto.mimes'             => 'Apenas imagens JPG, JPEG e PNG são permitidas.',
            'foto.max'              => 'A imagem não pode ter mais que 2MB.',

            // CPF
            'cpf.max'               => 'O CPF deve ter no máximo 14 caracteres.',
            'cpf.unique'            => 'Este CPF já está cadastrado em nosso sistema.',

            // Datas
            'data_nascimento.date'  => 'Informe uma data de nascimento válida.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_falecimento.required' => 'A data de falecimento é obrigatória.',
            'data_falecimento.date' => 'Informe uma data de falecimento válida.',

            // Status Social
            'status_social.max'     => 'O status social não pode ter mais que 50 caracteres.',

            // Causa da Morte
            'causa_morte.max'      => 'A causa da morte não pode ter mais que 255 caracteres.',

            // Responsável
            'nome_responsavel.max'  => 'O nome do responsável não pode ter mais que 255 caracteres.',
            'telefone_responsavel.max' => 'O telefone não pode ter mais que 20 caracteres.',

            // E-mail
            'email.email'           => 'Informe um endereço de e-mail válido.',
            'email.max'            => 'O e-mail não pode ter mais que 255 caracteres.',
            'email.unique'         => 'Este e-mail já está cadastrado em nosso sistema.',

            // ATRIBUTOS PARA O SEPULTAMENTO (NOVOS)
            'tumulo_id'          => 'A escolha do Túmulo é obrigatória',
            'data_sepultamento'  => 'Data do Sepultamento',
            'observacoes'        => 'Observações',
        ];
    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        // Este método traduz os nomes dos campos para as mensagens de erro.
        return [
            'nome_completo'      => 'Nome Completo',
            'foto'               => 'Foto',
            'cpf'                => 'CPF',
            'data_nascimento'    => 'Data de Nascimento',
            'status_social'      => 'Status Social',
            'data_falecimento'   => 'Data de Falecimento',
            'causa_morte'        => 'Causa da Morte',
            'descricao'          => 'Descrição',
            'tags'               => 'Tags',
            'nome_responsavel'   => 'Nome do Responsável',
            'telefone_responsavel' => 'Telefone do Responsável',
            'email'              => 'Email',
        ];
    }
}
