<div class="modal fade" id="kt_modal_pagamento" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            {{-- O action e method serão definidos dinamicamente via JS --}}
            <form id="pagamento_form" class="form" action="" method="POST">
                @csrf
                {{-- O método PUT/PATCH para edição será injetado aqui via JS --}}
                <div id="form_method_field"></div>

                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3" id="modal_title">Registrar Novo Pagamento</h1>
                        <div class="text-muted fw-semibold fs-5" id="modal_description">Preencha os dados do novo
                            pagamento.</div>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Descrição</label>
                        <input type="text" id="descricao" class="form-control form-control-solid" name="descricao"
                            placeholder="Taxa de Manutenção Anual - 2025" required />
                    </div>

                    <div class="d-flex flex-column mb-7 fv-row">
                        <label class="fs-6 fw-semibold mb-2"><span class="required">Túmulo</span></label>
                        <select id="tumulo_id" name="tumulo_id" required data-control="select2"
                            data-placeholder="Selecione o túmulo..." data-dropdown-parent="#kt_modal_pagamento"
                            class="form-select form-select-solid fw-bold">
                            <option value=""></option>
                            @foreach ($tumulos as $tumulo)
                                <option value="{{ $tumulo->id }}">{{ $tumulo->codigo }} -
                                    {{ $tumulo->localizacao_detalhada ?? 'Sem detalhes' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Valor (R$)</label>
                            <input type="text" id="valor" class="form-control form-control-solid"
                                placeholder="R$ 0,00" name="valor" required
                                data-inputmask-value="{{ isset($model) ? number_format($model->valor, 2, ',', '.') : '' }}" />
                                
                            <script>
                                $('#kt_modal_pagamento').on('shown.bs.modal', function() {
                                    // Valor do banco de dados (exemplo: 450.00)
                                    const valorDoBanco = 450.00;

                                    // Formata como "450,00" (sem o "R$")
                                    const valorFormatado = valorDoBanco.toFixed(2).replace('.', ',');

                                    // Define o valor no campo
                                    $('#valor').val(valorFormatado);

                                    // Aplica a máscara
                                    $('#valor').inputmask('currency', {
                                        prefix: 'R$ ',
                                        groupSeparator: '.',
                                        radixPoint: ',',
                                        digits: 2,
                                        autoGroup: true,
                                        rightAlign: false
                                    });
                                });
                            </script>
                            @error('valor')
                                <div class="fv-plugins-message-container invalid-feedback fs-7">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Data Vencimento</label>
                            <div class="position-relative d-flex align-items-center">
                                <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                                <input id="data_vencimento"
                                    class="form-control form-control-solid ps-12 modal-datepicker"
                                    placeholder="Selecione uma data" name="data_vencimento" />
                            </div>
                        </div>
                    </div>

                    <div id="campos_edicao" class="row g-9 mb-8" style="display: none;">
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label required">Status</label>
                            <select id="status" name="status" class="form-select form-select-solid"
                                data-control="select2" data-hide-search="true"
                                data-dropdown-parent="#kt_modal_pagamento">
                                @foreach (\App\Enums\PagamentoStatus::cases() as $status)
                                    <option value="{{ $status->value }}">{{ $status->value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="data_pagamento" class="form-label">Data do Pagamento</label>
                            <input class="form-control form-control-solid modal-datepicker" type="text"
                                id="data_pagamento" name="data_pagamento">
                            <div class="form-text">Deixe em branco se o pagamento ainda estiver pendente.</div>
                        </div>
                    </div>
                    <div class="text-center mt-6">
                        <button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Salvar</span>
                            <span class="indicator-progress">Aguarde...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
