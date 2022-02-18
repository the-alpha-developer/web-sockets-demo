<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{route('pedidos.index')}}">Ir al Indice</a>
                    <div>
                        Pedido {{$pedido->id}} estado <span id="status">{{$pedido->status->value}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script defer>
        document.onreadystatechange = function () {
            if (document.readyState === 'complete') {
                var callback = function (e) {
                    console.log(e);
                    document.getElementById("status").innerHTML = e.pedido.status
                }
                Echo.private(`pedidos.{{$pedido->id}}`)
                    .listen('PedidoEntregado', callback)
                    .listen('PedidoCancelado', callback)
                    .listen('PedidoConfirmado', callback)
                ;
            }
        }
    </script>
    @endpush
</x-app-layout>
