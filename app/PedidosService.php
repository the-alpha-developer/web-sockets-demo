<?php

namespace App;

use App\Events\PedidoCancelado;
use App\Events\PedidoConfirmado;
use App\Events\PedidoEntregado;
use App\Models\Pedido;

class PedidosService
{
    public function __construct(
        private Pedido $pedido,
    ) {
    }

    public function confirmar(): self
    {
        $this->pedido->status = PedidoStatus::Confirmado;
        $this->pedido->save();
        PedidoConfirmado::dispatch($this->pedido);

        return $this;
    }

    public function cancelar(): self
    {
        $this->pedido->status = PedidoStatus::Cancelado;
        $this->pedido->save();
        PedidoCancelado::dispatch($this->pedido);

        return $this;
    }

    public function entregar(): self
    {
        $this->pedido->status = PedidoStatus::Entregado;
        $this->pedido->save();
        PedidoEntregado::dispatch($this->pedido);

        return $this;
    }
}
