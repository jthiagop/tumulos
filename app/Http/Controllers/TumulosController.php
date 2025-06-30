<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTumulosRequest;
use App\Http\Requests\UpdateTumulosRequest;
use App\Models\Tumulo;

class TumulosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Busca todos os túmulos do banco, ordenados pelos mais recentes
        // O método paginate() cria a paginação automaticamente
        $tumulos = Tumulo::get();

        // Retorna a view, passando a variável com os túmulos para ela
        return view('tumulos.index', compact('tumulos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tumulos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTumulosRequest $request)
    {
        // Criação do novo túmulo com os dados já validados
        $tumulo = Tumulo::create($request->validated());

        // Redirecionamento com mensagem de sucesso
        return redirect()->back()->with('success', 'Túmulo cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tumulo $tumulos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tumulo $tumulo)
    {
        // Carrega os tipos de túmulo disponíveis (se necessário para selects)
        $tiposTumulo = ['Jazigo', 'Gaveta', 'Cova Simples'];
        $statusOptions = ['Disponível', 'Ocupado', 'Reservado', 'Em Manutenção'];

        return view('tumulos.edit', [
            'tumulo' => $tumulo,
            'tiposTumulo' => $tiposTumulo,
            'statusOptions' => $statusOptions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTumulosRequest $request, Tumulo $tumulo)
    {
        // Atualiza o túmulo com os dados validados
        $tumulo->update($request->validated());

        // Redireciona com mensagem de sucesso
        return redirect()
            ->route('tumulos.index')
            ->with('success', 'Túmulo atualizado com sucesso!');
    }


    /**
     * Remove o recurso especificado do banco de dados.
     *
     * @param  \App\Models\Tumulo  $tumulo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tumulo $tumulo)
    {
        // 1. Verifica se existe algum registro de sepultamento para este túmulo.
        // O método exists() é muito eficiente, pois gera uma consulta SQL otimizada.
        if ($tumulo->sepultamentos()->exists()) {

            // 2. Se existir, impede a exclusão e retorna com uma mensagem de erro.
            return redirect()->route('tumulos.index')
                ->with('error', 'Não é possível excluir este túmulo, pois existem registros de sepultamento associados a ele.');
        }

        // 3. Se o túmulo estiver "vazio", a exclusão é permitida.
        $tumulo->delete();

        return redirect()->route('tumulos.index')
            ->with('success', 'Túmulo excluído com sucesso!');
    }
}
