<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de administrador</title>
</head>
<body>

    <h1>Verificación de administrador</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <p>Ingresa el código de seis dígitos que enviamos a tu correo electrónico.</p>
    <p>El código tiene una vigencia de cinco minutos.</p>

    <form action="{{ route('verify-code.post') }}" method="POST">
        @csrf

        <div>
            <label for="code">Código de verificación:</label>
            <input
                type="text"
                id="code"
                name="code"
                inputmode="numeric"
                pattern="[0-9]{6}"
                maxlength="6"
                required
            >
        </div>

        <br>

        <button type="submit">Verificar código</button>
    </form>

    <p>
        <a href="{{ route('login') }}">Volver al inicio de sesión</a>
    </p>

</body>
</html>
