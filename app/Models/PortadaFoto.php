<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortadaFoto extends Model
{
    /** @use HasFactory<\Database\Factories\PortadaFotoFactory> */
    use HasFactory;

    protected $primaryKey = 'IdPortada';

    protected $fillable = [
        'Imagen',
        'users_id'
    ];

}
