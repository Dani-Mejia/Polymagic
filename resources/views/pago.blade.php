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
    </style>
</head>
<body>
    @if($estado === 'COMPLETED')
        <div class="message success">
            <h1>¡Pago realizado con éxito!</h1>
            <p>Tu compra se ha realizado. Gracias por comprar.</p>
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