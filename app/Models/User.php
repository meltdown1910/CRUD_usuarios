<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Determina los atributos que deben convertirse.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Comprueba si el usuario es administrador.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Comprueba si el usuario es empleado.
     */
    public function isEmployee(): bool
    {
        return $this->role === 'employee';
    }
}
