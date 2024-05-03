let ProductosEnCarrito = localStorage.getItem("productos-en-carrito");
ProductosEnCarrito = JSON.parse(ProductosEnCarrito);

const contenedorCarritoVacio = document.querySelector("#carrito-vacio");
const contenedorCarritoProductos = document.querySelector("#carrito-productos");
const contenedorCarritoAcciones = document.querySelector("#carrito-acciones");
const contenedorCarritoComprado = document.querySelector("#carrito-comprado");
let botonesEliminar = document.querySelectorAll(".carrito_producto_eliminar")
const botonVaciar = document.querySelector("#carrito-acciones-vaciar");
const contenedorTotal = document.querySelector("#total");
const botonComprar = document.querySelector("#carrito-acciones-comprar");






function cargarProductosCarrito() {
    if (ProductosEnCarrito && ProductosEnCarrito.length > 0) {

        
        
        contenedorCarritoVacio.classList.add("disabled");
        contenedorCarritoProductos.classList.remove("disabled");
        contenedorCarritoAcciones.classList.remove("disabled");
        contenedorCarritoComprado.classList.add("disabled");
    
        contenedorCarritoProductos.innerHTML = "";
    
        ProductosEnCarrito.forEach(producto => {
    
            const div = document.createElement("div");
            div.classList.add("carrito_producto");
            div.innerHTML = `
            <img class="carrito-producto-imagen" src="${producto.imagen}" alt="${producto.titulo}">
                            <div class="carrito_producto_titulo">
                                <small>titulo</small>
                                <h3>${producto.titulo}</h3>
                            </div>
                            <div class="carrito_producto_cantidad">
                                <small>cantidad</small>
                                <p>${producto.cantidad}</p>
                            </div>
                            <div class="carrito_producto_precio">
                                <small>precio</small>
                                <p>$${producto.precio}</p>
                            </div>
                            <div class="carrito_producto_subtotal">
                                <small>Subtotal</small>
                                <p>$${producto.precio * producto.cantidad}</p>
                            </div>
                            <button class="carrito_producto_eliminar" id="${producto.id}"><i class="bi bi-trash-fill"></i></button>
            
            `;
            
            contenedorCarritoProductos.append(div);
    
        })
        
    
    } else {
    
        contenedorCarritoVacio.classList.remove("disabled");
        contenedorCarritoProductos.classList.add("disabled");
        contenedorCarritoAcciones.classList.add("disabled");
        contenedorCarritoComprado.classList.add("disabled");
    
    }

    actualizarBotonesEliminar();
    ActualizarTotal();
  

}

cargarProductosCarrito();





function actualizarBotonesEliminar() {
    botonesEliminar = document.querySelectorAll(".carrito_producto_eliminar");

    botonesEliminar.forEach(boton => {
        boton.addEventListener("click", EliminarDelCarrito);

    });
}

function EliminarDelCarrito(e){
    const idBoton = e.currentTarget.id;
    const index = ProductosEnCarrito.findIndex(producto => producto.id === idBoton);
    
    
    ProductosEnCarrito.splice(index, 1);
    cargarProductosCarrito();

    localStorage.setItem("productos-en-carrito", JSON.stringify(ProductosEnCarrito));


}


botonVaciar.addEventListener("click", VaciarCarrito);
function VaciarCarrito(){

    Swal.fire({
        title: '¿Estás seguro?',
        icon: 'question',
        html: `Se van a borrar ${ProductosEnCarrito.reduce((acc, producto) => acc + producto.cantidad, 0)} productos.`,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            ProductosEnCarrito.length = 0;
            localStorage.setItem("productos-en-carrito", JSON.stringify(ProductosEnCarrito));
            cargarProductosCarrito();
        }
      })

}

function ActualizarTotal() {
    const totalCalculado = ProductosEnCarrito.reduce((acc, producto) => acc + (producto.precio * producto.cantidad), 0);
    total.innerText = `$${totalCalculado}`;
}

botonComprar.addEventListener("click", ComprarCarrito);
function ComprarCarrito(){
    ProductosEnCarrito.length = 0;
    localStorage.setItem("productos-en-carrito", JSON.stringify(ProductosEnCarrito));

    contenedorCarritoVacio.classList.add("disabled");
    contenedorCarritoProductos.classList.add("disabled");
    contenedorCarritoAcciones.classList.add("disabled");
    contenedorCarritoComprado.classList.remove("disabled");

}









