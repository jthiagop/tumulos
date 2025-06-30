<?php

namespace App\Http\Controllers;

use App\Models\Tumulo;
use Illuminate\Http\Request;

class LixeiraController extends Controller
{
    /**
     * Exibe os itens deletados (na lixeira)
     */
    public function index()
    {
        $tumulos = Tumulo::onlyTrashed()->get();
        return view('lixeira.index', compact('tumulos'));
    }

    /**
     * Restaura um item da lixeira
     */
    public function restore($id)
    {
        $tumulo = Tumulo::onlyTrashed()->findOrFail($id);
        $tumulo->restore();
        
        return redirect()->route('lixeira.index')
            ->with('success', 'Túmulo restaurado com sucesso!');
    }

    /**
     * Remove permanentemente um item
     */
    public function forceDelete($id)
    {
        $tumulo = Tumulo::onlyTrashed()->findOrFail($id);
        $tumulo->forceDelete();
        
        return redirect()->route('lixeira.index')
            ->with('success', 'Túmulo removido permanentemente!');
    }
}