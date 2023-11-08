<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bebida extends Model
{
    use HasFactory;

    protected $fillable = ['marca', 'tipo', 'preco'];

    protected $table = 'bebidas';

    protected $casts = [
        'preco' => 'float',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
