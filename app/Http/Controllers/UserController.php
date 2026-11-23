<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Mostrar la lista de usuarios activos.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Mostrar el formulario para crear usuarios.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Guardar un nuevo usuario.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
            $currentUser = Auth::user();

            if ($currentUser->isAdmin()) {
            $data['role'] = $request->validate([
                'role' => ['required', Rule::in(['admin', 'employee'])],
            ])['role'];
        } else {
            $data['role'] = 'employee';
        }

        User::create($data);

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Mostrar los detalles de un usuario.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Mostrar el formulario para editar un usuario.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Actualizar un usuario.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ]);

        if (Auth::user()->isAdmin()) {
            $data['role'] = $request->validate([
                'role' => ['required', Rule::in(['admin', 'employee'])],
            ])['role'];
        }

        if ($request->filled('password')) {
            $data['password'] = $request->validate([
                'password' => ['string', 'min:8'],
            ])['password'];
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar un usuario lógicamente.
     */
    public function destroy(User $user)
    {
        abort_unless(Auth::user()->isAdmin(), 403);

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Mostrar los usuarios eliminados.
     */
    public function trashed()
    {
        abort_unless(Auth::user()->isAdmin(), 403);

        $users = User::onlyTrashed()->latest()->paginate(10);

        return view('users.trashed', compact('users'));
    }

    /**
     * Restaurar un usuario eliminado.
     */
    public function restore($id)
    {
        abort_unless(Auth::user()->isAdmin(), 403);

        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('users.trashed')
            ->with('success', 'Usuario restaurado correctamente.');
    }

    /**
     * Eliminar un usuario permanentemente.
     */
    public function forceDeleteUser($id)
    {
        abort_unless(Auth::user()->isAdmin(), 403);

        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->route('users.trashed')
            ->with('success', 'Usuario eliminado permanentemente.');
    }
}
