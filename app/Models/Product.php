<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
        'direccion',
        'precio_unitario',
        'existencia',
        'garantia'
    ];

    protected $timestamp = true;
}
