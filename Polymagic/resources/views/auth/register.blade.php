<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('style1.css') }}">
</head>
<body>
    <form action="{{route('registros.agregar')}}" method="post">
        @csrf
        <p>nombre</p>
        <input type="text" name="name">
        <p>correo</p>
        <input type="text" name="correo">
        <p>contraseña</p>
        <input type="password" name="password">
        <p>confirmar contraseña</p>
        <input type="password" name="confirm_password">
        <button type="submit">registrese</button>
        <a href="{{route('login')}}">
        ya tienes una cuenta
    </a>
    </form>

</body>
</html>