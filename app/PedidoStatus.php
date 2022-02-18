<?php

namespace App;

enum PedidoStatus: string
{
    case Pendiente = 'pendiente';
    case Confirmado = 'confirmado';
    case Cancelado = 'cancelado';
    case Entregado = 'entregado';
}
