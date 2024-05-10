<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('style1.css') }}">
    <title>Document</title>
</head>
<body>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Agregar Producto</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('productos.guardar') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                        </div>

                        <select name="categoria_id" id="categoria">
                            @forelse ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @empty
                                <option value="">No hay categorias</option>
                            @endforelse
                        </select>

                        <div class="form-group">
                            <label for="imagen">Imagen:</label>
                            <input type="file" class="form-control-file" id="imagen" name="imagen" required>
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio') }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Agregar Producto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista de Productos</div>

                <div class="card-body">
                    @if ($productos->isEmpty())
                        <p>No hay productos disponibles.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Imagen</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td>{{ $producto->id }}</td>
                                        <td>{{ $producto->titulo }}</td>
                                        <td><img src="{{ asset('Imagenes/productos/' . $producto->imagen) }}" alt="{{ $producto->titulo }}" style="max-width: 100px;"></td>
                                        <td>${{ $producto->precio }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>