@push('breadcrumbs')
    <li class="breadcrumb-item">
        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
    </li>
    <li class="breadcrumb-item text-white fw-bold lh-1">Dashboards</li>
@endpush

@section('page_title')
    Configuração do Perfil, {{ Auth::user()->name }}
@endsection

@section('page_subtitle')
    Sistema de Gestão Memorial - Proneb do Nordeste
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
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row">
                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                            <!--begin::Card-->
                            <div class="card mb-5 mb-xl-8">
                                <!--begin::Card body-->
                                <div class="card-body">
                                    <!--begin::Summary-->
                                    <!--begin::User Info-->
                                    <div class="d-flex flex-center flex-column py-5">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-100px symbol-circle mb-7">
                                            <img src="assets/media/avatars/blank.png" alt="image" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ Auth::user()->name}}</a>
                                        <!--end::Name-->
                                        <!--begin::Position-->
                                        <div class="mb-9">
                                            <!--begin::Badge-->
                                            <div class="badge badge-lg badge-light-primary d-inline">Administrator</div>
                                            <!--begin::Badge-->
                                        </div>
                                        <!--end::Position-->
                                        <!--begin::Info-->
                                        <!--begin::Info heading-->
                                        <div class="fw-bold mb-3">Assigned Tickets
                                            <span class="ms-2" ddata-bs-toggle="popover" data-bs-trigger="hover"
                                                data-bs-html="true"
                                                data-bs-content="Number of support tickets assigned, closed and pending this week.">
                                                <i class="ki-outline ki-information fs-7"></i>
                                            </span>
                                        </div>
                                        <!--end::Info heading-->
                                        <div class="d-flex flex-wrap flex-center">
                                            <!--begin::Stats-->
                                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                                <div class="fs-4 fw-bold text-gray-700">
                                                    <span class="w-75px">243</span>
                                                    <i class="ki-outline ki-arrow-up fs-3 text-success"></i>
                                                </div>
                                                <div class="fw-semibold text-muted">Total</div>
                                            </div>
                                            <!--end::Stats-->
                                            <!--begin::Stats-->
                                            <div
                                                class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
                                                <div class="fs-4 fw-bold text-gray-700">
                                                    <span class="w-50px">56</span>
                                                    <i class="ki-outline ki-arrow-down fs-3 text-danger"></i>
                                                </div>
                                                <div class="fw-semibold text-muted">Solved</div>
                                            </div>
                                            <!--end::Stats-->
                                            <!--begin::Stats-->
                                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                                <div class="fs-4 fw-bold text-gray-700">
                                                    <span class="w-50px">188</span>
                                                    <i class="ki-outline ki-arrow-up fs-3 text-success"></i>
                                                </div>
                                                <div class="fw-semibold text-muted">Open</div>
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User Info-->
                                    <!--end::Summary-->
                                    <!--begin::Details toggle-->
                                    <div class="d-flex flex-stack fs-4 py-3">
                                        <div class="fw-bold rotate collapsible" data-bs-toggle="collapse"
                                            href="#kt_user_view_details" role="button" aria-expanded="false"
                                            aria-controls="kt_user_view_details">Details
                                            <span class="ms-2 rotate-180">
                                                <i class="ki-outline ki-down fs-3"></i>
                                            </span>
                                        </div>

                                    </div>
                                    <!--end::Details toggle-->
                                    <div class="separator"></div>
                                    <!--begin::Details content-->
                                    <div id="kt_user_view_details" class="collapse show">
                                        <div class="pb-5 fs-6">
                                            <!--begin::Details item-->
                                            <div class="fw-bold mt-5">Account ID</div>
                                            <div class="text-gray-600">ID-{{ Auth::user()->id}}</div>
                                            <!--begin::Details item-->
                                            <!--begin::Details item-->
                                            <div class="fw-bold mt-5">Email</div>
                                            <div class="text-gray-600">
                                                <a href="#"
                                                    class="text-gray-600 text-hover-primary">{{ Auth::user()->email}}</a>
                                            </div>
                                            <!--begin::Details item-->
                                            <!--begin::Details item-->
                                            <div class="fw-bold mt-5">Last Login</div>
                                            <div class="text-gray-600">10 Nov 2024, 6:43 am</div>
                                            <!--begin::Details item-->
                                        </div>
                                    </div>
                                    <!--end::Details content-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->

                        </div>
                        <!--end::Sidebar-->
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid ms-lg-15">
                            <!--begin::Sign-in Method-->
                            <div class="card mb-5 mb-xl-10">
                                <!--begin::Card header-->
                                <div class="card-header border-0 cursor-pointer" role="button"
                                    data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bold m-0">Método de fazer Login</h3>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Content-->
                                <div id="kt_account_settings_signin_method" class="collapse show">
                                    <!--begin::Card body-->
                                    <div class="card-body border-top p-9">
                                        <!--begin::Email Address-->
                                        <div class="d-flex flex-wrap align-items-center">
                                            <!--begin::Label-->
                                            <div id="kt_signin_email">
                                                <div class="fs-6 fw-bold mb-1">E-mail</div>
                                                <div class="fw-semibold text-gray-600">{{ Auth::user()->email}}</div>
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Edit-->
                                            <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                                <!--begin::Form-->
                                                <form method="post" action="{{ route('profile.update') }}"
                                                    class="mt-6 space-y-6">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="row mb-6">
                                                        <div class="col-lg-6">
                                                            <div class="fv-row mb-0">
                                                                <label for="confirmemailpassword"
                                                                    class="form-label fs-6 fw-bold mb-3">Confirme a
                                                                    Senha</label>
                                                                <x-text-input id="name" name="name"
                                                                    type="text"
                                                                    class="form-control form-control-lg form-control-solid"
                                                                    :value="old('name', $user->name)" required autofocus
                                                                    autocomplete="name" />

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                                            <div class="fv-row mb-0">
                                                                <label for="emailaddress"
                                                                    class="form-label fs-6 fw-bold mb-3">Novo
                                                                    E-mail</label>
                                                                <x-text-input id="email" name="email"
                                                                    type="email"
                                                                    class="mt-1 block w-full form-control form-control-lg form-control-solid"
                                                                    :value="old('email', $user->email)" required
                                                                    autocomplete="username" />
                                                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <button id="kt_signin_submit" type="submit"
                                                            class="btn btn-primary me-2 px-6">Atualizar Email</button>
                                                        <button id="kt_signin_cancel" type="button"
                                                            class="btn btn-color-gray-500 btn-active-light-primary px-6">Cancelar</button>
                                                    </div>
                                                </form>
                                                <!--end::Form-->
                                            </div>
                                            <!--end::Edit-->
                                            <!--begin::Action-->
                                            <div id="kt_signin_email_button" class="ms-auto">
                                                <button class="btn btn-light btn-active-light-primary">Altera
                                                    E-mail</button>
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Email Address-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed my-6"></div>
                                        <!--end::Separator-->
                                        <!--begin::Password-->
                                        <div class="d-flex flex-wrap align-items-center mb-10">
                                            <!--begin::Label-->
                                            <div id="kt_signin_password">
                                                <div class="fs-6 fw-bold mb-1">Senha</div>
                                                <div class="fw-semibold text-gray-600">************</div>
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Edit-->
                                            <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                                <!--begin::Form-->
                                                <form id="kt_signin_change_password" class="form"
                                                    novalidate="novalidate" method="post"
                                                    action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                                    @csrf
                                                    @method('put')
                                                    <div class="row mb-1">
                                                        <div class="col-lg-4">
                                                            <div class="fv-row mb-0">
                                                                <label for="currentpassword"
                                                                    class="form-label fs-6 fw-bold mb-3">Senha
                                                                    Atual</label>
                                                                <input type="password"
                                                                    class="form-control form-control-lg form-control-solid"
                                                                    id="update_password_current_password"
                                                                    name="current_password" type="password"
                                                                    autocomplete="current-password" />
                                                                <x-input-error :messages="$errors->updatePassword->get(
                                                                    'current_password',
                                                                )" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="fv-row mb-0">
                                                                <label for="newpassword"
                                                                    class="form-label fs-6 fw-bold mb-3">Nova
                                                                    Senha</label>
                                                                <input type="password"
                                                                    class="form-control form-control-lg form-control-solid"
                                                                    id="update_password_password" name="password"
                                                                    type="password" autocomplete="new-password" />
                                                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="fv-row mb-0">
                                                                <label for="confirmpassword"
                                                                    class="form-label fs-6 fw-bold mb-3">Confirme a
                                                                    nova Senha</label>
                                                                <input type="password"
                                                                    class="form-control form-control-lg form-control-solid"
                                                                    id="update_password_password_confirmation"
                                                                    name="password_confirmation" type="password"
                                                                    autocomplete="new-password" />
                                                                <x-input-error :messages="$errors->updatePassword->get(
                                                                    'password_confirmation',
                                                                )" class="mt-2" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-text mb-5">A senha deve ter pelo menos 8
                                                        caracteres e contêm símbolos</div>
                                                    <div class="d-flex">
                                                        <button type="submit"
                                                            class="btn btn-primary me-2 px-6">Atualizar Senha</button>
                                                        <button id="kt_password_cancel" type="button"
                                                            class="btn btn-color-gray-500 btn-active-light-primary px-6">Cancelar</button>
                                                    </div>
                                                </form>
                                                <!--end::Form-->
                                            </div>
                                            <!--end::Edit-->
                                            <!--begin::Action-->
                                            <div id="kt_signin_password_button" class="ms-auto">
                                                <button class="btn btn-light btn-active-light-primary">Resetar
                                                    Senha</button>
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Password-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Content-->

                            </div>
                            <!--end::Sign-in Method-->
                            <!--begin::Deactivate Account-->
                            <div class="card">
                                <!--begin::Card header-->
                                <div class="card-header border-0 cursor-pointer" role="button"
                                    data-bs-toggle="collapse" data-bs-target="#kt_account_deactivate"
                                    aria-expanded="true" aria-controls="kt_account_deactivate">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bold m-0">Excluir Conta</h3>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Content-->
                                <div id="kt_account_settings_deactivate" class="collapse show">
                                    <!--begin::Form-->
                                    <form id="kt_account_deactivate_form" class="form">
                                        <!--begin::Card body-->
                                        <div class="card-body border-top p-9">
                                            <!--begin::Notice-->
                                            <div
                                                class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                                <!--begin::Icon-->
                                                <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>
                                                <!--end::Icon-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-stack flex-grow-1">
                                                    <!--begin::Content-->
                                                    <div class="fw-semibold">
                                                        <h4 class="text-gray-900 fw-bold">Atenção - Excluir Conta</h4>
                                                        <div class="fs-6 text-gray-700">Depois que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Antes de excluir sua conta, faça o download de todos os dados ou informações que deseja reter.
                                                        </div>
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Notice-->
                                        </div>
                                        <!--end::Card body-->
                                        <!--begin::Card footer-->
                                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                                            <button disabled id="kt_account_deactivate_account_submit" type="submit"
                                                class="btn btn-danger fw-semibold">Excluir Conta</button>
                                        </div>
                                        <!--end::Card footer-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Deactivate Account-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Layout-->
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
<script src="assets/js/custom/account/settings/signin-methods.js"></script>
<script src="assets/js/custom/account/settings/profile-details.js"></script>
<script src="assets/js/custom/account/settings/deactivate-account.js"></script>
<script src="assets/js/custom/pages/user-profile/general.js"></script>
<script src="assets/js/widgets.bundle.js"></script>
<script src="assets/js/custom/widgets.js"></script>
<script src="assets/js/custom/apps/chat/chat.js"></script>
