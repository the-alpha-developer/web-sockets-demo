<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\PedidoStatus;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Pedido::class);

        $total = Pedido::whereStatus(PedidoStatus::Entregado)->count();

        return view('pedidos.index', compact('total'));
    }

    public function create()
    {
        $this->authorize('create', Pedido::class);

        return view('pedidos.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Pedido::class);

        $pedido = new Pedido();
        $pedido->status = PedidoStatus::Pendiente;
        $pedido->user_id = $request->user()->id;
        $pedido->save();

        return to_route('pedidos.show', compact('pedido'));
    }

    public function show(Pedido $pedido)
    {
        $this->authorize('view', $pedido);

        return view('pedidos.show', compact('pedido'));
    }
}
