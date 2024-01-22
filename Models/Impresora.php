<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impresora extends Model
{
    use HasFactory;

    protected $table = 'impresoras'; // Asegúrate de que coincida con el nombre de tu tabla
    protected $fillable = ['papel', 'magenta', 'black', 'cyan', 'yellow'];
}

