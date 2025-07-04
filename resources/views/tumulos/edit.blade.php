@push('breadcrumbs')
    <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>

    <li class="breadcrumb-item text-white fw-bold lh-1"><a class="text-reset" href="{{ route('dashboard') }}">Dashboards </a>
    </li>
    <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>
    <li class="breadcrumb-item text-white fw-bold lh-1"><a class="text-reset" href="{{ route('tumulos.index') }}">Tumulos</a></li>
        <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>
    <li class="breadcrumb-item text-white fw-bold lh-1">Editar</li>
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
                                        <h2>Editar Tumulos</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-5">
                                    <!--begin:Form-->
                                    <form id="" class="form" action="{{ route('tumulos.update', $tumulo->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!--begin::Heading-->
                                        <div class="mb-10">
                                            <div class="text-muted fw-semibold fs-6">
                                                Atualize as informações do túmulo abaixo
                                            </div>
                                        </div>
                                        <!--end::Heading-->

                                        <div class="row g-9 mb-8">
                                            <!--begin::Input group - Rua-->
                                            <div class="col-md-8 fv-row">
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    <span class="required">Rua</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        title="Especifique a rua onde o túmulo está localizado">
                                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                    </span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Rua São Francisco" name="rua"
                                                    value="{{ old('rua', $tumulo->rua) }}" />
                                                <x-input-error :messages="$errors->get('rua')" class="mt-2" />
                                            </div>

                                            <!--begin::Input group - Código-->
                                            <div class="col-md-4 fv-row">
                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                    <span class="required">Código</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        title="O Código será utilizado para identificar o túmulo">
                                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                    </span>
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="AGB-34A" name="codigo"
                                                    value="{{ old('codigo', $tumulo->codigo) }}" />
                                                <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="row g-9 mb-8">
                                            <!--begin::Col - Status-->
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Status</label>
                                                <select class="form-select form-select-solid" data-control="select2"
                                                    data-hide-search="true" name="status">
                                                    <option value="">Escolha o Status</option>
                                                    @foreach ($statusOptions as $option)
                                                        <option value="{{ $option }}"
                                                            {{ old('status', $tumulo->status) == $option ? 'selected' : '' }}>
                                                            {{ $option }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                            </div>

                                            <!--begin::Col - Quadra-->
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Quadra</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="3B" name="quadra"
                                                    value="{{ old('quadra', $tumulo->quadra) }}" />
                                                <x-input-error :messages="$errors->get('quadra')" class="mt-2" />
                                            </div>

                                            <!--begin::Col - Número-->
                                            <div class="col-md-4 fv-row">
                                                <label class="fs-6 fw-semibold mb-2">Número</label>
                                                <input type="number" class="form-control form-control-solid"
                                                    placeholder="34" name="numero"
                                                    value="{{ old('numero', $tumulo->numero) }}" />
                                                <x-input-error :messages="$errors->get('numero')" class="mt-2" />
                                            </div>
                                        </div>

                                        <!--begin::Input group - Localização-->
                                        <div class="d-flex flex-column mb-8">
                                            <label class="fs-6 fw-semibold mb-2">Localização Detalhada</label>
                                            <textarea class="form-control form-control-solid" rows="3" name="localizacao_detalhada"
                                                placeholder="Próximo ao cruzeiro central, lado direito">{{ old('localizacao_detalhada', $tumulo->localizacao_detalhada) }}</textarea>
                                            <x-input-error :messages="$errors->get('localizacao_detalhada')" class="mt-2" />
                                        </div>

<div class="row g-9 mb-8">
    <!-- Tags Input -->
    <div class="col-md-4 fv-row">
        <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="kt_ecommerce_add_product_tags">
            <span class="required">Tags</span>
            <span class="ms-1" data-bs-toggle="tooltip" title="Adicione tags para melhor organização">
                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
            </span>
        </label>
        <input id="kt_ecommerce_add_product_tags" class="form-control form-control-solid" name="tags"
               value="{{ old('tags', $tumulo->tags) }}" placeholder="Ex: familiar, histórico, religioso" />
        <div class="text-muted fs-7">Separe múltiplas tags com vírgulas</div>
        <x-input-error :messages="$errors->get('tags')" class="mt-2" />
    </div>

    <!-- Tipo do Túmulo Select -->
    <div class="col-md-4 fv-row">
        <label class="fs-6 fw-semibold mb-2" for="tipo_tumulo">Tipo do Túmulo</label>
        <select id="tipo_tumulo" class="form-select form-select-solid" data-control="select2"
                data-hide-search="true" name="tipo" required>
            <option disabled value="">Escolha o Tipo</option>
            @foreach ($tiposTumulo as $tipo)
                <option value="{{ $tipo }}"
                    {{ old('tipo', $tumulo->tipo) == $tipo ? 'selected' : '' }}>
                    {{ $tipo }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
    </div>

    <!-- Local do Jazigo Radio Buttons -->
    <div class="col-md-4 fv-row">
        <fieldset>
            <legend class="form-label d-block mb-3 fs-6 fw-semibold">Local do Jazigo:</legend>
            
            <div class="d-flex flex-wrap gap-3">
                <!-- Basílica da Penha -->
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="local" 
                           value="Basílica da Penha" id="basilica_penha" 
                           {{ old('local', $tumulo->local) == 'Basílica da Penha' ? 'checked' : '' }} />
                    <label class="form-check-label" for="basilica_penha">
                        Basílica da Penha
                    </label>
                </div>
                
                <!-- Santa Rita -->
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="local" 
                           value="Santa Rita" id="santa_rita" 
                           {{ old('local', $tumulo->local) == 'Santa Rita' ? 'checked' : '' }} />
                    <label class="form-check-label" for="santa_rita">
                        Santa Rita
                    </label>
                </div>
                
                <!-- São José -->
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="local" 
                           value="São José" id="sao_jose" 
                           {{ old('local', $tumulo->local) == 'São José' ? 'checked' : '' }} />
                    <label class="form-check-label" for="sao_jose">
                        São José
                    </label>
                </div>
                
                <!-- Outro -->
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" name="local" 
                           value="Outro" id="outro_local" 
                           {{ old('local', $tumulo->local) == 'Outro' ? 'checked' : '' }} />
                    <label class="form-check-label" for="outro_local">
                        Outro
                    </label>
                </div>
            </div>
            
            <!-- Campo para localização detalhada -->
            <div id="localizacao_detalhada_container" class="mt-3" 
                 style="{{ (old('local', $tumulo->local) == 'Outro') ? 'display: block;' : 'display: none;' }}">
                <label for="localizacao_detalhada" class="form-label">Especifique o local:</label>
                <input type="text" id="localizacao_detalhada" name="localizacao_detalhada" 
                       class="form-control form-control-solid" 
                       value="{{ old('localizacao_detalhada', $tumulo->localizacao_detalhada) }}" />
                <x-input-error :messages="$errors->get('localizacao_detalhada')" class="mt-2" />
            </div>
            
            @error('local')
                <div class="fv-plugins-message-container invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </fieldset>
    </div>
</div>

@push('scripts')
<script>
    // Mostra/oculta campo de localização detalhada baseado na seleção
    document.querySelectorAll('input[name="local"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const detalhesContainer = document.getElementById('localizacao_detalhada_container');
            detalhesContainer.style.display = this.value === 'Outro' ? 'block' : 'none';
            
            if (this.value !== 'Outro') {
                document.getElementById('localizacao_detalhada').value = '';
            }
        });
    });
