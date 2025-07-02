<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Sistema completo para o gerenciamento de cemitérios. Controle túmulos, registros de falecidos, pagamentos e visualize dados importantes em um dashboard analítico e moderno." />
    <meta name="keywords"
        content="gestão de cemitério, sistema para cemitério, gerenciamento de túmulos, controle de sepulturas, software cemiterial, administração de cemitérios, pagamentos de manutenção, registro de falecidos" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Tumulos - Sistema de Gerenciamento de Cemitério" />
    <meta property="og:description"
        content="Plataforma online para administração eficiente de túmulos, registros e finanças cemiteriais." />
    <meta property="og:url" content="https://tumulos.xyz" />
    <meta property="og:site_name" content="Tumulos" />
    <link rel="canonical" href="https://tumulos.xyz" />


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="assets/media/logos/logo.ico" />

    <!-- Scripts -->
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @vite(['resources/assets/plugins/global/plugins.bundle.css', 'resources/assets/css/style.bundle.css'])
</head>
<!--begin::Theme mode setup on page load-->
<script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
</script>
<!--begin::Theme mode setup on page load-->

<body class="font-sans text-gray-900 antialiased">
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
                        <!--begin::Form-->
                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-gray-900 fw-bolder mb-3">Tumulos</h1>
                            <!--end::Title-->
                            <!--begin::Subtitle-->
                            <div class="text-gray-500 fw-semibold fs-6">Faça o seu Login</div>
                            <!--end::Subtitle=-->
                        </div>
                        <!--begin::Heading-->
                        {{ $slot }}

                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->
<div class="w-lg-500px d-flex flex-stack px-10 mx-auto">
                    <div class="me-10">
                        <button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base"
                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                            data-kt-menu-offset="0px, 0px">
                            <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3"
                                src="assets/media/flags/brazil.svg" alt="Bandeira do Brasil" />
                            <span data-kt-element="current-lang-name" class="me-1">Português</span>
                            <span class="d-flex flex-center rotate-180">
                                <i class="ki-outline ki-down fs-5 text-muted m-0"></i>
                            </span>
                        </button>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7"
                            data-kt-menu="true" id="kt_auth_lang_menu">
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link d-flex px-5 active" data-kt-lang="Português (Brasil)">
                                    <span class="symbol symbol-20px me-4">
                                        <img data-kt-element="lang-flag" class="rounded-1"
                                            src="assets/media/flags/brazil.svg" alt="" />
                                    </span>
                                    <span data-kt-element="lang-name">Português (Brasil)</span>
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
                                    <span class="symbol symbol-20px me-4">
                                        <img data-kt-element="lang-flag" class="rounded-1"
                                            src="assets/media/flags/united-states.svg" alt="" />
                                    </span>
                                    <span data-kt-element="lang-name">English</span>
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link d-flex px-5" data-kt-lang="Spanish">
                                    <span class="symbol symbol-20px me-4">
                                        <img data-kt-element="lang-flag" class="rounded-1"
                                            src="assets/media/flags/spain.svg" alt="" />
                                    </span>
                                    <span data-kt-element="lang-name">Español</span>
                                </a>
                            </div>
                            </div>
                        </div>
                    <div class="d-flex fw-semibold text-primary fs-base gap-5">
                        <a href="#" target="_blank">Termos</a>
                        <a href="#" target="_blank">Planos</a>
                        <a href="#" target="_blank">Contato</a>
                    </div>
                    </div>
            </div>
            <!--end::Body-->
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
                style="background-image: url(assets/media/misc/auth-bg.png)">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                    <!--begin::Logo-->

                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />

                    <!--end::Logo-->
                    <!--begin::Image-->
                    <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                        src="assets/media/misc/auth-screens.png" alt="" />
                    <!--end::Image-->
                    <!--begin::Title-->
                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Sistema de Gerenciamento
                        de Túmulos: Ágil, Eficiente e Organizado</h1>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="d-none d-lg-block text-white fs-base text-center">Nosso sistema de gerenciamento de
                        <a class="opacity-75-hover text-warning fw-bold me-1"> túmulos</a>foi projetado para oferecer
                        controle total e
                        <br />acompanhamento preciso dos jazigos, garantindo
                        <a class="opacity-75-hover text-warning fw-bold me-1">Gestão Eficiente</a>and their
                        <br />work following this is a transcript of the interview.
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>

            <!--end::Aside-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    @vite(['resources/assets/plugins/global/plugins.bundle.js', 'resources/assets/js/scripts.bundle.js'])
</body>

</html>
