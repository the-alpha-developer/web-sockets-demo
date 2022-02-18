<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\PedidosService;
use App\PedidoStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class TransicionPedidoController extends Controller
{
    public function show(Pedido $pedido)
    {
        return view('transicion.show', compact('pedido'));
    }

    public function store(Pedido $pedido, Request $request)
    {
        $service = new PedidosService($pedido);
        $data = $request->validate(['status' => [
            'required',
            new Enum(PedidoStatus::class),
        ]]);

        match (PedidoStatus::from($data['status'])) {
            PedidoStatus::Confirmado => $service->confirmar(),
            PedidoStatus::Cancelado => $service->cancelar(),
            PedidoStatus::Entregado => $service->entregar(),
            default => abort(400),
        };

        return to_route("transicion.show", compact('pedido'));
    }
}