</script>
@endpush
                                        <!--begin::Actions-->
                                        <div class="text-center">
                                            <a href="{{ route('tumulos.index') }}" type="reset"
                                                id="kt_modal_edit_target_cancel"
                                                class="btn btn-light me-3">Cancelar</a>
                                            <button type="submit" class="btn btn-primary">
                                                <span class="indicator-label">Atualizar</span>
                                                <span class="indicator-progress">Aguarde...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end:Form-->

                                    @push('scripts')
                                        <script>
                                            // Inicializa tooltips
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                                                tooltips.map(function(tooltip) {
                                                    return new bootstrap.Tooltip(tooltip);
                                                });

                                                // Configuração do formulário
                                                const form = document.getElementById('kt_modal_edit_tumulo_form');
                                                const submitButton = form.querySelector('button[type="submit"]');

                                                form.addEventListener('submit', function(e) {
                                                    if (!form.checkValidity()) {
                                                        e.preventDefault();
                                                        e.stopPropagation();
                                                    }

                                                    submitButton.setAttribute('data-kt-indicator', 'on');
                                                    submitButton.disabled = true;
                                                });
                                            });
                                        </script>
                                    @endpush
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
<!--begin::Custom Javascript(used for this page only)-->
<script src="/assets/js/custom/apps/ecommerce/catalog/save-product.js"></script>

<!--begin::Custom Javascript(used for this page only)-->
<script src="/assets/js/widgets.bundle.js"></script>
