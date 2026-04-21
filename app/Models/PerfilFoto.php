<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilFoto extends Model
{
    /** @use HasFactory<\Database\Factories\PerfilFotoFactory> */
    use HasFactory;

    protected $primaryKey = 'IdPerfil';

    protected $fillable = [
        'Imagen',
        'users_id'
    ];
}
