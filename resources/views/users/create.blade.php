<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar usuario</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 40px;
        }

        .container {
            max-width: 550px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            box-sizing: border-box;
        }

        button, a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Registrar usuario</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <label for="name">Nombre completo</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            required
        >
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="email">Correo electrónico</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
        >
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password">Contraseña</label>
        <input
            type="password"
            id="password"
            name="password"
            required
        >
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        @if(auth()->user()->isAdmin())
            <label for="role">Rol del usuario</label>
            <select id="role" name="role" required>
                <option value="employee">Empleado</option>
                <option value="admin">Administrador</option>
            </select>
            @error('role')
                <div class="error">{{ $message }}</div>
            @enderror
        @endif

        <button type="submit">Guardar usuario</button>

        <a href="{{ route('users.index') }}">Cancelar</a>
    </form>

</div>

</body>
</html>
