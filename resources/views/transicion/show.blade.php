<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transicion') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Pedido {{$pedido->id}} estado {{$pedido->status->value}}
                </div>
                <form method="POST" action="{{route("transicion.store", compact('pedido'))}}">
                    @csrf
                    <select name="status">
                        @foreach (App\PedidoStatus::cases() as $status)
                            @if ($status != $pedido->status && $status != App\PedidoStatus::Pendiente)
                                <option value="{{$status->value}}">{{$status->value}}</option>
                            @endif
                        @endforeach
                    </select>
                    <button type="submit">Grabar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
