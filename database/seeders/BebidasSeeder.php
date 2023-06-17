<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BebidasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bebidas = [
            [
                'marca' => 'Coca-Cola',
                'tipo' => 'Refrigerante',
                'preco' => 5.00,
            ],
            [
                'marca' => 'Pepsi',
                'tipo' => 'Refrigerante',
                'preco' => 4.50,
            ],
            [
                'marca' => 'Guaraná Antarctica',
                'tipo' => 'Refrigerante',
                'preco' => 4.50,
            ],
            [
                'marca' => 'Brahma',
                'tipo' => 'Cerveja',
                'preco' => 3.50,
            ],
            [
                'marca' => 'Skol',
                'tipo' => 'Cerveja',
                'preco' => 3.00,
            ],
            [
                'marca' => 'Stella Artois',
                'tipo' => 'Cerveja',
                'preco' => 7.00,
            ],
            [
                'marca' => 'Absolut',
                'tipo' => 'Vodka',
                'preco' => 50.00,
            ],
            [
                'marca' => 'Grey Goose',
                'tipo' => 'Vodka',
                'preco' => 70.00,
            ],
            [
                'marca' => 'Chivas Regal',
                'tipo' => 'Whisky',
                'preco' => 120.00,
            ],
            [
                'marca' => 'Johnnie Walker',
                'tipo' => 'Whisky',
                'preco' => 80.00,
            ],
        ];

        foreach ($bebidas as $bebida) {
            DB::table('bebidas')->insert($bebida);
        }
    }
}
