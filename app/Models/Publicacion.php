<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    /** @use HasFactory<\Database\Factories\PublicacionFactory> */
    use HasFactory;

    protected $primaryKey = 'IdPublicacion';

    protected $fillable = [
        'Descripcion',
        'Imagen',
        'users_id'
    ];

    public function Users()
    {
        return $this->belongsTo(User::class);
    }

}
