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

<x-app-layout>
    <!--begin::Wrapper container-->
    <div class="app-container container-xxl">
        <!--begin::Main-->
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <!--begin::Content wrapper-->
            <div class="d-flex flex-column flex-column-fluid">
                <!--begin::Content-->
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Card-->
                    <div class="card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1 me-5">
                                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                                    <input type="text" data-kt-permissions-table-filter="search"
                                        class="form-control form-control-solid w-250px ps-13"
                                        placeholder="Search Permissions" />
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Button-->
                                <button type="button" id="btn_add_pagamento" class="btn btn-light-primary"
                                    data-bs-toggle="modal" data-bs-target="#kt_modal_pagamento">
                                    <i class="ki-outline ki-plus-square fs-3"></i> Adicionar Pagamento
                                </button>
                                <!--end::Button-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px text-left">Tumulo</th>
                                        <th class="text-center min-w-250px">Descrição</th>
                                        <th class="text-center min-w-125px">Valor</th>
                                        <th class="text-center min-w-125px">Data Vencimento</th>
                                        <th class="text-center min-w-125px">Data Pagamento</th>
                                        <th class="text-center min-w-125px">Status</th>
                                        <th class="text-end min-w-100px ">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @forelse ($pagamentos as $pagamento)
                                        <tr>
                                            <td><span class="fw-bold">{{ $pagamento->tumulo->codigo ?? 'N/A' }}</span>
                                            </td>
                                            <td class="text-left">{{ $pagamento->descricao }}</td>
                                            <td class="text-left">
                                                {{-- Formata o valor para o padrão brasileiro --}}
                                                <span class="fw-bold text-left ">R$
                                                    {{ number_format($pagamento->valor, 2, ',', '.') }}</span>
                                            </td>
                                            <td class="text-center">{{ $pagamento->data_vencimento->format('d/m/Y') }}
                                            </td>
                                            <td class="text-center">
                                                {{ $pagamento->data_pagamento ? $pagamento->data_pagamento->format('d/m/Y') : '-' }}
                                            </td>
                                            <td class="text-center">
                                                {{-- Usa o Enum para exibir o valor e podemos criar um acessor para a cor do badge no futuro --}}
                                                @php
                                                    $statusClass = match ($pagamento->status) {
                                                        \App\Enums\PagamentoStatus::PAGO => 'badge-light-success',
                                                        \App\Enums\PagamentoStatus::PENDENTE => 'badge-light-warning',
                                                        \App\Enums\PagamentoStatus::ATRASADO => 'badge-light-danger',
                                                        \App\Enums\PagamentoStatus::CANCELADO
                                                            => 'badge-light-secondary',
                                                        default => 'badge-light-info',
                                                    };
                                                @endphp
                                                <span
                                                    class="badge {{ $statusClass }}">{{ $pagamento->status->value }}</span>
                                            </td>
                                            <td class="text-end">


                                                @if ($pagamento->status == \App\Enums\PagamentoStatus::PAGO)
                                                    <a href="{{ route('pagamentos.imprimir', $pagamento->id) }}"
                                                        class="btn btn-icon btn-active-light-primary w-30px h-30px me-3">
                                                        <i class="ki-outline ki-printer fs-3"></i>
                                                @endif

                                                {{-- Dentro do seu loop @foreach ($pagamentos as $pagamento) --}}
                                                <a href="#"
                                                    class="btn btn-icon btn-active-light-primary w-30px h-30px me-3 btn-editar-pagamento"
                                                    data-bs-toggle="modal" data-bs-target="#kt_modal_pagamento"
                                                    data-pagamento-id="{{ $pagamento->id }}"
                                                    data-url-update="{{ route('pagamentos.update', $pagamento) }}"
                                                    data-url-show="{{ route('pagamentos.show', $pagamento) }}">
                                                    <i class="ki-outline ki-setting-3 fs-3"></i>
                                                </a>
                                                <button class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                                    data-kt-permissions-table-filter="delete_row"
                                                    data-url-destroy="{{ route('pagamentos.destroy', $pagamento) }}"
                                                    data-pagamento-descricao="{{ $pagamento->descricao }}">
                                                    <i class="ki-outline ki-trash fs-3"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>

                                            <td></td>
                                            <td colspan="9" class="text-center py-10">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="bi bi-database-exclamation fs-2hx text-muted mb-4"></i>
                                                    <h4 class="text-gray-700 fw-bold">Nenhum registro encontrado</h4>
                                                    <p class="text-muted">Não há sepultamentos pagamentos no sistema
                                                    </p>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Content wrapper-->
            <!--begin::Footer-->
            @include('layouts.footer')
            <!--end::Footer-->
            <!--begin::Modal - Customers - Add-->
            @include('components.modal.novoPagamento')
            <!--end::Modal - Customers - Add-->
        </div>
        <!--end:::Main-->
    </div>
    <!--end::Wrapper container-->

</x-app-layout>
<!--begin::Vendors Javascript(used for this page only)-->
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/custom/utilities/modals/new-target.js"></script>
<!--begin::Vendors Javascript(used for this page only)-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/custom/apps/pagamento/list.js"></script>

