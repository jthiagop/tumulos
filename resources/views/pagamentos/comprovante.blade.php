<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovante de Pagamento - #{{ $pagamento->id }}</title>
    {{-- Estilo simples para impressão. Pode ser melhorado ou usar um CSS próprio. --}}
    <style>
        body { font-family: sans-serif; margin: 40px; }
        .comprovante { border: 1px solid #ccc; padding: 20px; max-width: 800px; margin: auto; }
        .cabecalho { text-align: center; border-bottom: 1px solid #ccc; padding-bottom: 15px; margin-bottom: 20px; }
        .cabecalho h1 { margin: 0; }
        .cabecalho p { margin: 5px 0 0; color: #555; }
        .detalhes-tabela { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .detalhes-tabela th, .detalhes-tabela td { border: 1px solid #eee; padding: 12px; text-align: left; }
        .detalhes-tabela th { background-color: #f8f8f8; width: 30%; }
        .total { text-align: right; margin-top: 30px; font-size: 1.2em; font-weight: bold; }
        .rodape { text-align: center; margin-top: 40px; font-size: 0.9em; color: #777; }
    </style>
</head>
<body>

    <div class="comprovante">
        <div class="cabecalho">
            <h1>Comprovante de Pagamento</h1>
            <p>ID da Transação: #{{ $pagamento->id }}</p>
        </div>

        <h3>Detalhes do Pagamento</h3>
        <table class="detalhes-tabela">
            <tr>
                <th>Data do Pagamento</th>
                <td>{{ $pagamento->data_pagamento ? $pagamento->data_pagamento->format('d/m/Y') : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $pagamento->status->value }}</td>
            </tr>
            <tr>
                <th>Descrição</th>
                <td>{{ $pagamento->descricao }}</td>
            </tr>
            <tr>
                <th>Valor Pago</th>
                <td><strong>R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</strong></td>
            </tr>
        </table>

        <h3>Referente ao Contrato/Túmulo</h3>
        <table class="detalhes-tabela">
            <tr>
                <th>Código do Túmulo</th>
                <td>{{ $pagamento->tumulo->codigo ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Localização</th>
                <td>{{ $pagamento->tumulo->localizacao_detalhada ?? 'Não informado' }}</td>
            </tr>
        </table>
        
        <div class="total">
            Total Pago: R$ {{ number_format($pagamento->valor, 2, ',', '.') }}
        </div>

        <div class="rodape">
            <p>Comprovante gerado em: {{ now()->format('d/m/Y H:i:s') }}</p>
            <p><strong>{{ config('app.surname', 'Sistema de Gestão') }}</strong></p>
        </div>
    </div>

    {{-- Este script aciona a janela de impressão assim que a página carrega --}}
    <script>
        window.onload = function() {
            window.print();
        }
    </script>

</body>
</html>