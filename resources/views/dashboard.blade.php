@push('breadcrumbs')
    <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>
    <li class="breadcrumb-item text-white fw-bold lh-1">Dashboards</li>
@endpush

@section('page_title')
    Bem-vindo, {{ Auth::user()->name }}
@endsection

@section('page_subtitle')
    Sistema de Gestão Memorial - Proneb do Nordeste
@endsection
{{-- @section('toolbar_actions')
    <a href="#" class="btn btn-flex btn-sm btn-outline btn-active-color-primary btn-custom px-4" data-bs-toggle="modal"
        data-bs-target="#kt_modal_invite_friends">
        <i class="ki-outline ki-plus-square fs-4 me-2"></i>Invite</a>
    <a href="#" class="btn btn-sm btn-active-color-primary btn-outline btn-custom ms-3 px-4" data-bs-toggle="modal"
        data-bs-target="#kt_modal_new_target">Set Your Target</a>
@endsection --}}

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<x-app-layout>
    <!--begin::Wrapper container-->
    <div class="app-container container-xxl">
        <!--begin::Main-->
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <!--begin::Content wrapper-->
            <div class="d-flex flex-column flex-column-fluid">
                <!--begin::Content-->
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-8">
                        <!-- Card 1: Total de Falecidos -->
                        <div class="col-xl-4">
                            <div class="card bg-light-success card-xl-stretch mb-xl-8">
                                <div class="card-body my-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-users text-success fs-2x me-3"></i>
                                        <div class="card-title fw-bold text-success fs-2 mb-0">Total de Falecidos</div>
                                    </div>
                                    <div class="py-1">
                                        <span class="text-gray-900 fs-1 fw-bold me-2">{{ $totalFalecidos }}</span>
                                        <span class="fw-semibold text-muted fs-7">Registrados</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Túmulos Ocupados -->
                        <div class="col-xl-4">
                            <div class="card bg-light-warning card-xl-stretch mb-xl-8">
                                <div class="card-body my-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-cross text-warning fs-2x me-3"></i>
                                        <div class="card-title fw-bold text-warning fs-2 mb-0">Túmulos Ocupados</div>
                                    </div>
                                    <div class="py-1">
                                        <span class="text-gray-900 fs-1 fw-bold me-2">{{ $totalTumulosOcupados }}</span>
                                        <span class="fw-semibold text-muted fs-7">Total</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Pagamentos Mensais -->
                        <div class="col-xl-4">
                            <div class="card bg-light-primary card-xl-stretch mb-5 mb-xl-8">
                                <div class="card-body my-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-sack-dollar text-primary fs-2x me-3"></i>
                                        <div class="card-title fw-bold text-primary fs-2 mb-0">Pagamento Mensal</div>
                                    </div>
                                    <div class="py-1">
                                        <span class="text-gray-900 fs-1 fw-bold me-2">R$
                                            {{ number_format($pagamentosMensais, 2, ',', '.') }}</span>
                                        <span class="fw-semibold text-muted fs-7">Este mês</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Row-->
