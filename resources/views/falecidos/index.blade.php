@push('breadcrumbs')
    <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>
    <li class="breadcrumb-item text-white fw-bold lh-1"><a class="text-reset" href="{{ route('dashboard') }}">Dashboards </a>
    </li>
    <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>
    <li class="breadcrumb-item text-white fw-bold lh-1">Falecidos</li>
@endpush

@section('page_title')
    Modulos de Pessoas Falecidas
@endsection

@section('page_subtitle')
    Aqui você pode gerenciar os tumulos de pessoas falecidas.
@endsection

@section('toolbar_actions')
    <a href="#" class="btn btn-flex btn-sm btn-outline btn-active-color-primary btn-custom px-4" data-bs-toggle="modal"
        data-bs-target="#kt_modal_invite_friends">
        <i class="ki-outline ki-plus-square fs-4 me-2"></i>Invite</a>
    <a href="#" class="btn btn-sm btn-active-color-primary btn-outline btn-custom ms-3 px-4" data-bs-toggle="modal"
        data-bs-target="#kt_modal_new_target">Set Your Target</a>
@endsection
<x-app-layout>
    <!--begin::Wrapper container-->
    <div class="app-container container-xxl">
        <!--begin::Main-->
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <!--begin::Content wrapper-->
            <div class="d-flex flex-column flex-column-fluid">
                <!--begin::Content-->
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Products-->
                    <div class="card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                                    <input type="text" data-kt-ecommerce-product-filter="search"
                                        class="form-control form-control-solid w-250px ps-12"
                                        placeholder="Pesquisar Sepultado" />
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <div class="w-100 mw-150px">
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true" data-placeholder="Status"
                                        data-kt-ecommerce-product-filter="status">
                                        <option></option>
                                        <option value="all">All</option>
                                        <option value="published">Published</option>
                                        <option value="scheduled">Scheduled</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <!--end::Select2-->
                                </div>
                                <!--begin::Add product-->
                                <a href="{{ route('falecidos.create') }}" class="btn btn-primary"><i
                                        class="ki-outline ki-plus-square fs-4 me-2"></i>Add Falecido</a>
                                <!--end::Add product-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5"
                                id="kt_ecommerce_products_table">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                    data-kt-check-target="#kt_sepultamentos_table .form-check-input" />
                                            </div>
                                        </th>
                                        <th class="min-w-350px">Falecido</th>
                                        <th class="min-w-100px text-center">Código</th>
                                        <th class="min-w-100px text-center">Túmulo</th>
                                        <th class="min-w-120px text-center">Tipo</th>
                                        <th class="min-w-120px text-center">Sepultamento</th>
                                        <th class="min-w-200px text-center">Responsável</th>
                                        <th class="min-w-150px text-center">Tags</th>
                                        <th class="min-w-100px text-end">Ações</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->

                                <!--begin::Table body-->
                                <tbody class="fw-semibold text-gray-600">
                                    @forelse ($sepultamentos as $sepultamento)
                                        @php
                                            // Processamento seguro dos dados
                                            $pessoaFalecida = $sepultamento->pessoaFalecida ?? null;
                                            $nomeCompleto = $pessoaFalecida->nome_completo ?? 'SF';
                                            $palavras = explode(' ', $nomeCompleto);
                                            $primeiraInicial = mb_substr($palavras[0] ?? '', 0, 1);
                                            $ultimaInicial =
                                                count($palavras) > 1 ? mb_substr(end($palavras), 0, 1) : '';
                                            $iniciais = $primeiraInicial . $ultimaInicial;
                                            $corPlaceholder =
                                                'bg-light-' .
                                                collect(['primary', 'success', 'info', 'warning', 'danger'])->random();

                                            // Processamento das tags
                                            $tags = [];
                                            if ($pessoaFalecida && !empty($pessoaFalecida->tags)) {
                                                if (is_string($pessoaFalecida->tags)) {
                                                    $tags = json_decode($pessoaFalecida->tags, true) ?? [];
                                                } else {
                                                    $tags = $pessoaFalecida->tags;
                                                }
                                            }
                                        @endphp

                                        <tr>
                                            <!--begin::Checkbox-->
                                            <td>
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $sepultamento->id }}" />
                                                </div>
                                            </td>
                                            <!--end::Checkbox-->

                                            <!--begin::Falecido-->
                                            <td>
                                                @if ($pessoaFalecida)
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-45px symbol-circle me-4">
                                                            @if ($pessoaFalecida->foto_path ?? false)
                                                                <img src="{{ asset('storage/' . $pessoaFalecida->foto_path) }}"
                                                                    alt="Foto de {{ $nomeCompleto }}"
                                                                    class="object-cover" />
                                                            @else
                                                                <span
                                                                    class="symbol-label {{ $corPlaceholder }} text-uppercase fs-4 fw-bold">
                                                                    {{ $iniciais }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <!--end::Avatar-->

                                                        <!--begin::Details-->
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ route('falecidos.show', $pessoaFalecida->id) }}"
                                                                class="text-gray-800 text-hover-primary fw-bold mb-1 fs-5">
                                                                {{ $nomeCompleto }}
                                                            </a>
                                                            <span class="text-muted fw-semibold d-block fs-7">
                                                                <i class="bi bi-person-badge me-1"
                                                                    aria-hidden="true"></i>
                                                                {{ $pessoaFalecida->cpf ?? 'CPF não informado' }}
                                                            </span>
                                                            <span class="text-muted fw-semibold d-block fs-7">
                                                                <i class="bi bi-calendar-event me-1"
                                                                    aria-hidden="true"></i>
                                                                Nasc:
                                                                {{ $pessoaFalecida->data_nascimento ? \Carbon\Carbon::parse($pessoaFalecida->data_nascimento)->format('d/m/Y') : 'N/I' }}
                                                            </span>
                                                        </div>
                                                        <!--end::Details-->
                                                    </div>
                                                @else
                                                    <div class="text-muted">Registro sem pessoa falecida associada</div>
                                                @endif
                                            </td>
                                            <!--end::Falecido-->

                                            <!--begin::Código-->
                                            <td class="text-center">
                                                <span class="badge badge-light-dark fw-bold">
                                                    {{ $sepultamento->tumulo->codigo ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <!--end::Código-->

                                            <!--begin::Status Túmulo-->
                                            <td class="text-center">
                                                @if (($sepultamento->tumulo->status ?? '') == 'Ocupado')
                                                    <span class="badge badge-light-danger py-2 px-3 fw-bold">
                                                        <i class="bi bi-x-circle-fill fs-5 me-1" aria-hidden="true"></i>
                                                        Ocupado
                                                    </span>
                                                @else
                                                    <span class="badge badge-light-success py-2 px-3 fw-bold">
                                                        <i class="bi bi-check-circle-fill fs-5 me-1"
                                                            aria-hidden="true"></i> Disponível
                                                    </span>
                                                @endif
                                            </td>
                                            <!--end::Status Túmulo-->

                                            <!--begin::Tipo Túmulo-->
                                            <td class="text-center">
                                                @if ($sepultamento->tumulo->tipo ?? false)
                                                    <div
                                                        class="badge {{ $sepultamento->tumulo->tipo_badge ?? 'badge-light-primary' }} py-2 px-3">
                                                        <i
                                                            class="{{ $sepultamento->tumulo->tipo_icon ?? 'bi bi-question-circle' }} me-2"></i>
                                                        {{ $sepultamento->tumulo->tipo }}
                                                    </div>
                                                @else
                                                    <span class="badge badge-light-secondary py-2 px-3">
                                                        <i class="bi bi-question-circle me-2"></i> N/I
                                                    </span>
                                                @endif
                                            </td>
                                            <!--end::Tipo Túmulo-->

                                            <!--begin::Data Sepultamento-->
                                            <td class="text-center">
                                                <div class="d-flex flex-column align-items-center">
                                                    <span class="fw-bold text-gray-800 fs-7">
                                                        {{ \Carbon\Carbon::parse($sepultamento->data_sepultamento)->format('d/m/Y') }}
                                                    </span>
                                                    <span class="text-muted fs-8">
                                                        {{ \Carbon\Carbon::parse($sepultamento->data_sepultamento)->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </td>
                                            <!--end::Data Sepultamento-->

                                            <!--begin::Responsável-->
                                            <td class="text-center">
                                                {{ $sepultamento->pessoaFalecida->nome_responsavel ?? 'Não informado' }}
                                            </td>
                                            <!--end::Responsável-->

                                            <!--begin::Tags-->
                                            <td class="text-center">
                                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                                    @forelse (array_slice($tags, 0, 3) as $tag)
                                                        @php
                                                            $tagValue = is_array($tag) ? $tag['value'] ?? '' : $tag;
                                                        @endphp
                                                        @if (!empty($tagValue))
                                                            <span class="badge badge-light-info py-1 px-2 fs-8">
                                                                {{ $tagValue }}
                                                            </span>
                                                        @endif
                                                    @empty
                                                        <span class="badge badge-light-secondary py-1 px-2 fs-8">
                                                            Sem tags
                                                        </span>
                                                    @endforelse
                                                    @if (count($tags) > 3)
                                                        <span class="badge badge-light-primary py-1 px-2 fs-8"
                                                            data-bs-toggle="tooltip"
                                                            title="{{ implode(', ',array_map(function ($t) {return is_array($t) ? $t['value'] ?? '' : $t;}, array_slice($tags, 3))) }}">
                                                            +{{ count($tags) - 3 }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <!--end::Tags-->
                                            <!--begin::Ações-->
                                            <td class="text-end">
                                                @if ($pessoaFalecida)
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-icon btn-active-light-primary"
                                                            type="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false" aria-label="Ações">
                                                            <i class="ki-outline ki-dots-horizontal fs-2"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('falecidos.show', $pessoaFalecida->id) }}">
                                                                    <i class="bi bi-eye-fill me-2"></i> Visualizar
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('falecidos.edit', $pessoaFalecida->id) }}">
                                                                    <i class="bi bi-pencil-fill me-2"></i> Editar
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li>
                                                                <form
                                                                    action="{{ route('falecidos.destroy', $pessoaFalecida->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="dropdown-item text-danger"
                                                                        onclick="return confirm('Tem certeza que deseja excluir este registro?')">
                                                                        <i class="bi bi-trash-fill me-2"></i> Excluir
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @else
                                                    <span class="text-muted fs-8">N/A</span>
                                                @endif
                                            </td>
                                            <!--end::Ações-->
                                        </tr>
                                    @empty
                                        <tr>

                                            <td></td>
                                            <td colspan="9" class="text-center py-10">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="bi bi-database-exclamation fs-2hx text-muted mb-4"></i>
                                                    <h4 class="text-gray-700 fw-bold">Nenhum registro encontrado</h4>
                                                    <p class="text-muted">Não há sepultamentos cadastrados no sistema
                                                    </p>
                                                    <a href="{{ route('falecidos.create') }}"
                                                        class="btn btn-primary mt-3">
                                                        <i class="ki-outline ki-plus fs-2 me-2"></i> Cadastrar Novo
                                                    </a>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>                                            <td></td>
                                            <td></td>
                                            <td></td>

                                            <td></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Products-->
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

<!--begin::Vendors Javascript(used for this page only)-->
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/custom/apps/ecommerce/catalog/falecidos.js"></script>
