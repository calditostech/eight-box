<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outputs extends Model
{
    use HasFactory;

    protected $fillable = ['marca', 'tipo', 'quantidade', 'data_saida_produto'];

    protected $table = 'outputs';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
