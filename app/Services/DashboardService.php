<?php 

namespace App\Services;

use App\Models\Pagamento;
use App\Models\PessoaFalecida;
use App\Models\Tumulo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getDashboardStats(): array
    {
        return [
            'totalFalecidos' => PessoaFalecida::count(),
            'totalTumulosOcupados' => Tumulo::where('status', 'Ocupado')->count(),
            'pagamentosMensais' => Pagamento::whereMonth('created_at', now()->month)->sum('valor'),
            'percentualOcupacao' => $this->calcularPercentualOcupacao(),
        ];
    }

    public function getPagamentosUltimosMeses(int $meses, ?string $startDate = null, ?string $endDate = null): array
    {
        $query = Pagamento::query()
            ->select(DB::raw("SUM(valor) as total, DATE_FORMAT(created_at, '%Y-%m') as mes"))
            ->groupBy('mes')
            ->orderBy('mes', 'asc');

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [Carbon::parse($startDate), Carbon::parse($endDate)]);
        } else {
            $query->where('created_at', '>=', Carbon::now()->subMonths($meses));
        }

        $pagamentos = $query->get();

        // Formata para o formato que o ApexCharts espera
        return [
            'labels' => $pagamentos->pluck('mes'),
            'data' => $pagamentos->pluck('total'),
        ];
    }

    public function getDistribuicaoPorDescricao(): array
    {
        return Pagamento::query()
            ->select('descricao', DB::raw('SUM(valor) as total'))
            ->groupBy('descricao')
            ->get()
            ->toArray();
    }
    
    // ... outros métodos de cálculo
    
    protected function calcularPercentualOcupacao(): float
    {
        $totalTumulos = Tumulo::count();
        if ($totalTumulos === 0) {
            return 0;
        }
        $ocupados = Tumulo::where('status', 'Ocupado')->count();
        return round(($ocupados / $totalTumulos) * 100, 2);
    }
}