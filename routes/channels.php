<?php

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('pedidos.{pedido}', function (User $user, Pedido $pedido) {
    return $user->can('view', $pedido);
});

Broadcast::channel('pedidos', function (User $user) {
    return $user->can('viewAny', Pedido::class);
});
