<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    protected $table = 'trabajos'; // Asegúrate de que coincida con el nombre de tu tabla
    protected $fillable = ['mensaje', 'idImpresora'];
    use HasFactory;
}
