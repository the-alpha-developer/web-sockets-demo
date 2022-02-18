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
                    <a href="{{route('pedidos.create')}}">Crear Pedido</a>
                    <h3>Actividad</h3>
                    <div id="logs">
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
                    document.getElementById("logs").innerHTML += `<p>Pedido ${e.pedido.id} se movio a ${e.pedido.status}</p>`
                }
                Echo.private(`pedidos`)
                    .listen('PedidoEntregado', callback)
                    .listen('PedidoCancelado', callback)
                    .listen('PedidoConfirmado', callback)
                ;
            }
        }
    </script>
    @endpush
</x-app-layout>
