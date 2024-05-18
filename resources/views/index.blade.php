<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Polymagic</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        .logo {
    font-weight: 400;
    font-size: 1.3rem;
    }

   /*** GLOBAL STYLES ***/

:root {
    --card-width: 14rem;
    --card-height: 20rem;
}

.Contenedor_productos {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: center; /* Centra las tarjetas en la línea */
}

.card-producto {
    flex: 1 1 var(--card-width); /* Permite que las tarjetas se redimensionen */
    max-width: var(--card-width);
    box-sizing: border-box; /* Asegura que el padding se incluya en el tamaño total */
}

.imagen_producto {
    width: 100%;
    height: 15rem; /* Ajusta este valor para mantener la proporción de la imagen */
    object-fit: cover;
    border-radius: 1rem;
}

/*** MEDIA QUERIES ***/

@media screen and (max-width: 850px) {
    :root {
        --card-width: 12rem;
    }
}

@media screen and (max-width: 675px) {
    :root {
        --card-width: 10rem;
    }
}

@media screen and (max-width: 600px) {
    .wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    aside {
        position: fixed;
        z-index: 9;
        background: rgba(189, 228, 220, 1);
        left: 0;
        box-shadow: 0 0 0 100vmax rgba(0, 0, 0, 0.75);
        transform: translateX(-100%);
        opacity: 0;
        visibility: hidden;
        transition: .2s;
    }

    aside.aside-visible {
        transform: translateX(0);
        opacity: 1;
        visibility: visible;
    }

    main {
        margin: 1rem;
        margin-top: 0;
        padding: 1rem;
    }

    :root {
        --card-width: 8rem;
    }

    .header-mobile {
        display: flex;
        padding: 1rem;
        justify-content: space-between;
        align-items: center;
    }

    .header-mobile .logo {
        color: #f79aa4;
    }

    .open-menu,
    .close-menu {
        background-color: transparent;
        color: white;
        border: 0;
        font-size: 2rem;
        cursor: pointer;
    }

    .close-menu {
        display: block;
        position: absolute;
        top: 1rem;
        right: 1rem;
    }

    .carrito_producto {
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: flex-start;
        padding: .5rem;
    }

    .carrito_producto_subtotal {
        display: none;
    }

    .carrito_acciones {
        flex-wrap: wrap;
        row-gap: 1rem;
    }
}

@media screen and (max-width: 400px) {
    :root {
        --card-width: 100%;
    }
}
    </style>
</head>
<body>
    <div class="wrapper">
            <header class="header-mobile">
                    <h1 class="logo"></h1>
                    <button class="open-menu" id="open-menu">
                        <i class="bi bi-list"></i>
                    </button>
                </header>
            <aside>
            <button class="close-menu" id="close-menu">
                <i class="bi bi-x"></i>
            </button>
            <header>
                <img src="Imagenes/polymagic.png" alt="" class="logo">
            </header>
            <div class="search-container">
                    <input type="text" placeholder="Buscar..." name="q" id="search-input">
            </div>
        </body>

            <nav>
                <ul class="menu">
                    <li>
                        <button id="todos" class="boton_menu boton_categoria active"><i class="bi bi-hand-index-thumb-fill"></i>Todos los productos</button>
                    </li>
                    <li>
                        <button id="Aretes" class="boton_menu boton_categoria"><i class="bi bi-hand-index-thumb"></i>Aretes</button>
                    </li>
                    <li>
                        <button id="Collares" class="boton_menu boton_categoria"><i class="bi bi-hand-index-thumb"></i>Collares</button>
                    </li>
                    <li>
                        <button id="Pulseras" class="boton_menu boton_categoria"><i class="bi bi-hand-index-thumb"></i>Pulseras</button>
                    </li>
                    <li>
                        <button id="Llaveros" class="boton_menu boton_categoria"><i class="bi bi-hand-index-thumb"></i>Llaveros</button>
                    </li>
                    <li>
                        <button id="Anillos" class="boton_menu boton_categoria"><i class="bi bi-hand-index-thumb"></i>Anillos</button>
                    </li>
                    <li>
                        <button id="Porta mascarillas" class="boton_menu boton_categoria"><i class="bi bi-hand-index-thumb"></i>Porta mascarillas</button>
                    </li>
                    <li>
                        <a class="boton_menu boton_carrito" href="{{ route('cart') }}">
                            <i class="bi bi-cart-fill"></i>Carrito <span id="numerito" class="numerito">
                                @php
                                    $totalProductos = 0;
                                    foreach ($cart as $producto) {
                                        $totalProductos += $producto['cantidad'];
                                    }
                                    echo $totalProductos;
                                @endphp
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
            @if (Auth::check())
            <p class="User">{{ Auth::user()->name }}</p>



            <form action="{{ route('logout') }}" method="POST" class="block">
                @csrf
                <button type="submit" class="cerrar-sesion">
                    Cerrar Sesión
                </button>
            </form>
            @else
            <a class="cuentaE" href="{{route('login')}}">
                 Ya tienes una cuenta
            </a>
            @endif
            <footer>
                <p class="texto-footer">© 2024 Pollymagic</p>
            </footer>
        </aside>
        <main>
            <style>
                .Encabezado {
    display: flex; /* Utilizar flexbox */
    justify-content: space-between; /* Espacio entre los elementos */
    align-items: center; /* Alinear verticalmente al centro */
    margin-bottom: 2rem;
}

