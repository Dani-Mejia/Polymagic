<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
            background-color: #f4f4f9;
        }
        .message {
            margin: 20px 0;
            padding: 20px;
            border-radius: 5px;
            font-size: 1.2em;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
        }
        .message.failure {
            background-color: #f8d7da;
            color: #721c24;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
        .receipt {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            max-width: 600px;
            text-align: left;
        }
        .receipt h2 {
            margin-top: 0;
        }
        .receipt table {
            width: 100%;
            border-collapse: collapse;
        }
        .receipt table, .receipt th, .receipt td {
            border: 1px solid #ddd;
        }
        .receipt th, .receipt td {
            padding: 8px;
            text-align: left;
        }
        .receipt tfoot td {
            font-weight: bold;
        }
    </style>
</head>
<body>
    @if($estado === 'COMPLETED')
        <div class="message success">
            <h1>¡Pago realizado con éxito!</h1>
            <p>Tu compra se ha realizado. Gracias por comprar.</p>
        </div>
        <div class="receipt">
            <h2>Detalles de la Compra</h2>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <td>{{ $producto['nombre'] }}</td>
                            <td>{{ $producto['cantidad'] }}</td>
                            <td>${{ number_format($producto['precio_unitario'], 2) }}</td>
                            <td>${{ number_format($producto['cantidad'] * $producto['precio_unitario'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total</td>
                        <td>${{ number_format(array_sum(array_map(function($producto) {
                            return $producto['cantidad'] * $producto['precio_unitario'];
                        }, $productos)), 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @else
        <div class="message failure">
            <h1>Hubo un problema con tu pago</h1>
            <p>Algo ha salido mal con tu pago. Por favor, intenta nuevamente.</p>
        </div>
    @endif

    <a href="{{ route('home') }}" class="back-button">&larr; Volver al inicio</a>
</body>
</html>