<!--begin::Row-->
<div class="row g-5 g-xl-8">
    <!--begin::Col-->
    <div class="col-xl-4">
        <!--begin::Misc Widget 1-->
        <div class="row mb-5 mb-xl-8 g-5 g-xl-8">
            <!-- Túmulos -->
            <div class="col-6">
                <a class="card flex-column justify-content-start align-items-start text-start w-100 text-gray-800 text-hover-primary p-10"
                    href="{{ route('tumulos.index') }}">
                    <i class="fa-solid fa-church fs-2tx mb-5 ms-n1"></i>
                    <span class="fs-4 fw-bold">Túmulos</span>
                    <span class="fs-1 fw-bold mt-2">{{ $totalTumulosOcupados }}</span>
                    <span class="text-gray-500">Ocupados</span>
                </a>
            </div>
            
            <!-- Falecidos -->
            <div class="col-6">
                <a class="card flex-column justify-content-start align-items-start text-start w-100 text-gray-800 text-hover-primary p-10"
                    href="{{ route('falecidos.index') }}">
                    <i class="ki-outline ki-profile-user fs-2tx mb-5 ms-n1 text-gray-500"></i>
                    <span class="fs-4 fw-bold">Falecidos</span>
                    <span class="fs-1 fw-bold mt-2">{{ $totalFalecidos }}</span>
                    <span class="text-gray-500">Cadastrados</span>
                </a>
            </div>
            
            <!-- Ocupação -->
            <div class="col-6">
                <div class="card flex-column justify-content-start align-items-start text-start w-100 text-gray-800 p-10">
                    <i class="fa-solid fa-percent fs-2tx mb-2 ms-n1"></i>
                    <span class="fs-4 fw-bold">Ocupação</span>
                    <div class="d-flex align-items-center mt-2">
                        <span class="fs-1 fw-bold">{{ $percentualOcupacao }}%</span>
                        @if($percentualOcupacao > 70)
                            <span class="badge badge-light-danger fs-6 ms-2">Alta</span>
                        @elseif($percentualOcupacao > 40)
                            <span class="badge badge-light-warning fs-6 ms-2">Média</span>
                        @else
                            <span class="badge badge-light-success fs-6 ms-2">Baixa</span>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Pagamentos -->
            <div class="col-6">
                <a class="card flex-column justify-content-start align-items-start text-start w-100 text-gray-800 text-hover-primary p-8"
                    href="{{ route('pagamentos.index') }}">
                    <i class="fa-solid fa-money-bill-wave fs-2tx mb-2 ms-n1"></i>
                    <span class="fs-4 fw-bold">Pagamentos</span>
                    <span class="fs-1 fw-bold mt-2">R$ {{ number_format($pagamentosMensais, 0, ',', '.') }}</span>
                    <span class="text-gray-500  fs-8 ">Este mês</span>
                </a>
            </div>
        </div>
        <!--end::Misc Widget 1-->
        
        <!--begin::Evolução Ocupação-->
        <div class="card card-flush mb-5 mb-xl-8">
            <div class="card-header py-5">
                <h3 class="card-title fw-bold text-gray-800">Evolução da Ocupação</h3>
            </div>
            <div class="card-body">
                <div id="evolucaoOcupacaoChart" style="height: 250px"></div>
            </div>
        </div>
        <!--end::Evolução Ocupação-->
    </div>
    <!--end::Col-->
    
    <!--begin::Col-->
    <div class="col-xl-8 ps-xl-10">
        <!--begin::Pagamentos Mensais-->
        <div class="card card-flush mb-5 mb-xl-8">
            <div class="card-header py-5">
                <h3 class="card-title fw-bold text-gray-800">Pagamentos Mensais</h3>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-light d-flex align-items-center px-4">
                        {{ now()->translatedFormat('F Y') }}
                    </div>
                </div>
            </div>
            <div class="card-body d-flex justify-content-between flex-column pb-0 px-0 pt-1">
                <div class="d-flex flex-wrap d-grid gap-5 px-9 mb-5">
                    <div>
                        <div class="d-flex mb-2">
                            <span class="fs-4 fw-semibold text-gray-500 me-1">R$</span>
                            <span class="fs-2hx fw-bold text-gray-800 me-2">
                                {{ number_format($pagamentoMesAnterior, 0, ',', '.') }}
                            </span>
                        </div>
                        <span class="fs-6 fw-semibold text-gray-500">Mês Anterior</span>
                    </div>

                    <div class="border-start-dashed border-end-dashed border-start border-end border-gray-300 px-5 ps-md-10 pe-md-7">
                        <div class="d-flex mb-2">
                            <span class="fs-4 fw-semibold text-gray-500 me-1">R$</span>
                            <span class="fs-2hx fw-bold text-gray-800 me-2">
                                {{ number_format($pagamentosMensais, 0, ',', '.') }}
                            </span>
                        </div>
                        <span class="fs-6 fw-semibold text-gray-500">Mês Atual</span>
                    </div>

                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="fs-4 fw-semibold text-gray-500 me-1">R$</span>
                            <span class="fs-2hx fw-bold text-gray-800 me-2">
                                @php
                                    $diferenca = $pagamentosMensais - $pagamentoMesAnterior;
                                    $percentual = $pagamentoMesAnterior != 0 ? ($diferenca / $pagamentoMesAnterior) * 100 : 0;
                                @endphp
                                {{ number_format($diferenca, 0, ',', '.') }}
                            </span>
                            <span class="badge badge-light-{{ $diferenca >= 0 ? 'success' : 'danger' }} fs-base">
                                <i class="ki-outline ki-arrow-{{ $diferenca >= 0 ? 'up' : 'down' }} fs-7 text-{{ $diferenca >= 0 ? 'success' : 'danger' }} ms-n1"></i>
                                {{ number_format(abs($percentual), 1) }}%
                            </span>
                        </div>
                        <span class="fs-6 fw-semibold text-gray-500">Variação</span>
                    </div>
                </div>
                <div id="pagamentosMensaisChart" class="min-h-auto ps-4 pe-6" style="height: 300px"></div>
            </div>
        </div>
        <!--end::Pagamentos Mensais-->
        
        <!--begin::Row-->
        <div class="row g-5 g-xl-8">
            <!-- Distribuição por Descrição -->
            <div class="col-xl-6">
                <div class="card card-flush h-md-100">
                    <div class="card-header py-5">
                        <h3 class="card-title fw-bold text-gray-800">Distribuição por Descrição</h3>
                    </div>
                    <div class="card-body">
                        <div id="distribuicaoDescricaoChart" style="height: 300px"></div>
                    </div>
                </div>
            </div>
            
            <!-- Status de Pagamentos -->
            <div class="col-xl-6">
                <div class="card card-flush h-md-100">
                    <div class="card-header py-5">
                        <h3 class="card-title fw-bold text-gray-800">Status de Pagamentos</h3>
                    </div>
                    <div class="card-body">
                        <div id="statusPagamentosChart" style="height: 300px"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->

