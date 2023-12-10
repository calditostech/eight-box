<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appetizer extends Model
{
    use HasFactory;

    protected $fillable = ['marca', 'tipo', 'quantidade', 'data_entrada_produto'];

    protected $table = 'appetizer';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
