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

    @include('components.modal.tumulos.AddTumulos')
    <!--begin::Wrapper container-->
    <div class="app-container container-xxl">
        <!--begin::Main-->
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <!--begin::Content wrapper-->
            <div class="d-flex flex-column flex-column-fluid">
                <!--begin::Content-->
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Contacts App- Add New Contact-->
                    <div class="row g-7">

                        <!--begin::Content-->
                        <div class="col-xl-12">
                            <!--begin::Contacts-->
                            <div class="card card-flush h-lg-100" id="kt_contacts_main">
                                <!--begin::Card header-->
                                <div class="card-header pt-7" id="kt_chat_contacts_header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <i class="ki-outline ki-badge fs-1 me-2"></i>
                                        <h2>Criar Tumulos</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-5">
                                    <!--begin:Form-->
                                    <form id="kt_modal_new_target_form" class="form"
                                        action="{{ route('tumulos.store') }}" method="POST">
                                        @csrf
                                        <!--end::Heading-->
                                        <div class="row g-9 mb-8">
                                            <!--begin::Input group-->
                                            <div class="col-md-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    <span class="">Rua</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        title="Espefifique a rua onde o tumulo está localizado">
                                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Rua São Francisco" name="rua" />
                                                <x-input-error :messages="$errors->get('rua')" class="mt-2" />

                                            </div>
                                            <!--begin::Input group-->
                                            <div class="col-md-4 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    <span class="">Código</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        title="O Código será utilizado para identificar o tumulo">
                                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="AGB-34A" name="codigo" />
                                                @error('codigo')
                                                    <div class="fv-plugins-message-container invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row g-9 mb-8">
                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <label class=" fs-6 fw-semibold mb-2">Status</label>
                                                <select class="form-select form-select-solid" data-control="select2"
                                                    data-hide-search="true" data-placeholder="Qual o status?"
                                                    name="status">
                                                    <option value="">Escolha o Status</option>
                                                    <option value="Disponível">Disponível</option>
                                                    <option value="Ocupado">Ocupado</option>
                                                    <option value="Reservado">Reservado</option>
                                                    <option value="Em Manutenção">Em Manutenção</option>
                                                </select>
                                                @error('status')
                                                    <div class="fv-plugins-message-container invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <label class=" fs-6 fw-semibold mb-2">Quadra</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="3B" name="quadra" />
                                                <x-input-error :messages="$errors->get('quadra')" class="mt-2" />

                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <label class=" fs-6 fw-semibold mb-2">Número</label>
                                                <input type="number" class="form-control form-control-solid"
                                                    placeholder="34" name="numero" />
                                                <x-input-error :messages="$errors->get('numero')" class="mt-2" />

                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-8">
                                            <label class="fs-6 fw-semibold mb-2">Localização Detalhada</label>
                                            <textarea class="form-control form-control-solid" rows="3" name="localizacao_detalhada"
                                                placeholder="Próximo ao cruzeiro central, lado direito"></textarea>
                                            @error('localizacao_detalhada')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row g-9 mb-8">
                                            <!--begin::Col-->
                                            <div class="col-md-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    <span class="required">Tags</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        title="Adicione tags para melhor organização">
                                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                    </span>

                                                </label>
                                                <!--end::Label-->
                                                <input id="kt_ecommerce_add_product_tags" name="tags"
                                                    class="form-control form-control-solid" value="ossuário, frade" />
                                                <div class="text-muted fs-7">Adicione tags a um tumulo.</div>

                                                <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Tipo do Túmulo</label>
                                                <select class="form-select form-select-solid" data-control="select2"
                                                    data-hide-search="true" data-placeholder="Qual o Tipo?"
                                                    name="tipo">
                                                    <option value="">Escolha o Tipo</option>
                                                    <option value="Jazigo">Jazigo</option>
                                                    <option value="Gaveta">Gaveta</option>
                                                    <option value="Cova Simples">Cova Simples</option>
                                                </select>
                                                <x-input-error :messages="$errors->get('tipo')" class="mt-2" />

                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--begin::Actions-->
                                        <div class="text-center">
                                            <a href="{{ route('tumulos.index') }}" type="reset"
                                                id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</a>
                                            <button type="submit" class="btn btn-primary">
                                                <span>Salvar</span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end:Form-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Contacts-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Contacts App- Add New Contact-->
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


<!--end::Custom Javascript-->

<!--begin::Custom Javascript(used for this page only)-->
<script src="/assets/js/custom/apps/ecommerce/catalog/save-product.js"></script>

<!--begin::Custom Javascript(used for this page only)-->
<script src="/assets/js/widgets.bundle.js"></script>

