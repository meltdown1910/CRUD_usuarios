<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de empleados</title>
</head>
<body>

    <h1>Registro de empleados</h1>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST">
        @csrf

        <div>
            <label for="name">Nombre:</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="email">Correo electrónico:</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="password">Contraseña:</label>
            <input
                type="password"
                id="password"
                name="password"
                required
            >
        </div>

        <br>

        <div>
            <label for="password_confirmation">Confirmar contraseña:</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                required
            >
        </div>

        <br>

        <button type="submit">Registrarse</button>
    </form>

    <p>
        ¿Ya tienes una cuenta?
        <a href="{{ route('login') }}">Iniciar sesión</a>
    </p>

</body>
</html>
