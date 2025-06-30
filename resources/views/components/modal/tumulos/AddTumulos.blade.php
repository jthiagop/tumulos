  <!--begin::Modal - New Target-->
  <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
      <!--begin::Modal dialog-->
      <div class="modal-dialog modal-dialog-centered mw-650px">
          <!--begin::Modal content-->
          <div class="modal-content rounded">
              <!--begin::Modal header-->
              <div class="modal-header pb-0 border-0 justify-content-end">
                  <!--begin::Close-->
                  <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                      <i class="ki-outline ki-cross fs-1"></i>
                  </div>
                  <!--end::Close-->
              </div>
              <!--begin::Modal header-->
              <!--begin::Modal body-->
              <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                  <!--begin:Form-->
                  <form id="kt_modal_new_target_form" class="form" action="{{ route('tumulos.store') }}"
                      method="POST">
                      @csrf
                      <!--begin::Heading-->
                      <div class="mb-13 text-center">
                          <!--begin::Title-->
                          <h1 class="mb-3">Cadastro de Tumulos</h1>
                          <!--end::Title-->
                      </div>
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
                              <input type="text" class="form-control form-control-solid" placeholder="AGB-34A"
                                  name="codigo" />
                              <x-input-error :messages="$errors->get('codigo')" class="mt-2" />

                          </div>
                      </div>
                      <!--end::Input group-->
                      <!--begin::Input group-->
                      <div class="row g-9 mb-8">
                          <!--begin::Col-->
                          <div class="col-md-4 fv-row">
                              <label class=" fs-6 fw-semibold mb-2">Status</label>
                              <select class="form-select form-select-solid" data-control="select2"
                                  data-hide-search="true" data-placeholder="Qual o status?" name="status">
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
                              <input type="text" class="form-control form-control-solid" placeholder="3B"
                                  name="quadra" />
                              <x-input-error :messages="$errors->get('quadra')" class="mt-2" />

                          </div>
                          <!--end::Col-->
                          <!--begin::Col-->
                          <div class="col-md-4 fv-row">
                              <label class=" fs-6 fw-semibold mb-2">Número</label>
                              <input type="number" class="form-control form-control-solid" placeholder="34"
                                  name="numero" />
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
                                  <span class="">Tags</span>
                                  <span class="ms-1" data-bs-toggle="tooltip"
                                      title="Adicione tags para melhor organização">
                                      <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                  </span>

                              </label>
                              <!--end::Label-->
                              <input class="" value="Família, Frade" name="tags" />
                              <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                          </div>
                          <!--end::Input group-->
                          <!--begin::Col-->
                          <div class="col-md-4 fv-row">
                              <label class="fs-6 fw-semibold mb-2">Tipo do Túmulo</label>
                              <select class="form-select form-select-solid" data-control="select2"
                                  data-hide-search="true" data-placeholder="Qual o Tipo?" name="tipo">
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
                          <button type="reset" id="kt_modal_new_target_cancel"
                              class="btn btn-light me-3">Cancel</button>
                          <button type="submit" class="btn btn-primary">
                              <span>Submit</span>
                          </button>
                      </div>
                      <!--end::Actions-->
                  </form>
                  <!--end:Form-->
              </div>
              <!--end::Modal body-->
          </div>
          <!--end::Modal content-->
      </div>
      <!--end::Modal dialog-->
  </div>
  <!--end::Modal - New Target-->
