@push('breadcrumbs')
    <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>

    <li class="breadcrumb-item text-white fw-bold lh-1"><a class="text-reset" href="{{ route('dashboard') }}">Dashboards </a>
    </li>
    <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>
    <li class="breadcrumb-item text-white fw-bold lh-1"><a class="text-reset" href="{{ route('tumulos.index') }}">Tumulos</a>
    </li>
    <li class="breadcrumb-item"> <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>
    <li class="breadcrumb-item text-white fw-bold lh-1">Cadastro</li>
@endpush

@section('page_title')
    Cadastro de Tumulos
@endsection

@section('page_subtitle')
    Aqui você pode visualizar, editar e gerenciar o túmulo escolhido.
@endsection

@section('toolbar_actions')
    <a href="#" class="btn btn-flex btn-sm btn-outline btn-active-color-primary btn-custom px-4"
        data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
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
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card header-->
                        <div class="card-header border-0 pt-6">

                            <!--begin::Card title-->
                            <div class="card-title">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Lixeira - Túmulos</h5>

                                </div>
                            </div>
                            <!--begin::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">

                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                                        <input type="text" data-kt-customer-table-filter="search"
                                            class="form-control form-control-solid w-250px ps-13"
                                            placeholder="Search Customers" />
                                    </div>
                                    <!--end::Search-->
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::Group actions-->
                                <div class="d-flex justify-content-end align-items-center d-none"
                                    data-kt-customer-table-toolbar="selected">
                                    <div class="fw-bold me-5">
                                        <span class="me-2"
                                            data-kt-customer-table-select="selected_count"></span>Selected
                                    </div>
                                    <button type="button" class="btn btn-danger"
                                        data-kt-customer-table-select="delete_selected">Delete Selected</button>
                                </div>
                                <!--end::Group actions-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div
                                                class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                    data-kt-check-target="#kt_customers_table .form-check-input"
                                                    value="1" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px">Código</th>
                                        <th class="min-w-125px">Rua</th>
                                        <th class="min-w-125px">Tipo</th>
                                        <th class="min-w-125px">Status</th>
                                        <th class="min-w-125px">Deletetado em </th>
                                        <th class="text-end min-w-70px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @forelse ($tumulos as $tumulo)
                                        <tr>
                                            <td>
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>
                                                <a
                                                    class="text-gray-800 text-hover-primary mb-1">{{ $tumulo->codigo }}</a>
                                            </td>
                                            <td>
                                                <a href="#"
                                                    class="text-gray-600 text-hover-primary mb-1">{{ $tumulo->rua }}</a>
                                            </td>
                                            <td>
                                                <!--begin::Badges-->
                                                <div class="badge badge-light-success">{{ $tumulo->tipo }}</div>
                                                <!--end::Badges-->
                                            </td>
                                            <td>{{ $tumulo->status }}</td>
                                            <td>{{ $tumulo->deleted_at->format('d/m/Y H:i') }}</td>
                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                    data-kt-menu-trigger="click"
                                                    data-kt-menu-placement="bottom-end">Ações
                                                    <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                                                    data-kt-menu="true">

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <form action="{{ route('lixeira.restore', $tumulo->id) }}"
                                                            method="POST" class="w-100">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="btn btn-flex btn-color-success btn-active-light-success w-100 px-4">
                                                                <i class="fas fa-trash-restore me-2"></i>
                                                                Restaurar
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <!--end::Menu item-->

                                                    <!--begin::Menu separator-->
                                                    <div class="separator my-2"></div>
                                                    <!--end::Menu separator-->

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <button type="button"
                                                            class="btn btn-flex btn-color-danger btn-active-light-danger w-100 px-4"
                                                            onclick="confirmDelete('{{ route('lixeira.forceDelete', $tumulo->id) }}')">
                                                            <i class="fas fa-trash-alt me-2"></i>
                                                            Excluir
                                                        </button>
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
                                                </div>
                                            </td>
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
                    <!--end::Card-->
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

    <!-- Modal de confirmação -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir permanentemente este túmulo? Esta ação não pode ser desfeita.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir Permanentemente</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(url) {
            $('#deleteForm').attr('action', url);
            $('#confirmDeleteModal').modal('show');
        }
    </script>
</x-app-layout>

<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/custom/apps/ecommerce/customers/listing/listing.js"></script>
<script src="assets/js/custom/apps/ecommerce/customers/listing/add.js"></script>
<script src="assets/js/custom/apps/ecommerce/customers/listing/export.js"></script>
