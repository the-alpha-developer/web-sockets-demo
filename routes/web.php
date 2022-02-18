<?php

use App\Http\Controllers\PedidosController;
use App\Http\Controllers\TransicionPedidoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::controller(PedidosController::class)->middleware(['auth'])->group(function () {
    Route::get('/pedidos', 'index')->name('pedidos.index');
    Route::get('/pedidos/create', 'create')->name('pedidos.create');
    Route::get('/pedidos/{pedido}', 'show')->name('pedidos.show');
    Route::post('/pedidos', 'store')->name('pedidos.store');
});
Route::controller(TransicionPedidoController::class)->middleware(['auth'])->group(function () {
    Route::get('/transicion/{pedido}', 'show')->name('transicion.show');
    Route::post('/transicion/{pedido}', 'store')->name('transicion.store');
});

require __DIR__.'/auth.php';
