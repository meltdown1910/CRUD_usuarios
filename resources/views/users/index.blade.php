<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f4f6f9;
            color: #333;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }

        a, button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            color: white;
            background: #2563eb;
        }

        .delete {
            background: #dc2626;
        }

        .trashed {
            background: #64748b;
        }

        .success {
            padding: 12px;
            background: #dcfce7;
            color: #166534;
            margin-bottom: 15px;
        }

        .actions {
            display: flex;
            gap: 6px;
        }

        .pagination {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <h1>Administración de usuarios</h1>

        <div>
            <a href="{{ route('users.create') }}">
                Registrar usuario
            </a>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('users.trashed') }}" class="trashed">
                    Usuarios eliminados
                </a>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

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
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>

                    <td>
                        <div class="actions">

                            <a href="{{ route('users.show', $user) }}">
                                Ver
                            </a>

                            <a href="{{ route('users.edit', $user) }}">
                                Editar
                            </a>

                            @if(auth()->user()->isAdmin())
                                <form action="{{ route('users.destroy', $user) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar este usuario?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="delete">
                                        Eliminar
                                    </button>
                                </form>
                            @endif

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        No hay usuarios registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $users->links() }}
    </div>

</div>

</body>
</html>
