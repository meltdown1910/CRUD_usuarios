<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios eliminados</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #eee;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            margin: 2px;
        }

        .restore {
            background: #198754;
        }

        .delete {
            background: #dc3545;
        }

        .back {
            background: #555;
        }

        .success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px;
            border-radius: 5px;
        }

        .empty {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Usuarios eliminados</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <a href="{{ route('users.index') }}" class="btn back">
        Volver a usuarios
    </a>

    @if($users->count() > 0)

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo electrónico</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>

                        <td>
                            <form action="{{ route('users.restore', $user->id) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="btn restore">
                                    Restaurar
                                </button>
                            </form>

                            <form action="{{ route('users.forceDelete', $user->id) }}"
                                  method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('¿Eliminar permanentemente este usuario? Esta acción no se puede deshacer.');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn delete">
                                    Eliminar permanentemente
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $users->links() }}
        </div>

    @else

        <p class="empty">No hay usuarios eliminados.</p>

    @endif

</div>

</body>
</html>
