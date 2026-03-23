<?php

namespace App\Policies;

use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PublicacionPolicy
{
    public function update(User $user, Publicacion $publicacion): bool
    {
        return $user->id == $publicacion->users_id;
    }

    public function delete(User $user, Publicacion $publicacion): bool
    {
        return $user->id === $publicacion->users_id;
    }
}
