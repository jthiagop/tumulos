<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\PessoaFalecida;
use App\Models\Tumulo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalFalecidos' => PessoaFalecida::count(),
            'totalTumulosOcupados' => Tumulo::where('status', 'Ocupado')->count(),
            'pagamentosMensais' => Pagamento::whereMonth('data_pagamento', now()->month)->sum('valor'),
            'percentualOcupacao' => $this->calcularPercentualOcupacao(),
            'pagamentosUltimosMeses' => $this->getPagamentosUltimosMeses(6),
            'distribuicaoDescricoes' => $this->getDistribuicaoPorDescricao(),
            'statusPagamentos' => $this->getStatusPagamentos(),
            'pagamentosVencidos' => $this->getPagamentosVencidos(),
            'pagamentosPorTumulo' => $this->getPagamentosPorTumulo(),
            'pagamentoMesAnterior' => $this->getPagamentoMesAnterior(),
            'evolucaoOcupacao' => $this->getEvolucaoOcupacao(6),
        ];

        return view('dashboard', $stats);
    }

    // Métodos auxiliares atualizados
    protected function getPagamentosUltimosMeses($meses)
    {
        $pagamentos = [];
        $labels = [];

        for ($i = $meses - 1; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $total = Pagamento::whereYear('data_pagamento', $date->year)
                ->whereMonth('data_pagamento', $date->month)
                ->sum('valor');

            $pagamentos[] = $total;
            $labels[] = $date->translatedFormat('M/Y');
        }

        return [
            'labels' => $labels,
            'data' => $pagamentos
        ];
    }

    protected function getDistribuicaoPorDescricao()
    {
        return Pagamento::select('descricao')
            ->selectRaw('SUM(valor) as total')
            ->groupBy('descricao')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
    }

    protected function getStatusPagamentos()
    {
        return Pagamento::select('status')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('status')
            ->get()
            ->toArray();
    }

    protected function getPagamentosVencidos()
    {
        return [
            'vencidos' => Pagamento::where('status', '!=', 'Pago')
                ->where('data_vencimento', '<', now())
                ->count(),
            'a_vencer' => Pagamento::where('status', '!=', 'Pago')
                ->where('data_vencimento', '>=', now())
                ->count(),
            'total_pago' => Pagamento::where('status', 'Pago')->count()
        ];
    }

    protected function getPagamentosPorTumulo()
    {
        return Pagamento::with('tumulo')
            ->select('tumulo_id')
            ->selectRaw('SUM(valor) as total')
            ->groupBy('tumulo_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'tumulo' => $item->tumulo->codigo ?? 'N/A',
                    'total' => $item->total
                ];
            });
    }

    protected function getPagamentoMesAnterior()
    {
        $lastMonth = now()->subMonth();
        return Pagamento::whereYear('data_pagamento', $lastMonth->year)
            ->whereMonth('data_pagamento', $lastMonth->month)
            ->sum('valor');
    }

    protected function getEvolucaoOcupacao($meses)
    {
        $dados = [];
        $labels = [];

        for ($i = $meses - 1; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $endDate = $date->endOfMonth();
            
            $ocupados = Tumulo::where('status', 'Ocupado')
                ->count();
                
            $total = Tumulo::count();
            
            $dados[] = $total > 0 ? round(($ocupados / $total) * 100) : 0;
            $labels[] = $date->translatedFormat('M/Y');
        }

        return [
            'labels' => $labels,
            'data' => $dados
        ];
    }

    protected function calcularPercentualOcupacao()
    {
        $totalOcupados = Tumulo::where('status', 'Ocupado')->count();
        $totalTumulos = Tumulo::count();
        return $totalTumulos > 0 ? round(($totalOcupados / $totalTumulos) * 100) : 0;
    }
}