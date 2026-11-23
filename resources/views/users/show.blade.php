<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del usuario</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        .detail {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .label {
            font-weight: bold;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            border-radius: 5px;
            background: #2563eb;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Detalles del usuario</h1>

    <div class="detail">
        <span class="label">ID:</span>
        {{ $user->id }}
    </div>

    <div class="detail">
        <span class="label">Nombre:</span>
        {{ $user->name }}
    </div>

    <div class="detail">
        <span class="label">Correo electrónico:</span>
        {{ $user->email }}
    </div>

    <div class="detail">
        <span class="label">Rol:</span>
        {{ $user->role === 'admin' ? 'Administrador' : 'Empleado' }}
    </div>

    <div class="detail">
        <span class="label">Fecha de registro:</span>
        {{ $user->created_at->format('d/m/Y H:i') }}
    </div>

    <a href="{{ route('users.index') }}">Volver al listado</a>

</div>

</body>
</html>
