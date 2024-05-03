<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Polymagic</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<body>
    <div class="wrapper">
        <aside>
            <header>

                <img src="Imagenes/polymagic.png" alt="" class="logo">
            </header>
            <div class="search-container">
                <form action="/search" method="GET">
                    <input type="text" placeholder="Buscar..." name="q" id="search-input">
                </form>
            </div>
        </body>

            <nav>
                <ul class="menu">
                    <li>
                        <button id="todos" class="boton_menu boton_categoria active"><i class="bi bi-hand-index-thumb-fill"></i>Todos los productos</button>
                    </li>
                    <li>
                        <button id="aretes" class="boton_menu boton_categoria"><i class="bi bi-hand-index-thumb"></i>Aretes</button>
                    </li>
                    <li>
                        <button id="collares" class="boton_menu boton_categoria"><i class="bi bi-hand-index-thumb"></i>Collares</button>
                    </li>
                    <li>
                        <button id="pulseras" class="boton_menu boton_categoria"><i class="bi bi-hand-index-thumb"></i>Pulseras</button>
                    </li>
                    <li>
                        <button id="llaveros" class="boton_menu boton_categoria"><i class="bi bi-hand-index-thumb"></i>Llaveros</button>
                    </li>
                    <li>
                        <button id="anillos" class="boton_menu boton_categoria"><i class="bi bi-hand-index-thumb"></i>Anillos</button>
                    </li>
                    <li>
                        <button id="porta_mask" class="boton_menu boton_categoria"><i class="bi bi-hand-index-thumb"></i>Porta mascarillas</button>
                    </li>
                    <li>
                        <a class="boton_menu boton_carrito" href="carrito.html">
                            <i class="bi bi-cart-fill"></i>Carrito <span id="numerito" class="numerito">0</span>
                        </a>
                    </li>
                </ul>
            </nav>
            @if (Auth::check())
            <p>{{ Auth::user()->name }}</p>
            <form action="{{ route('logout') }}" method="POST" class="block">
                @csrf
                <button type="submit" class="w-full h-full p-4">
                    Cerrar Sesión
                </button>
            </form>
            @else
            <a href="{{route('login')}}">
                 ya tienes una cuenta
            </a>
            @endif
            <footer>
                <p class="texto-footer">© 2024 Polymagic</p>
            </footer>
        </aside>
        <main>
            <h2 class="Titulo_productos" id="titulo-principal">Todos los Productos</h2>
            <div id="contenedor_productos" class="Contenedor_productos">
                @foreach ($productos as $producto)
                <div class="producto">
                    <img class="imagen_producto" src="Imagenes/Collares/Collar de perlas con caritas feliz.jpeg" alt="Collar perlas Carita feliz">
                            <div class="producto_detalles">
                                <h3 class="titulo_producto">{{ $producto->titulo }}</h3>
                                <p class="precio producto">${{ $producto->precio }}</p>
                                <button class="Agregar_producto" id="{{ $producto->id }}">agregar</button>
                            </div>
                        
                </div>
                @endforeach
                
            </div>
                
        </main>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <!-- <script src="main.js"></script> -->
   
</body>
</html>