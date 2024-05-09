<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class homecontroller extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $productos = Producto::all();
        return view('index', compact('productos', 'cart'));
    }
}
