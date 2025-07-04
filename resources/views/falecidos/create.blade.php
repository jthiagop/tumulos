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
            href="{{ route('falecidos.index') }}">Falecidos</a></li>
    <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>
    <li class="breadcrumb-item text-white fw-bold lh-1">Cadastro</li>
@endpush

@section('page_title')
    Cadastro de Pessoas Falecidas
@endsection

@section('page_subtitle')
    <span class="text-muted fs-7 fw-bold ms-1">Crie um novo registro de falecido</span>
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
                    <!--begin::Form-->
                    <form class="form d-flex flex-column flex-lg-row" action="{{ route('falecidos.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Aside column-->
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <!--begin::Thumbnail settings-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Foto</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body text-center pt-0">
                                    <!--begin::Image input-->
                                    <!--begin::Image input placeholder-->
                                    <style>
                                        .image-input-placeholder {
                                            background-image: url('/assets/media/svg/files/blank-image.svg');
                                        }

                                        [data-bs-theme="dark"] .image-input-placeholder {
                                            background-image: url('/assets/media/svg/files/blank-image-dark.svg');
                                        }
                                    </style>
                                    <!--end::Image input placeholder-->
                                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                        data-kt-image-input="true">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-150px h-150px"></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                            title="Change avatar">
                                            <i class="ki-outline ki-pencil fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="foto_path" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Cancel-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            title="Cancel avatar">
                                            <i class="ki-outline ki-cross fs-2"></i>
                                        </span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                            title="Remove avatar">
                                            <i class="ki-outline ki-cross fs-2"></i>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Defina a imagem de miniatura do falecido. Apenas
                                        arquivos de imagem *.png, *.jpg e *.jpeg são aceitos</div>
                                    @error('foto_path')
                                        <div class="fv-plugins-message-container invalid-feedback fs-7">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <!--end::Description-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Thumbnail settings-->
                            <!--begin::Status-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Status Social</h2>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <div class="rounded-circle bg-success w-15px h-15px"
                                            id="kt_ecommerce_add_product_status"></div>
                                    </div>
                                    <!--begin::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                        data-placeholder="Select an option" name="status_social"
                                        id="kt_ecommerce_add_product_status_select">
                                        <option></option>
                                        <option value="Leigo">Leigo</option>
                                        <option value="Frade" selected="selected">Frade</option>
                                        >
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the product status.</div>
                                    <!--end::Description-->
                                    <!--begin::Datepicker-->
                                    <div class="d-none mt-10">
                                        <label for="kt_ecommerce_add_product_status_datepicker"
                                            class="form-label">Select publishing date and time</label>
                                        <input class="form-control" id="kt_ecommerce_add_product_status_datepicker"
                                            placeholder="Pick date & time" />
                                    </div>
                                    <!--end::Datepicker-->
                                </div>
                                <!--end::Card body-->
                                @error('status_social')
                                    <div class="fv-plugins-message-container invalid-feedback fs-7">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!--end::Status-->
                            <!--begin::Category & tags-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>+ Detalhes Familiar</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <!--begin::Label-->
                                    <label class="form-label d-block">Tags</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input id="kt_ecommerce_add_product_tags" class="form-control mb-2" value=""
                                        name="tags" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Adicione Tags ao falecido.</div>
                                    <!--end::Description-->
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Category & tags-->
                        </div>
                        <!--end::Aside column-->
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">


                            <!--begin::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general"
                                role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <!--begin::General options-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card body-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Informações Gerais</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="mb-10 fv-row">
                                                <label class="required form-label">Nome Completo do
                                                    Falecido</label>
                                                <input type="text" class="form-control mb-2" name="nome_completo"
                                                    placeholder="Nome e Sobrenome"
                                                    value="{{ old('nome_completo') }}" />
                                                @error('nome_completo')
                                                    <div class="fv-plugins-message-container invalid-feedback fs-7">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-10">
                                                <label class="form-label">Descrição / Biografia</label>
                                                <textarea class="form-control" name="descricao" rows="4"
                                                    placeholder="Uma breve biografia ou detalhes importantes">{{ old('descricao') }}</textarea>
                                            </div>

                                            <div class="row g-9 mb-10">
                                                <div class="col-md-4 fv-row">
                                                    <label class="form-label">Data de Nascimento</label>
                                                    <input class="form-control" name="data_nascimento"
                                                        placeholder="Selecione a data" id="kt_datepicker_nascimento"
                                                        value="{{ old('data_nascimento') }}" />
                                                    @error('data_nascimento')
                                                        <div class="fv-plugins-message-container invalid-feedback fs-7">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 fv-row">
                                                    <label class=" form-label">Data de Falecimento</label>
                                                    <input class="form-control" name="data_falecimento"
                                                        placeholder="Selecione a data" id="kt_datepicker_falecimento"
                                                        value="{{ old('data_falecimento') }}" />
                                                    @error('data_falecimento')
                                                        <div class="fv-plugins-message-container invalid-feedback fs-7">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 fv-row">
                                                    <label class="form-label">CPF</label>
                                                    <input class="form-control" name="cpf"
                                                        placeholder="000.000.000-00"
                                                        data-inputmask="'mask': '999.999.999-99'"
                                                        value="{{ old('cpf') }}" />
                                                    @error('cpf')
                                                        <div class="fv-plugins-message-container invalid-feedback fs-7">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="fv-row">
                                                <label class="form-label">Causa da Morte</label>
                                                <input type="text" class="form-control mb-2" name="causa_morte"
                                                    placeholder="Descreva a causa da morte"
                                                    value="{{ old('causa_morte') }}">
                                                @error('causa_morte')
                                                    <div class="fv-plugins-message-container invalid-feedback fs-7">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Card body-->
                                    <!--end::General options-->

                                </div>
                            </div>
                            <!--end::Tab pane-->
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Informações do Sepultamento e Responsável</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row g-9 mb-10">
                                        <div class="col-md-6 fv-row">
                                            <label class="required form-label">Túmulo</label>
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="Selecione um túmulo" name="tumulo_id">
                                                <option></option>
                                                @foreach ($tumulos as $tumulo)
                                                    <option value="{{ $tumulo->id }}" @selected(old('tumulo_id') == $tumulo->id)>
                                                        {{ $tumulo->codigo }} ({{ $tumulo->tipo }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('tumulo_id')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 fv-row">
                                            <label class="form-label">Data do Sepultamento</label>
                                            <input class="form-control" itemid="" name="data_sepultamento"
                                                placeholder="Selecione a data" id="kt_datepicker_sepultamento"
                                                value="{{ old('data_sepultamento') }}" />
                                            @error('data_sepultamento')
                                                <div class="fv-plugins-message-container invalid-feedback fs-7">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row g-9 mb-10">
                                        <div class="col-md-5 fv-row">
                                            <label class="form-label">Nome do Responsável</label>
                                            <input type="text" class="form-control mb-2"
                                                placeholder="Nome completo do familiar responsável"
                                                name="nome_responsavel" value="{{ old('nome_responsavel') }}" />
                                            @error('nome_responsavel')
                                                <div class="fv-plugins-message-container invalid-feedback fs-7">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-7 fv-row">
                                            <label class="form-label">Endereço do Responsável</label>
                                            <input type="text" class="form-control mb-2" name="endereco_responsavel"
                                                placeholder="Descreva a causa da morte"
                                                value="{{ old('endereco_responsavel') }}">
                                            @error('endereco_responsavel')
                                                <div class="fv-plugins-message-container invalid-feedback fs-7">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <div class="row g-5 mb-10">
                                        <div class="col-md-6 fv-row">
                                            <label class="form-label">E-mail</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Digite o e-mail" />
                                            @error('email')
                                                <div class="fv-plugins-message-container invalid-feedback fs-7">
                                                    {{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="col-md-6 fv-row">
                                            <label class="form-label">Telefone</label>
                                            <input type="tel" name="telefone_responsavel" class="form-control"
                                                placeholder="Digite o telefone"
                                                data-inputmask="'mask': '(99) 9.9999-9999'" />
                                            @error('telefone_responsavel')
                                                <div class="fv-plugins-message-container invalid-feedback fs-7">
                                                    {{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::Media-->
                                {{-- <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Media</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-2">
                                            <!--begin::Dropzone-->
                                            <div class="dropzone" id="kt_ecommerce_add_product_media">
                                                <!--begin::Message-->
                                                <div class="dz-message needsclick">
                                                    <!--begin::Icon-->
                                                    <i class="ki-outline ki-file-up text-primary fs-3x"></i>
                                                    <!--end::Icon-->
                                                    <!--begin::Info-->
                                                    <div class="ms-4">
                                                        <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files
                                                            here or click to upload.</h3>
                                                        <span class="fs-7 fw-semibold text-gray-500">Upload up
                                                            to 10 files</span>
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                            </div>
                                            <!--end::Dropzone-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Set the product media gallery.</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Card header-->
                                </div> --}}
                                <!--end::Media-->
                            </div>

                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <a href="{{ route('falecidos.index') }}" class="btn btn-light me-5">Voltar</a>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="submit" class="btn btn-primary">
                                    <span>Cadastrar Falecido</span>

                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                        <!--end::Main column-->
                    </form>
                    <!--end::Form-->
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
    </div>
    <!--end::Wrapper-->
</x-app-layout>

<!--begin::Javascript-->
<script>
    var hostUrl = "assets/";
</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="/assets/plugins/custom/formrepeater/formrepeater.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="/assets/js/custom/apps/ecommerce/catalog/save-product.js"></script>
<script src="/assets/js/widgets.bundle.js"></script>
<script src="/assets/js/custom/widgets.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const datepickerOptions = {
            altInput: true,
            altFormat: "d/m/Y",
            dateFormat: "Y-m-d",
            allowInput: true,
            // locale: "pt", // Se você quiser ativar a localização
        };

        const nascimentoPickerEl = document.querySelector("#kt_datepicker_nascimento");
        const falecimentoPickerEl = document.querySelector("#kt_datepicker_falecimento");
        const sepultamentoPickerEl = document.querySelector("#kt_datepicker_sepultamento");

        if (nascimentoPickerEl && falecimentoPickerEl && sepultamentoPickerEl) {
            nascimentoPickerEl.flatpickr(datepickerOptions);
            falecimentoPickerEl.flatpickr(datepickerOptions);
            sepultamentoPickerEl.flatpickr(datepickerOptions);

            const nascimentoPicker = nascimentoPickerEl._flatpickr;
            const falecimentoPicker = falecimentoPickerEl._flatpickr;
            const sepultamentoPicker = sepultamentoPickerEl._flatpickr;

            // Aplica a máscara apenas no campo "altInput", que é o visível ao usuário
            Inputmask("99/99/9999").mask(nascimentoPicker.altInput);
            Inputmask("99/99/9999").mask(falecimentoPicker.altInput);
            Inputmask("99/99/9999").mask(sepultamentoPicker.altInput);

            // Lógica para interligar datas
            nascimentoPicker.config.onChange.push(function(selectedDates, dateStr) {
                falecimentoPicker.set('minDate', dateStr);
            });

            falecimentoPicker.config.onChange.push(function(selectedDates, dateStr) {
                sepultamentoPicker.set('minDate', dateStr);
            });
        }
    });
</script>
<!--end::Custom Javascript-->