<!--end::Custom Javascript-->
<!--end::Javascript-->

<script>
    function initializeModalDatepickers() {
        const datepickerOptions = {
            altInput: true,
            altFormat: "d/m/Y",
            dateFormat: "Y-m-d",
            allowInput: true,
            locale: {
                name: "pt",
                months: {
                    longhand: [
                        "Janeiro", "Fevereiro", "Março", "Abril",
                        "Maio", "Junho", "Julho", "Agosto",
                        "Setembro", "Outubro", "Novembro", "Dezembro"
                    ],
                    shorthand: [
                        "Jan", "Fev", "Mar", "Abr",
                        "Mai", "Jun", "Jul", "Ago",
                        "Set", "Out", "Nov", "Dez"
                    ]
                },
                weekdays: {
                    longhand: [
                        "Domingo", "Segunda-feira", "Terça-feira",
                        "Quarta-feira", "Quinta-feira",
                        "Sexta-feira", "Sábado"
                    ],
                    shorthand: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"]
                },
                firstDayOfWeek: 1,
                rangeSeparator: " até ",
                weekAbbreviation: "Sem",
                scrollTitle: "Scroll para incrementar",
                toggleTitle: "Clique para alternar",
                time_24hr: true
            }
        };

        // Initialize all datepickers in modal
        document.querySelectorAll('.modal-datepicker').forEach(picker => {
            const fp = picker.flatpickr(datepickerOptions);
            if (fp.altInput) {
                Inputmask("99/99/9999").mask(fp.altInput);
            }
        });
    }

    // Initialize when modal is shown
    document.addEventListener('DOMContentLoaded', function() {
        // If modal is already in DOM
        initializeModalDatepickers();

        // For dynamically loaded modals
        document.addEventListener('shown.bs.modal', function() {
            initializeModalDatepickers();
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.getElementById('kt_modal_pagamento');
        const modal = new bootstrap.Modal(modalElement);
        const form = document.getElementById('pagamento_form');
        const modalTitle = document.getElementById('modal_title');
        const modalDescription = document.getElementById('modal_description');
        const camposEdicao = document.getElementById('campos_edicao');
        const formMethodField = document.getElementById('form_method_field');

        // Inicializa a máscara de dinheiro
        Inputmask().mask(document.querySelectorAll('.money-mask'));

        // --- Evento para o botão ADICIONAR ---
        document.getElementById('btn_add_pagamento').addEventListener('click', function() {
            // 1. Limpa o formulário
            form.reset();
            $('#tumulo_id').val(null).trigger('change'); // Limpa o select2

            // 2. Configura o modal para "Adicionar"
            modalTitle.innerText = 'Registrar Novo Pagamento';
            modalDescription.innerText = 'Preencha os dados do novo pagamento.';
            form.action = "{{ route('pagamentos.store') }}";
            formMethodField.innerHTML = ''; // Garante que não há método PUT/PATCH

            // 3. Esconde os campos de edição
            camposEdicao.style.display = 'none';
        });

        // --- Evento para os botões EDITAR (usando delegação de evento) ---
        document.body.addEventListener('click', async function(e) {
            // Verifica se o elemento clicado (ou seu pai) é um botão de edição
            const editButton = e.target.closest('.btn-editar-pagamento');
            if (!editButton) {
                return;
            }

            e.preventDefault();

            const showUrl = editButton.dataset.urlShow;
            const updateUrl = editButton.dataset.urlUpdate;

            // 1. Configura o modal para "Editar"
            modalTitle.innerText = 'Editar Pagamento';
            modalDescription.innerText = 'Atualize os dados do pagamento.';
            form.action = updateUrl;
            formMethodField.innerHTML = '@method('PUT')';

            // 2. Mostra os campos de edição
            camposEdicao.style.display = 'flex'; // 'flex' para manter o alinhamento da linha

            // 3. Busca os dados do pagamento e preenche o formulário
            try {
                const response = await fetch(showUrl);
                if (!response.ok) throw new Error('Falha ao buscar dados do pagamento.');

                const pagamento = await response.json();

                // Preenche os campos
                document.getElementById('descricao').value = pagamento.descricao || '';
                document.getElementById('valor').value = pagamento.valor || '';
                document.getElementById('data_vencimento').value = pagamento.data_vencimento || '';
                document.getElementById('status').value = pagamento.status || '';
                document.getElementById('data_pagamento').value = pagamento.data_pagamento || '';

                // Define o valor do Select2 e dispara o evento 'change'
                $('#tumulo_id').val(pagamento.tumulo_id).trigger('change');
                $('#status').val(pagamento.status).trigger('change');

            } catch (error) {
                console.error('Erro:', error);
                // Opcional: mostrar uma notificação de erro ao usuário (ex: com Swal ou Toastr)
                alert('Não foi possível carregar os dados para edição.');
                modal.hide(); // Esconde o modal se houver erro
            }
        });

        // Adiciona um listener para limpar o formulário quando o modal é fechado
        modalElement.addEventListener('hidden.bs.modal', function() {
            form.reset();
            $('#tumulo_id').val(null).trigger('change');
            $('#status').val(null).trigger('change');
        });

    });
</script>