<!--begin::Scripts-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        renderPagamentosMensaisChart();
        renderDistribuicaoDescricaoChart();
        renderStatusPagamentosChart();
        renderEvolucaoOcupacaoChart();
    });

    function renderPagamentosMensaisChart() {
        const element = document.getElementById("pagamentosMensaisChart");
        if (!element) return;

        const options = {
            series: [{
                name: 'Pagamentos',
                data: @json($pagamentosUltimosMeses['data'])
            }],
            chart: {
                type: 'line',
                height: 300,
                toolbar: { show: false }
            },
            stroke: { curve: 'smooth', width: 3 },
            xaxis: {
                categories: @json($pagamentosUltimosMeses['labels']),
                labels: { style: { colors: '#A1A5B7', fontSize: '12px' } },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                labels: {
                    style: { colors: '#A1A5B7', fontSize: '12px' },
                    formatter: value => 'R$ ' + value.toLocaleString('pt-BR')
                }
            },
            colors: ['#3E97FF'],
            grid: { strokeDashArray: 4 },
            tooltip: {
                y: { formatter: value => 'R$ ' + value.toLocaleString('pt-BR') }
            }
        };

        new ApexCharts(element, options).render();
    }

    function renderDistribuicaoDescricaoChart() {
        const element = document.getElementById("distribuicaoDescricaoChart");
        if (!element) return;

        const data = @json($distribuicaoDescricoes);
        const series = data.map(item => item.total);
        const labels = data.map(item => item.descricao);

        const options = {
            series: series,
            labels: labels,
            chart: { type: 'donut', height: 300 },
            colors: ['#F1416C', '#7239EA', '#50CD89', '#E4E6EF', '#3E97FF'],
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                formatter: w => 'R$ ' + w.globals.seriesTotals.reduce((a, b) => a + b, 0).toLocaleString('pt-BR')
                            }
                        }
                    }
                }
            },
            legend: { position: 'bottom' },
            tooltip: {
                y: { formatter: val => 'R$ ' + val.toLocaleString('pt-BR') }
            }
        };

        new ApexCharts(element, options).render();
    }

    function renderStatusPagamentosChart() {
        const element = document.getElementById("statusPagamentosChart");
        if (!element) return;

        const statusData = @json($statusPagamentos);
        const labels = Object.keys(statusData);
        const series = Object.values(statusData);

        const options = {
            series: series,
            labels: labels,
            chart: { type: 'pie', height: 300 },
            colors: ['#50CD89', '#F1416C', '#3E97FF'],
            legend: { position: 'bottom' },
            responsive: [{
                breakpoint: 480,
                options: { chart: { width: 200 } }
            }]
        };

        new ApexCharts(element, options).render();
    }

    function renderEvolucaoOcupacaoChart() {
        const element = document.getElementById("evolucaoOcupacaoChart");
        if (!element) return;

        const options = {
            series: [{
                name: 'Ocupação',
                data: @json($evolucaoOcupacao['data'])
            }],
            chart: {
                type: 'bar',
                height: 250,
                toolbar: { show: false }
            },
            plotOptions: {
                bar: { borderRadius: 4, horizontal: false }
            },
            dataLabels: { enabled: false },
            xaxis: {
                categories: @json($evolucaoOcupacao['labels']),
                labels: { style: { colors: '#A1A5B7', fontSize: '10px' } }
            },
            yaxis: {
                max: 100,
                labels: {
                    style: { colors: '#A1A5B7', fontSize: '10px' },
                    formatter: value => value + '%'
                }
            },
            colors: ['#7239EA'],
            grid: { strokeDashArray: 4 }
        };

        new ApexCharts(element, options).render();
    }
</script>
<!--end::Scripts-->
                    <!--end::Row-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Content wrapper-->
            <!--begin::Footer-->
            @include('layouts.footer')
            <!--end::Footer-->
        </div>
        <!--end:::Main-->
    </div>
    <!--end::Wrapper container-->
</x-app-layout>
