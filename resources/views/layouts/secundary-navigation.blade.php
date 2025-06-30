<div id="kt_app_toolbar" class="app-toolbar py-6">
  <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex align-items-start">
    <div class="d-flex flex-column flex-row-fluid">
      <div class="d-flex align-items-center pt-1">
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold">
          <li class="breadcrumb-item text-white fw-bold lh-1">
            {{-- Item Fixo: Home --}}
            <a href="{{ route('dashboard') }}" class="text-white text-hover-primary">
              <i class="ki-outline ki-home text-gray-700 fs-6"></i>
            </a>
          </li>
          {{-- Aqui é a mágica para os breadcrumbs --}}
          @stack('breadcrumbs')

        </ul>
        </div>
      <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">
        <div class="page-title me-5">
          <h1 class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">
            
            {{-- Título da Página Dinâmico --}}
            @yield('page_title')

            <span class="page-desc text-gray-600 fw-semibold fs-6 pt-3">
              
              {{-- Subtítulo da Página Dinâmico --}}
              @yield('page_subtitle')

            </span>
            </h1>
          </div>
        <div class="d-flex align-self-center flex-center flex-shrink-0">

            {{-- Botões de Ação Dinâmicos --}}
            @yield('toolbar_actions')

        </div>
        </div>
      </div>
    </div>
  </div>