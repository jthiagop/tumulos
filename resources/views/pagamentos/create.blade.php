<x-app-layout>
    {{-- Cabeçalho da Página --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Novo Pagamento') }}
        </h2>
    </x-slot>

    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- O formulário aponta para a rota 'pagamentos.store' que criamos --}}
        <form class="form" action="{{ route('pagamentos.store') }}" method="POST">
            @csrf
            <div class="row">
                {{-- Coluna Principal --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Detalhes da Cobrança</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="tumulo_id" class="form-label required">Túmulo</label>
                                    {{-- Usamos o plugin Select2 para um campo de busca amigável --}}
                                    <select id="tumulo_id" name="tumulo_id" class="form-select select2" data-placeholder="Selecione um túmulo" required>
                                        <option></option>
                                        @foreach ($tumulos as $tumulo)
                                            <option value="{{ $tumulo->id }}" {{ old('tumulo_id') == $tumulo->id ? 'selected' : '' }}>
                                                {{ $tumulo->codigo }} - {{ $tumulo->localizacao_detalhada ?? 'Sem detalhes' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tumulo_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="descricao" class="form-label required">Descrição</label>
                                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Ex: Taxa de Manutenção Anual 2025" value="{{ old('descricao') }}" required>
                                    @error('descricao')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="valor" class="form-label required">Valor (R$)</label>
                                    <input type="text" class="form-control" id="valor" name="valor" placeholder="0,00" value="{{ old('valor') }}" required>
                                    @error('valor')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="data_vencimento" class="form-label required">Data de Vencimento</label>
                                    <input class="form-control" type="text" id="data_vencimento" name="data_vencimento" placeholder="DD/MM/AAAA" value="{{ old('data_vencimento') }}" required>
                                    @error('data_vencimento')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">Salvar Pagamento</button>
                                <a href="{{ route('pagamentos.index') }}" class="btn btn-label-secondary">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Scripts específicos para esta página --}}
    @push('scripts')
        <script>
            // Inicializa o Select2 para o campo de túmulos
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: $(this).data('placeholder')
                });

                // Inicializa o Flatpickr para o campo de data de vencimento
                $('#data_vencimento').flatpickr({
                    altInput: true,
                    altFormat: "d/m/Y",
                    dateFormat: "Y-m-d",
                });

                // Opcional: Adicionar uma máscara para o campo de valor
                // Certifique-se de que a biblioteca InputMask esteja carregada
                if (typeof Inputmask !== 'undefined') {
                    Inputmask('decimal', {
                        'alias': 'numeric',
                        'groupSeparator': '.',
                        'radixPoint': ',',
                        'autoGroup': true,
                        'digits': 2,
                        'digitsOptional': false,
                        'prefix': 'R$ ',
                        'placeholder': '0',
                        'rightAlign': false
                    }).mask(document.getElementById('valor'));
                }
            });
        </script>
    @endpush

</x-app-layout>