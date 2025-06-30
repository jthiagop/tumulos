<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePessoaFalecidaRequest;
use App\Http\Requests\UpdatePessoaFalecidaRequest;
use App\Models\PessoaFalecida;
use App\Models\Sepultamento;
use App\Models\Tumulo;
use DragonCode\Support\Facades\Helpers\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PessoaFalecidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Busca todos os registros de sepultamento.
        // 2. O método `with([...])` diz ao Laravel: "Ao buscar os sepultamentos,
        //    já traga junto os dados da 'pessoaFalecida' e do 'tumulo' relacionados a cada um".
        //    Isso é extremamente performático!
        // 3. `latest('data_sepultamento')` ordena pelos sepultamentos mais recentes.
        $sepultamentos = Sepultamento::with(['pessoaFalecida', 'tumulo'])
            ->latest('data_sepultamento')
            ->get();
        // 4. Retorna a view, passando a coleção de sepultamentos para ela.
        return view('falecidos.index', compact('sepultamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tumulos = Tumulo::all();

        return view('falecidos.create', compact('tumulos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePessoaFalecidaRequest $request)
    {
        // Inicia a transação. Se algo der errado aqui dentro, tudo é revertido.
        $pessoaFalecida = DB::transaction(function () use ($request) {
            // 1. Pega todos os dados já validados pela Form Request
            $validatedData = $request->validated();
            // 2. Prepara os dados específicos para a tabela 'pessoas_falecidas'
            // Usamos Arr::except para remover os campos que não pertencem a esta tabela.
            $pessoaData = Arr::except($validatedData, ['tumulo_id', 'data_sepultamento', 'observacoes']);


            // Gera o código único
            $pessoaData['codigo'] = 'PF-' . Str::upper(Str::random(8));
            // Processa as tags
            if (isset($pessoaData['tags']) && is_string($pessoaData['tags'])) {
                $decoded = json_decode($pessoaData['tags'], true);

                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $pessoaData['tags'] = $decoded;
                } else {
                    $pessoaData['tags'] = []; // fallback seguro
                }
            }


            // Faz o upload da foto, se existir
            if ($request->hasFile('foto_path')) {
                $path = $request->file('foto_path')->store('fotos_falecidos', 'public');
                $pessoaData['foto_path'] = $path;
            }

            // 3. Cria o registro da Pessoa Falecida
            $novaPessoaFalecida = PessoaFalecida::create($pessoaData);


            // 4. Cria o registro do Sepultamento na tabela pivô
            Sepultamento::create([
                'pessoa_falecida_id' => $novaPessoaFalecida->id, // Usa o ID da pessoa que acabamos de criar
                'tumulo_id'          => $validatedData['tumulo_id'],
                'data_sepultamento'  => $validatedData['data_sepultamento'],
                'observacoes'        => $validatedData['observacoes'] ?? null,
            ]);

            // 5. ATUALIZA O STATUS DO TÚMULO para 'Ocupado'
            $tumulo = Tumulo::find($validatedData['tumulo_id']);
            if ($tumulo) {
                $tumulo->status = 'Ocupado';
                $tumulo->save();
            }

            // Retorna a pessoa criada para fora da transação
            return $novaPessoaFalecida;
        });

        return redirect()->route('falecidos.index')
            ->with('success', 'Pessoa falecida registrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Carrega com eager loading para evitar N+1 queries
        $falecido = PessoaFalecida::with(['tumulo.quadra', 'sepultamento'])
            ->findOrFail($id);

        return view('falecidos.show', [
            'falecido' => $falecido,
            'tumulo' => $falecido->tumulo // Pode ser null se não houver relação
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PessoaFalecida $falecido)
    {
        // Carrega o relacionamento com sepultamento e túmulo
        $falecido->load('sepultamento.tumulo');

        $tumulos = Tumulo::all();

        return view('falecidos.edit', [
            'falecido' => $falecido,
            'tumulos' => $tumulos
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePessoaFalecidaRequest $request, PessoaFalecida $falecido)
    {

        $validatedData = $request->validated();

        // Upload de nova foto se fornecida
        if ($request->hasFile('foto_path')) {
            // Remove a foto antiga se existir
            if ($falecido->foto_path) {
                Storage::disk('public')->delete($falecido->foto_path);
            }

            $path = $request->file('foto_path')->store('fotos_falecidos', 'public');
            $validatedData['foto_path'] = $path;
        }

        $falecido->update($validatedData);

        return redirect()->route('falecidos.show', $falecido)
            ->with('success', 'Cadastro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PessoaFalecida $pessoaFalecida)
    {
        //
    }
}
