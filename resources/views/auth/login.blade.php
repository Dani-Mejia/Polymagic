<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>Document</title>
</head>
<body>
    <form action="{{route('login.ingresar')}}" method="post">
        @csrf
        <p>correo</p>
        <input type="text" name="correo">
        <p>contraseña</p>
        <input type="password" name="password">
        <button type="submit">iniciar sesion</button>
        <a href="{{route('registro')}}">
        Registrate
    </a>
    </form>
 
</body>
</html>