@push('breadcrumbs')
    <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>

    <li class="breadcrumb-item text-white fw-bold lh-1"><a class="text-reset" href="{{ route('dashboard') }}">Dashboards </a>
    </li>
    <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>
    <li class="breadcrumb-item text-white fw-bold lh-1"><a class="text-reset"
            href="{{ route('pagamentos.index') }}">Pagamentos</a></li>
    <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>
    <li class="breadcrumb-item text-white fw-bold lh-1">Editar</li>
@endpush

@section('page_title')
    Editar Pagamento: {{ $pagamento->descricao }}
@endsection

{{-- @section('page_subtitle')
    <span class="text-muted fs-7 fw-bold ms-1">Crie um novo registro de falecido</span>
@endsection

@section('toolbar_actions')
    <a href="#" class="btn btn-flex btn-sm btn-outline btn-active-color-primary btn-custom px-4"
        data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
        <i class="ki-outline ki-plus-square fs-4 me-2"></i>Invite</a>
    <a href="#" class="btn btn-sm btn-active-color-primary btn-outline btn-custom ms-3 px-4" data-bs-toggle="modal"
        data-bs-target="#kt_modal_new_target">Set Your Target</a>
@endsection --}}
<x-app-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <form class="form" action="{{ route('pagamentos.update', $pagamento->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Detalhes da Cobrança</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="tumulo_id" class="form-label required">Túmulo</label>
                                    <select id="tumulo_id" name="tumulo_id" class="form-select select2" required>
                                        @foreach ($tumulos as $tumulo)
                                            <option value="{{ $tumulo->id }}" @selected(old('tumulo_id', $pagamento->tumulo_id) == $tumulo->id)>
                                                {{ $tumulo->codigo }} - {{ $tumulo->localizacao_detalhada ?? 'Sem detalhes' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="descricao" class="form-label required">Descrição</label>
                                    <input type="text" class="form-control" name="descricao" value="{{ old('descricao', $pagamento->descricao) }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="valor" class="form-label required">Valor (R$)</label>
                                    <input type="text" class="form-control" name="valor" value="{{ old('valor', $pagamento->valor) }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="data_vencimento" class="form-label required">Data de Vencimento</label>
                                    <input class="form-control" type="text" id="data_vencimento" name="data_vencimento" value="{{ old('data_vencimento', $pagamento->data_vencimento->format('Y-m-d')) }}" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label required">Status</label>
                                    <select id="status" name="status" class="form-select" required>
                                        @foreach(\App\Enums\PagamentoStatus::cases() as $status)
                                            <option value="{{ $status->value }}" @selected(old('status', $pagamento->status->value) == $status->value)>
                                                {{ $status->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="data_pagamento" class="form-label">Data do Pagamento</label>
                                    <input class="form-control" type="text" id="data_pagamento" name="data_pagamento" value="{{ old('data_pagamento', $pagamento->data_pagamento?->format('Y-m-d')) }}">
                                    <div class="form-text">Deixe em branco se o pagamento ainda estiver pendente.</div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">Atualizar Pagamento</button>
                                <a href="{{ route('pagamentos.index') }}" class="btn btn-label-secondary">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Inicializa Select2
                $('.select2').select2();

                // Inicializa Flatpickr para os campos de data
                $('#data_vencimento, #data_pagamento').flatpickr({
                    altInput: true,
                    altFormat: "d/m/Y",
                    dateFormat: "Y-m-d",
                });
            });
        </script>
    @endpush
</x-app-layout>