.Titulo_productos {
    margin: 0; /* Eliminar el margen del título */
}

.Boton_derecha {
    margin-left: auto; /* Empujar el botón hacia la derecha */
}

.administrar-producto {
    padding: 5px 10px; /* Ajusta el padding según sea necesario */
    background-color: #db8fee; /* Color de fondo del botón */
    color: white; /* Color del texto del botón */
    text-decoration: none; /* Elimina el subrayado del enlace */
    border-radius: 5px; /* Borde redondeado */
}

.administrar-producto:hover {
    background-color: #9c30ba; /* Color de fondo del botón al pasar el mouse */
}
            </style>
        <div class="Encabezado" >
    <h2 class="Titulo_productos" id="titulo-principal">Todos los Productos</h2>
    <div class="Boton_derecha">
    @if (Auth::check() && Auth::user()->name === 'Admin')
            <a href="{{ route('productos.crear') }}" class="administrar-producto">
                Administrar productos
            </a>
        @endif
    </div>
</div>
            <div id="contenedor_productos" class="Contenedor_productos">
                @foreach ($productos as $producto)                <div class="producto card-producto" data-categoria="{{ $producto->categoria->nombre }}">
                    <img class="imagen_producto" src="{{ asset('Imagenes/productos/' . $producto->imagen) }}" alt="Collar perlas Carita feliz">
                            <div class="producto_detalles">
                                <h3 class="titulo_producto" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $producto->titulo }}">{{ $producto->titulo }}</h3>
                                <p class="precio producto">${{ $producto->precio }}</p>
                                <form class="producto_detalles" action="{{ route('cart.add') }}" method="POST" style="margin-top: 0rem;">
                                    @csrf
                                    <input type="hidden" name="product_imagen" value="{{ asset('Imagenes/productos/' . $producto->imagen) }}">
                                    <input type="hidden" name="product_id" value="{{ $producto->id }}"> <!-- Aquí puedes poner el ID del producto -->
                                    <input type="hidden" name="product_name" value="{{ $producto->titulo }}"> <!-- Nombre del producto -->
                                    <input class="precio producto" type="hidden" name="product_price" value="{{ $producto->precio }}"> <!-- Precio unitario del producto -->
                                    <button class="Agregar_producto" type="submit">Agregar</button>
                                </form>
                            </div>
                        
                </div>
                @endforeach
                
            </div>
                
        </main>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <!-- <script src="main.js"></script> -->
    <script>


        const productos = document.querySelectorAll('.card-producto');
        const botonesCategorias = document.querySelectorAll(".boton_categoria");
        const tituloPrincipal = document.getElementById("titulo-principal");
        botonesCategorias.forEach((boton) => {
            let categoria = boton.id;
            boton.addEventListener('click', (e) => {
                botonesCategorias.forEach(boton => boton.classList.remove("active"));
                e.currentTarget.classList.add("active");
                if (categoria === 'todos') {
                    tituloPrincipal.innerText = "Todos los Productos";
                    productos.forEach(producto => {
                        producto.style.display = 'block';
                    });
                } else {
                    mostrarProductos(categoria);
                    tituloPrincipal.innerText = (categoria);
                }
            });                  
        });

        function mostrarProductos(categoria) {
            productos.forEach(producto => {
                let productoCategoria = producto.dataset.categoria;
                if (productoCategoria === categoria) {
                    producto.style.display = 'block';
                } else {
                    producto.style.display = 'none';
                }
            });
        }

        // Función para realizar la búsqueda en tiempo real
    document.getElementById("search-input").addEventListener("input", function() {
        // Obtener el valor del campo de búsqueda
        var searchText = this.value.toLowerCase().trim();
        
        // Obtener todas las tarjetas de productos
        var productos = document.querySelectorAll('.card-producto');

        // Iterar sobre todas las tarjetas de productos
        productos.forEach(function(producto) {
            // Obtener el título del producto en la tarjeta
            var titulo = producto.querySelector('.titulo_producto').textContent.toLowerCase();

            // Verificar si el título del producto coincide con el texto de búsqueda
            if (titulo.includes(searchText)) {
                // Si coincide, mostrar la tarjeta del producto
                producto.style.display = 'block';
            } else {
                // Si no coincide, ocultar la tarjeta del producto
                producto.style.display = 'none';
            }
        });
    });

     // Evitar que la página se recargue al presionar "Enter"
     document.getElementById("search-input").addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }

        // Cambiar el botón de categoría activo a "Todos los productos"
        document.getElementById('todos').classList.add('active');
        document.querySelectorAll('.boton_categoria').forEach(function(boton) {
            if (boton.id !== 'todos') {
                boton.classList.remove('active');
                tituloPrincipal.innerText = "Todos los Productos";
            }
        });
    });
        const openMenu = document.querySelector("#open-menu");
        const closeMenu = document.querySelector("#close-menu");
        const aside = document.querySelector("aside");

        openMenu.addEventListener("click", () => {
            aside.classList.add("aside-visible");
        })

        closeMenu.addEventListener("click", () => {
            aside.classList.remove("aside-visible");
        })


        document.addEventListener("click", (event) => {
    if (!aside.contains(event.target) && !openMenu.contains(event.target)) {
        aside.classList.remove("aside-visible");
    }
});


        botonesCategorias.foreach(boton => boton.addEventListener("click", () =>{
            aside.classList.remove("aside-visible");   
        }))

    </script>
   
</body>
</html>