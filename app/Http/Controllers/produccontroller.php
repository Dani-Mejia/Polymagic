<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class produccontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        $productos = Producto::all();
        return view('productos.crear', compact('productos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ajusta los formatos y el tamaño según tus necesidades
            'precio' => 'required|numeric|min:0',
        ]);

        // Guardar el producto en la base de datos
        $producto = new Producto();
        $producto->titulo = $request->titulo;

        // Procesar la imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombre_imagen = time().'.'.$imagen->getClientOriginalExtension();
            $ruta_imagen = public_path('Imagenes/productos');
            $imagen->move($ruta_imagen, $nombre_imagen);
            $producto->imagen = $nombre_imagen;
        }

        $producto->precio = $request->precio;
        $producto->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('productos.crear')->with('success', 'Producto agregado correctamente.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
