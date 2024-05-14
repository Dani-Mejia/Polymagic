<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\homecontroller::class, 'index'])->name('home');

Route::get('login', [App\Http\Controllers\Auth\logincontroller::class, 'index'])->name('login');
Route::get('register', [App\Http\Controllers\Auth\registercontroller::class, 'index'])->name('registro');
Route::post('login', [App\Http\Controllers\Auth\logincontroller::class, 'login'])->name('login.ingresar');
Route::post('register', [App\Http\Controllers\Auth\registercontroller::class, 'store'])->name('registros.agregar');
Route::post('logout', [App\Http\Controllers\Auth\logoutcontroller::class, 'logout'])->name('logout');

// Ruta para mostrar el formulario de creación de productos
Route::get('/productos/crear', [App\Http\Controllers\produccontroller::class, 'index'])->name('productos.crear');

// Ruta para procesar el formulario y guardar el producto
Route::post('/productos/guardar', [App\Http\Controllers\produccontroller::class, 'store'])->name('productos.guardar');

// Ruta para eliminar un producto
Route::delete('/productos/{producto}', [App\Http\Controllers\produccontroller::class, 'destroy'])->name('productos.eliminar');

Route::get('/carrito', [App\Http\Controllers\cartcontroller::class, 'index'])->name('cart');
Route::post('/add-to-cart', [App\Http\Controllers\cartcontroller::class, 'addToCart'])->name('cart.add');
Route::post('/cart/less/{producto_id}', [App\Http\Controllers\cartcontroller::class, 'increment'])->name('cart.increment');
Route::post('/cart/plus/{producto_id}', [App\Http\Controllers\cartcontroller::class, 'decrement'])->name('cart.decrement');
Route::post('/cobrar', [App\Http\Controllers\cartcontroller::class, 'cobrar'])->name('cobrar');
Route::get('/pago/{token}/factura/{ern}', [App\Http\Controllers\cartcontroller::class, 'verificar'])->name('pagos.verificar');
Route::post('carrito/vaciar', [App\Http\Controllers\cartcontroller::class, 'destroy'])->name('carrito.vaciar');
Route::post('carrito/{producto_id}', [App\Http\Controllers\cartcontroller::class, 'update'])->name('carrito.eliminar');
