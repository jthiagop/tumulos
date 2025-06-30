         <div class="modal fade" id="kt_modal_editar_pagamento" tabindex="-1" aria-hidden="true">
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
                         <form class="form" action="{{ route('pagamentos.store') }}" method="POST">
                             @csrf
                             <!--begin::Heading-->
                             <div class="mb-13 text-center">
                                 <!--begin::Title-->
                                 <h1 class="mb-3">Registrar Novo Pagamento</h1>
                                 <!--end::Title-->
                                 <!--begin::Description-->
                                 <div class="text-muted fw-semibold fs-5">Registrar Novo Pagamento

                                 </div>
                                 <!--end::Description-->
                             </div>
                             <!--end::Heading-->
                             <!--begin::Input group-->
                             <div class="fv-row mb-7">
                                 <!--begin::Label-->
                                 <label class="required fs-6 fw-semibold mb-2">Descrição</label>
                                 <!--end::Label-->
                                 <!--begin::Input-->
                                 <input type="text" class="form-control form-control-solid" name="descricao"
                                     value="{{ old('descricao') }}" placeholder="Taxa de Manutenção Anual - 2025"
                                     required />
                                 <!--end::Input-->
                             </div>
                             <!--end::Input group-->
                             <!--begin::Input group-->
                             <div class="d-flex flex-column mb-7 fv-row">
                                 <!--begin::Label-->
                                 <label class="fs-6 fw-semibold mb-2">
                                     <span class="required">Túmulo</span>
                                     <span class="ms-1" data-bs-toggle="tooltip"
                                         title="A escolha do túmulo é obrigatório!">
                                         <i class="ki-outline ki-information fs-7"></i>
                                     </span>
                                 </label>
                                 <!--end::Label-->
                                 <!--begin::Input-->
                                 <select id="tumulo_id" name="tumulo_id" required data-control="select2"
                                     data-placeholder="Selecione o túmulo..."
                                     data-dropdown-parent="#kt_modal_add_customer"
                                     class="form-select form-select-solid fw-bold">
                                     <option value=""></option>
                                     @foreach ($tumulos as $tumulo)
                                         <option value="{{ $tumulo->id }}">
                                             {{ $tumulo->codigo }} -
                                             {{ $tumulo->localizacao_detalhada ?? 'Sem detalhes' }}
                                         </option>
                                     @endforeach
                                 </select> <!-- Tag de fechamento adicionada aqui -->
                                 <!--end::Input--> <!-- Comentário movido para fora do loop -->
                             </div>
                             <!--end::Input group-->
                             <!--begin::Input group-->
                             <div class="row g-9 mb-8">
                                 <!--begin::Col-->
                                 <div class="col-md-6 fv-row">
                                     <label class="required fs-6 fw-semibold mb-2">Valor (R$)</label>
                                     <!-- Hidden input for database format -->
                                     <input type="hidden" name="valor" id="valor" value="{{ old('valor') }}">

                                     <!-- Visible input with mask -->
                                     <input type="text" class="form-control form-control-solid money-mask"
                                         placeholder="R$ 0,00" name="valor" id="valor_input"
                                         value="{{ old('valor') }}"
                                         data-inputmask="'alias': 'currency', 'prefix': 'R$ ', 'groupSeparator': '.', 'radixPoint': ',', 'digits': 2, 'autoGroup': true, 'numericInput': true" />

                                     @error('valor')
                                         <div class="fv-plugins-message-container invalid-feedback fs-7">
                                             {{ $message }}
                                         </div>
                                     @enderror
                                 </div>
                                 <!--end::Col-->

                                 <script>
                                     document.addEventListener('DOMContentLoaded', function() {
                                         // Initialize input mask
                                         Inputmask().mask(document.querySelector('.money-mask'));

                                         // Before form submission, convert to database format
                                         document.querySelector('form').addEventListener('submit', function(e) {
                                             const inputValue = document.getElementById('valor_input').value;

                                             // Remove R$ prefix, thousands separators, and convert comma to decimal point
                                             const dbValue = inputValue.replace('R$ ', '')
                                                 .replace(/\./g, '')
                                                 .replace(',', '.');

                                             // Set the hidden field value
                                             document.getElementById('valor_db').value = dbValue;

                                             // Optional: You can also replace the original input value if needed
                                             // document.getElementById('valor_input').value = dbValue;
                                         });
                                     });
                                 </script>
                                 <!--end::Col-->
                                 <div class="col-md-6 fv-row">
                                     <label class="required fs-6 fw-semibold mb-2">Data Vencimento</label>
                                     <div class="position-relative d-flex align-items-center">
                                         <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                                         <input class="form-control form-control-solid ps-12 modal-datepicker"
                                             placeholder="Select a date" name="data_vencimento" />
                                         @error('data_vencimento')
                                             <div class="fv-plugins-message-container invalid-feedback fs-7">
                                                 {{ $message }}
                                             </div>
                                         @enderror
                                     </div>
                                 </div>
                             </div>
                             <!--end::Input group-->
                             <!--begin::Input group-->
                             <div class="row g-9 mb-8">
                                 <!--begin::Col-->
                                 <div class="col-md-6 mb-3">
                                     <label for="status" class="form-label required">Status</label>
                                     <select id="status" name="status" class="form-select" required>
                                         @foreach (\App\Enums\PagamentoStatus::cases() as $status)
                                             <option value="{{ $status->value }}" @selected(old('status', $pagamento->status->value) == $status->value)>
                                                 {{ $status->value }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>

                                 <div class="col-md-6 mb-3">
                                     <label for="data_pagamento" class="form-label">Data do Pagamento</label>
                                     <input class="form-control" type="text" id="data_pagamento"
                                         name="data_pagamento"
                                         value="{{ old('data_pagamento', $pagamento->data_pagamento?->format('Y-m-d')) }}">
                                     <div class="form-text">Deixe em branco se o pagamento ainda estiver pendente.</div>
                                 </div>
                             </div>
                             <!--begin::Actions-->
                             <div class="text-center mt-6">
                                 <button type="reset" id="kt_modal_new_target_cancel"
                                     class="btn btn-light me-3">Cancel</button>
                                 <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                     <span class="indicator-label">Submit</span>
                                     <span class="indicator-progress">Please wait...
                                         <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
