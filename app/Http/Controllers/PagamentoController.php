<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagamentoRequest;
use App\Http\Requests\UpdatePagamentoRequest;
use App\Models\Pagamento;
use App\Models\Tumulo;
use Exception;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    /**
     * Exibe uma lista dos pagamentos.
     */
    public function index()
    {
        // Busca os pagamentos, ordenados pelos mais recentes
        $pagamentos = Pagamento::latest('data_vencimento')->paginate(15);
                // Também buscamos os túmulos para o caso de o usuário querer alterar o túmulo associado.
        $tumulos = Tumulo::orderBy('codigo')->get();

        // Retorna a view de listagem, passando os dados para ela
        return view('pagamentos.index', compact('pagamentos', 'tumulos'));
    }

    /**
     * Mostra o formulário para criar um novo pagamento.
     */
    public function create()
    {
        // Busca todos os túmulos para popular um <select> no formulário
        $tumulos = Tumulo::orderBy('codigo')->get();

        // Retorna a view do formulário, passando os túmulos
        return view('pagamentos.create', compact('tumulos', 'tumulos'));
    }

    /**
     * Salva um novo pagamento no banco de dados.
     */
    public function store(StorePagamentoRequest $request)
    {
        // Se a execução chegar aqui, a validação passou.
        // Os dados já foram limpos e validados!

        // $request->validated() retorna um array apenas com os dados validados.
        Pagamento::create($request->validated());

        return redirect()->route('pagamentos.index')->with('success', 'Pagamento registrado com sucesso!');
    }

    /**
     * Retorna os dados de um pagamento específico como JSON.
     */
    public function show(Pagamento $pagamento)
    {
        // Retorna o pagamento e, se houver, o tumulo associado
        return response()->json($pagamento->load('tumulo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Mostra o formulário para editar um pagamento existente.
     */
    public function edit(Pagamento $pagamento)
    {
        // Graças ao "Route Model Binding", o Laravel já encontrou o pagamento para nós.

        // Também buscamos os túmulos para o caso de o usuário querer alterar o túmulo associado.
        $tumulos = Tumulo::orderBy('codigo')->get();

        // Retornamos a view do formulário de edição, passando o pagamento e a lista de túmulos.
        return view('pagamentos.edit', compact('pagamento', 'tumulos'));
    }

    /**
     * Atualiza um pagamento existente no banco de dados.
     */
    public function update(UpdatePagamentoRequest $request, Pagamento $pagamento)
    {
        // 1. A validação já foi feita pela UpdatePagamentoRequest.
        //    Pegamos os dados validados.
        $validatedData = $request->validated();

        // 2. Lógica adicional: Se o status não for 'Pago', garantimos que a data de pagamento seja nula.
        if ($validatedData['status'] !== 'Pago') {
            $validatedData['data_pagamento'] = null;
        }

        // 3. Atualiza o registro no banco de dados com os dados validados.
        $pagamento->update($validatedData);

        // 4. Redireciona de volta para a lista com uma mensagem de sucesso.
        return redirect()->route('pagamentos.index')
            ->with('success', 'Pagamento atualizado com sucesso!');
    }

    /**
     * Mostra uma versão para impressão do comprovante de pagamento.
     */
    public function imprimirComprovante(Pagamento $pagamento)
    {
        // Graças ao Route Model Binding, o Laravel já buscou o pagamento para nós.
        // O $with que definimos no Model também já carregou os dados do túmulo.

        // Retornamos uma view específica para o comprovante, passando os dados.
        return view('pagamentos.comprovante', compact('pagamento'));
    }

    public function destroy(Pagamento $pagamento)
    {
        // O try...catch é uma boa prática para capturar qualquer erro inesperado
        // que possa acontecer durante a exclusão no banco de dados.
        try {
            
            // Este é o comando que efetivamente exclui o registro.
            // Se o seu modelo Pagamento usa a trait 'SoftDeletes',
            // este comando vai apenas definir a data em 'deleted_at',
            // movendo o item para a lixeira.
            $pagamento->delete();

            // Retorna uma resposta de sucesso em formato JSON,
            // que o nosso JavaScript vai entender.
            return response()->json([
                'success' => true,
                'message' => 'Pagamento movido para a lixeira com sucesso!'
            ]);

        } catch (Exception $e) {
            
            // Em caso de erro, retorna uma resposta de falha com status 500
            // e uma mensagem de erro para o JavaScript.
            return response()->json([
                'success' => false,
                'message' => 'Ocorreu um erro ao excluir o pagamento.'
            ], 500);
            
            // Para depuração, você pode querer logar o erro real:
            // Log::error($e->getMessage());
        }
    }
}
