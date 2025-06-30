"use strict";

// Classe para gerenciar os gráficos do dashboard
class DashboardCharts {
    constructor() {
        // Inicializa o daterangepicker e os gráficos
        this.initDaterangepicker();
        this.initPagamentosMensaisChart();
        // this.initDistribuicaoDescricaoChart(); // Descomente quando adicionar o segundo gráfico
    }

    // Função genérica para buscar dados via Fetch API
    async fetchData(url) {
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error("Falha ao buscar dados do gráfico:", error);
            return null;
        }
    }

    // Inicializa o gráfico de pagamentos mensais
    initPagamentosMensaisChart() {
        const element = document.getElementById("kt_pagamentos_mensais_chart");
        if (!element) return;

        // Opções padrão do gráfico de linha
        const options = this.getLineChartOptions();
        const chart = new ApexCharts(element, options);
        chart.render();

        // Armazena a instância do gráfico para atualizações futuras
        element.chart = chart;

        // Carrega os dados iniciais
        this.updateChartData(element, element.dataset.url);
    }

    // Busca novos dados e atualiza o gráfico
    async updateChartData(element, url) {
        const chart = element.chart;
        if (!chart) return;
        
        // Mostra um estado de carregamento
        chart.updateOptions({
            series: [{ data: [] }],
            xaxis: { categories: [] },
            noData: { text: 'Carregando dados...' }
        });

        const data = await this.fetchData(url);
        if (data && data.labels && data.data) {
            chart.updateOptions({
                series: [{ name: 'Pagamentos', data: data.data }],
                xaxis: { categories: data.labels },
                noData: { text: 'Sem dados para exibir.' }
            });
        }
    }

    // Configura o Daterangepicker para filtrar o gráfico
    initDaterangepicker() {
        const pickerElement = $("#kt_dashboard_daterangepicker");
        if (!pickerElement.length) return;

        // Configuração do daterangepicker (baseado na documentação do Keen)
        const start = moment().subtract(29, "days");
        const end = moment();

        function cb(start, end) {
            pickerElement.find(".fw-bold").html(start.format("D MMM, YYYY") + " - " + end.format("D MMM, YYYY"));
        }

        pickerElement.daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                "Hoje": [moment(), moment()],
                "Ontem": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Últimos 7 Dias": [moment().subtract(6, "days"), moment()],
                "Últimos 30 Dias": [moment().subtract(29, "days"), moment()],
                "Este Mês": [moment().startOf("month"), moment().endOf("month")],
                "Mês Passado": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")],
            },
            locale: {
                format: 'DD/MM/YYYY',
                // ... outras traduções para pt-BR
            }
        }, cb);

        cb(start, end);

        // Evento disparado ao aplicar um novo período
        pickerElement.on('apply.daterangepicker', (ev, picker) => {
            const startDate = picker.startDate.format('YYYY-MM-DD');
            const endDate = picker.endDate.format('YYYY-MM-DD');

            const chartElement = document.getElementById("kt_pagamentos_mensais_chart");
            if(chartElement) {
                // Constrói a nova URL com os parâmetros de data e atualiza o gráfico
                const url = new URL(chartElement.dataset.url);
                url.searchParams.set('start_date', startDate);
                url.searchParams.set('end_date', endDate);
                this.updateChartData(chartElement, url.toString());
            }
        });
    }

    // Centraliza as opções do gráfico para reutilização
    getLineChartOptions() {
        // Função para formatar valores como moeda brasileira
        const currencyFormatter = (value) => {
            if (value === null || value === undefined) return 'R$ 0';
            return 'R$ ' + value.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        };
        
        return {
            series: [],
            chart: {
                type: 'area', // Mudei para area para um visual mais moderno
                height: 350,
                toolbar: { show: false },
                zoom: { enabled: false }
            },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            xaxis: {
                categories: [],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { colors: '#A1A5B7', fontSize: '12px' } }
            },
            yaxis: {
                labels: {
                    style: { colors: '#A1A5B7', fontSize: '12px' },
                    formatter: currencyFormatter
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },
            colors: ['#3E97FF'],
            grid: {
                strokeDashArray: 4,
                yaxis: { lines: { show: true } }
            },
            tooltip: {
                y: { formatter: currencyFormatter }
            },
            noData: {
                text: 'Carregando dados...'
            }
        };
    }
}

// Inicializa a classe quando o DOM estiver pronto
document.addEventListener("DOMContentLoaded", () => {
    new DashboardCharts();
});