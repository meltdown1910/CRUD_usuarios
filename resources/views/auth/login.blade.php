<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container min-vh-100 d-flex justify-content-center align-items-center">

        <div class="card shadow border-0 rounded-4" style="max-width: 420px; width: 100%;">

            <div class="card-body p-4 p-md-5">

                <div class="text-center mb-4">
                    <h2 class="fw-bold text-primary">Bienvenido</h2>
                    <p class="text-secondary">Inicia sesión para continuar</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            class="form-control form-control-lg"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="ejemplo@correo.com"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">
                            Contraseña
                        </label>

                        <input
                            type="password"
                            class="form-control form-control-lg"
                            id="password"
                            name="password"
                            placeholder="Ingresa tu contraseña"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        Iniciar sesión
                    </button>
                </form>

                <div class="text-center mt-4">
                    <span class="text-secondary">¿No tienes una cuenta?</span>
                    <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">
                        Registrarse
                    </a>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
