<?php

namespace App\Models;

use App\PedidoStatus;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $casts = [
        'status' => PedidoStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
