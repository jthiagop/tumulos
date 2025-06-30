@push('breadcrumbs')
    <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>

    <li class="breadcrumb-item text-white fw-bold lh-1"><a class="text-reset" href="{{ route('dashboard') }}">Dashboards </a>
    </li>
    <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>
    <li class="breadcrumb-item text-white fw-bold lh-1">Tumulos</li>
@endpush

@section('page_title')
    Modulos de Túmulos
@endsection

@section('page_subtitle')
    Aqui você pode visualizar, editar e gerenciar os módulos de túmulos disponíveis.
@endsection

@section('toolbar_actions')
    <a href="#" class="btn btn-flex btn-sm btn-outline btn-active-color-primary btn-custom px-4" data-bs-toggle="modal"
        data-bs-target="#kt_modal_invite_friends">
        <i class="ki-outline ki-plus-square fs-4 me-2"></i>Invite</a>
    <a href="#" class="btn btn-sm btn-active-color-primary btn-outline btn-custom ms-3 px-4" data-bs-toggle="modal"
        data-bs-target="#kt_modal_new_target">Set Your Target</a>
@endsection
<x-app-layout>



    @include('components.modal.delete.excluir')
    @include('components.modal.tumulos.AddTumulos')
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
                                        placeholder="Buscar Tumulos" />
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
                                        <option value="all">Todos</option>
                                        <option value="Disponível">Disponível</option>
                                        <option value="Reservado">Reservado</option>
                                        <option value="Ocupado">Ocupado</option>
                                        <option value="Em Manutenção">Em Manutenção</option>
                                    </select>
                                    <!--end::Select2-->
                                </div>
                                <!--begin::Add product-->
                                <a href="{{ route('tumulos.create') }}" class="btn btn-primary"><i
                                        class="ki-outline ki-plus-square fs-4 me-2"></i>Add Túmulo</a>
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
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div
                                                class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                    data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                                    value="1" />
                                            </div>
                                        </th>
                                        <th class="min-w-200px">Código</th>
                                        <th class="text-end min-w-100px">Número</th>
                                        <th class="text-end min-w-100px">Tipo</th>
                                        <th class="text-end min-w-70px">Quadra</th>
                                        <th class="text-end min-w-100px">Localização</th>
                                        <th class="text-end min-w-100px">Status</th>
                                        <th class="text-end min-w-70px">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @forelse ($tumulos as $tumulo)
                                        <tr>
                                            <td>
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $tumulo->id }}" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-5">
                                                        <p class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                            data-kt-ecommerce-product-filter="product_name">
                                                            {{ $tumulo->codigo }}
                                                        </p>
                                                        <span class="text-muted fw-semibold d-block fs-7">
                                                            {{ $tumulo->rua ?? 'CPF não informado' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <span class="fw-bold">{{ $tumulo->numero }}</span>
                                            </td>

                                            <td class="text-end pe-0" data-order="{{ $tumulo->tipo }}">
                                                @if ($tumulo->tipo)
                                                    <div class="badge {{ $tumulo->tipo_badge }}">
                                                        <i class="{{ $tumulo->tipo_icon }} me-1"></i>
                                                        {{ $tumulo->tipo }}
                                                    </div>
                                                @else
                                                    <span class="text-muted">Não informado</span>
                                                @endif
                                            </td>
                                            <td class="text-end pe-0">{{ $tumulo->quadra }}</td>
                                            <td class="text-end pe-0" title="{{ $tumulo->localizacao_detalhada }}">
                                                @if ($tumulo->localizacao_detalhada)
                                                    <span data-bs-toggle="tooltip"
                                                        title="{{ $tumulo->localizacao_detalhada }}">
                                                        {{ Str::limit($tumulo->localizacao_detalhada, 20) }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">Não informado</span>
                                                @endif
                                            </td>
                                            <td class="text-end pe-0" data-order="{{ $tumulo->status }}">
                                                <!--begin::Badge com ícone -->
                                                <div class="badge {{ $tumulo->status_badge }}">
                                                    <i class="{{ $tumulo->status_icon }} me-1"></i>
                                                    {{ $tumulo->status }}
                                                </div>
                                                <!--end::Badge-->
                                            </td>
                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                    data-kt-menu-trigger="click"
                                                    data-kt-menu-placement="bottom-end">Ações
                                                    <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('tumulos.edit', $tumulo->id) }}"
                                                            class="menu-link px-3">Editar</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalDeleteDefault"
                                                            data-delete-url="{{ route('tumulos.destroy', $tumulo->id) }}"
                                                            data-item-name="o túmulo {{ $tumulo->numero ?? $tumulo->id }}">
                                                            Excluir
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td></td>
                                            <td colspan="9" class="text-center py-10">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="bi bi-database-exclamation fs-2hx text-muted mb-4"></i>
                                                    <h4 class="text-gray-700 fw-bold">Nenhum registro encontrado</h4>
                                                    <p class="text-muted">Não há tumulos cadastrados no sistema
                                                    </p>
                                                    <a href="{{ route('tumulos.create') }}"
                                                        class="btn btn-primary mt-3">
                                                        <i class="ki-outline ki-plus fs-2 me-2"></i> Cadastrar Novo
                                                    </a>
                                                </div>
                                            </td>
                                            <td></td>
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



    <!--end::Javascript-->
</x-app-layout>
<!--begin::Vendors Javascript(used for this page only)-->
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/custom/apps/ecommerce/catalog/tumulos.js"></script>

<!--end::Custom Javascript-->

<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/widgets.bundle.js"></script>
<script src="assets/js/custom/widgets.js"></script>
<script src="assets/js/custom/apps/chat/chat.js"></script>
<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="assets/js/custom/utilities/modals/new-target.js"></script>
<script src="assets/js/custom/utilities/modals/users-search.js"></script>
<!--end::Custom Javascript-->
