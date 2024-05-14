<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Lib\Services\Pagadito;

require_once(__DIR__. '../../../services/config.php');
require_once(__DIR__. '../../../services/lib/Pagadito.php');

class cartcontroller extends Pagadito
{
    protected $pagadito;

    public function __construct()
    {
        $this->pagadito = new Pagadito(UID, WSK);
        
        if (SANDBOX) {
            $this->pagadito->mode_sandbox_on();
        }
    }

    public function index()
    {
        return view('cart');
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Producto::findOrFail($productId);

        $cart = session()->get('cart', []);

        // Verificar si el producto ya está en el carrito
        $productIndex = array_search($productId, array_column($cart, 'id'));

        if ($productIndex !== false) {
            // Si el producto ya está en el carrito, aumentamos la cantidad
            $cart[$productIndex]['cantidad']++;
        } else {
            // Si no está en el carrito, lo agregamos
            $cart[] = [
                'id' => $productId,
                'nombre' => $product->titulo,
                'imagen' => $product->imagen,
                'cantidad' => 1,
                'precio_unitario' => $product->precio
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('home')->with('success', 'Producto agregado al carrito');
    }

    public function update(Request $request, $producto_id)
    {
        $carrito = session()->get('cart', []);

        $indiceProducto = array_search($producto_id, array_column($carrito, 'id'));

        if ($indiceProducto !== false) {
            unset($carrito[$indiceProducto]);
            session()->put('cart', $carrito);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito');


    }

    public function increment(Request $request, $producto_id)
{
    $carrito = session()->get('cart', []);

    if (!empty($carrito)) {
        $indiceProducto = array_search($producto_id, array_column($carrito, 'id'));

        if ($indiceProducto !== false) {
            // Actualizar la cantidad del producto
            $carrito[$indiceProducto]['cantidad'] +=1;
            session()->put('cart', $carrito);
        }
    }

    return redirect()->back();
}

public function decrement(Request $request, $producto_id)
{
    $carrito = session()->get('cart', []);

    if (!empty($carrito)) {
        $indiceProducto = array_search($producto_id, array_column($carrito, 'id'));

        if ($indiceProducto !== false) {
            // Actualizar la cantidad del producto
            $carrito[$indiceProducto]['cantidad'] -=1;
            if ($carrito[$indiceProducto]['cantidad'] <= 0) {
                $carrito[$indiceProducto]['cantidad'] =1;
            }
            session()->put('cart', $carrito);
        }

    }

    return redirect()->back();
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'El carrito se ha vaciado correctamente');
    }

    public function cobrar()
    {
        $carrito = session()->get('cart', []);

        // Cuando este la tabla de Factura guardar la factura primero
        $fecha = date("Ymd");
        $numeroAleatorio = rand(1000, 9999);
        $ern = "POLLYMAGIC_" . $numeroAleatorio . "_" . $fecha . "";

        if($this->pagadito->connect()) {
            foreach ($carrito as $item) {
                $this->pagadito->add_detail($item['cantidad'], $item['nombre'], $item['precio_unitario']);
            }

            if (!$this->pagadito->exec_trans($ern)) {
                return "ERROR:" . $this->pagadito->get_rs_code() . ": " . $this->pagadito->get_rs_message();
            }
        } else {
            return "ERROR:" . $this->pagadito->get_rs_code() . ": " . $this->pagadito->get_rs_message();
        }
    }

    public function verificar(Request $request, $token, $ern)
    {
        if($this->pagadito->connect()) {
            if ($this->pagadito->get_status($token)) {
                $estado = $this->pagadito->get_rs_status();
                if ($estado == "COMPLETED") {
                    // $compra = compras::where('factura_nombre', $ern)->first();
                    // if ($compra) {
                    //     $compra->update(['estado' => 'COMPLETADO']);
                    // }
                    return view('pago', compact('estado'));
                } else {
                    // Si el estado es distinto
                }
            } else {
                echo "ERROR:" . $this->pagadito->get_rs_code() . ": " . $this->pagadito->get_rs_message() . "\n";
            }
        } else {
            echo "ERROR:" . $this->pagadito->get_rs_code() . ": " . $this->pagadito->get_rs_message() . "\n";
        }
    }
}
