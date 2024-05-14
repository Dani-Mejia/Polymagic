<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Polymagic</title>
</head>
<body>
    <div class="wrapper">
        <aside>
            <header>

                <img src="Imagenes/polymagic.png" alt="" class="logo">
            </header>
            <nav>
                <ul class="menu">
                    <li>
                        <a class="boton_menu boton_carrito" href="{{ route('home') }}"> 
                            <i class="bi bi-arrow-return-left"></i>Volver
                        </a>
                    </li>
                   
                    <li>
                        <a class="boton_menu boton_carrito active " href="carrito.html"> 
                            <i class="bi bi-cart-fill"></i>Carrito <span class="Contador_Carrito"></span>
                        </a>
                    </li>
                </ul>

            </nav>
            <footer>
                <p class="texto-footer">© 2024 Polymagic</p>
            </footer>
        </aside>
        <main>
            
            <h2 class="Titulo_productos">Carrito</h2>
            <div class="Contenedor_carrito">
                
                @if(session('cart'))

                            @foreach(session('cart', []) as $item)
                            <div class="carrito_producto">
                            <img class="carrito-producto-imagen" src="{{ asset('Imagenes/productos/' . $item['imagen']) }}" alt="">
                            <div class="carrito_producto_titulo">
                                <small>titulo</small>
                                <h3>{{ $item['nombre'] }}</h3>
                            </div>
                            <div class="carrito_producto_cantidad">
                                <small>Cantidad</small>
                                <div>
                                    <form action="{{ route('cart.increment', $item['id']) }}" method="POST">
                                        @csrf
                                        <button class="btn-increment" type="submit">aumentar</button>
                                    </form>
                                    <div class="cantidad-producto">{{ $item['cantidad'] }}</div>
                                    <form action="{{ route('cart.decrement', $item['id']) }}" method="POST">
                                        @csrf
                                        <button class="btn-decrement" type="submit">disminuir</button>
                                    </form>
                                </div>
                            </div>
                            <div class="carrito_producto_precio">
                                <small>precio</small>
                                <p>${{ $item['precio_unitario'] }}</p>
                            </div>
                            <div class="carrito_producto_subtotal">
                                <small>Subtotal</small>
                                <p>${{ $item['cantidad'] * $item['precio_unitario'] }}</p>
                            </div>
                            <form action="{{ route('carrito.eliminar', $item['id']) }}" method="POST">
                                @csrf
                                <button class="carrito_producto_eliminar"><i class="bi bi-trash-fill"></i></button>
                            </form>
            </div>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p id="carrito-vacio" class="carrito_vacio">Tu carrito está vacío. <i class="bi bi-emoji-frown"></i></p>
                @endif
                <div id="carrito-productos" class="carrito_productos disabled">

                </div>

                @if(session('cart'))
                <div id="carrito-acciones" class="carrito_acciones">
                    <div class="carrito_acciones_izquierda">
                        <form action="{{ route('carrito.vaciar') }}" method="POST">
                            @csrf
                            <button type="submit" id="carrito-acciones-vaciar" class="carrito_acciones_vaciar">Vaciar Carrito</button>
                        </form>
                    </div>
                    <div class="carrito_acciones_derecha">
                        <div class="carrito_acciones_total">
                            <p>Total:</p>
                            <p id="total">$5.00</p>
                        </div>
                        <form action="{{ route('cobrar') }}" method="post">
                            @csrf
                            <button id="carrito-acciones-comprar" class="carrito_acciones_comprar">Comprar ahora</button>
                        </form>
                    </div>
                    @endif
                </div>
                
                <p id="carrito-comprado" class="carrito_comprado disabled">Muchas gracias por tu compra. <i class="bi bi-emoji-laughing"></i></p>
            </div>
                
        </main>
    </div>

    <script>
        // Obtener el elemento del total
        const total = document.getElementById('total');

        // Obtener los productos del carrito desde el backend
        const productosEnCarrito = @json(session('cart') ?: []);

        // Función para actualizar el total
        function actualizarTotal() {
            // Calcular el total
            const totalCalculado = productosEnCarrito.reduce((acc, producto) => acc + (producto.precio_unitario * producto.cantidad), 0);
            
            // Actualizar el texto del total
            total.innerText = `$${totalCalculado.toFixed(2)}`;
        }

        // Función para actualizar el subtotal y el total cuando cambia la cantidad
    document.querySelectorAll('.cantidad-producto').forEach(function(input) {
        input.addEventListener('input', function() {
            // Obtener el precio unitario
            var precioUnitario = parseFloat(this.closest('.carrito_producto').querySelector('.carrito_producto_precio p').textContent.replace('$', ''));

            // Calcular el nuevo subtotal
            var cantidad = parseFloat(this.value);
            var subtotal = cantidad * precioUnitario;

            // Actualizar el subtotal
            this.closest('.carrito_producto').querySelector('.carrito_producto_subtotal p').textContent = '$' + subtotal.toFixed(2);

            // Actualizar el total
            var subtotales = Array.from(document.querySelectorAll('.carrito_producto_subtotal p')).map(subtotal => parseFloat(subtotal.textContent.replace('$', '')));
            var total = subtotales.reduce((a, b) => a + b, 0);
            document.getElementById('total').textContent = '$' + total.toFixed(2);

             // Obtener el ID del producto
             var productoID = this.closest('.carrito_producto').dataset.id;

              // Actualizar la sesión del carrito
            var cart = JSON.parse(sessionStorage.getItem('cart'));
            var productoIndex = cart.findIndex(item => item.id === productoID);
            cart[productoIndex].cantidad = cantidad;
            sessionStorage.setItem('cart', JSON.stringify(cart));
        });
    });

    // Obtener todos los campos de cantidad
    const camposCantidad = document.querySelectorAll('.cantidad-producto');

    // Iterar sobre cada campo de cantidad
    camposCantidad.forEach(campo => {
        // Agregar un evento input a cada campo
        campo.addEventListener('input', function() {
            // Obtener el valor de la cantidad
            const nuevaCantidad = this.value;

            // Obtener la URL para enviar la solicitud AJAX
            const url = this.parentElement.action;

            // Obtener el token CSRF
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Obtener el método de la solicitud
            const method = 'PUT';

            // Configurar los datos a enviar
            const data = new FormData();
            data.append('_token', token);
            data.append('_method', method);
            data.append('cantidad', nuevaCantidad);

            // Configurar la solicitud AJAX
            const xhr = new XMLHttpRequest();
            xhr.open(method, url, true);
            xhr.setRequestHeader('X-CSRF-Token', token);

            // Enviar la solicitud con los datos
            xhr.send(data);
        });
    });

    // Agrega este código en el script en tu vista cart.blade.php

    document.querySelectorAll('.cantidad-producto').forEach(input => {
    input.addEventListener('change', function() {
        const productId = this.getAttribute('data-product-id');
        const newQuantity = parseInt(this.value);

        fetch(`/cart/${productId}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                cantidad: newQuantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualizar subtotal y total en la vista si es necesario
            } else {
                console.error(data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

        // Llamar a la función para actualizar el total inicialmente
        actualizarTotal();



    </script>
    <!-- <script src="carrito.js"></script> -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>