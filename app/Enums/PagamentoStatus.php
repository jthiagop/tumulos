<?php

namespace App\Enums;

enum PagamentoStatus: string
{
    case PENDENTE = 'Pendente';
    case PAGO = 'Pago';
    case ATRASADO = 'Atrasado';
    case CANCELADO = 'Cancelado';
}
