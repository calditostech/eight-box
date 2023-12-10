<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppetizerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appetizers = [
            [
                'marca' => 'Coca-Cola',
                'tipo' => 'Refrigerante',
                'quantidade' => 100,
                'data_entrada_produto' => now(),
            ],
            [
                'marca' => 'Trakinas',
                'tipo' => 'Bolacha',
                'quantidade' => 80,
                'data_entrada_produto' => now(),
            ],
            [
                'marca' => 'Guaraná Antarctica',
                'tipo' => 'Refrigerante',
                'quantidade' => 120,
                'data_entrada_produto' => now(),
            ],
            [
                'marca' => 'Arroz',
                'tipo' => 'Mercearia',
                'quantidade' => 50,
                'data_entrada_produto' => now(),
            ],
            [
                'marca' => 'Skol',
                'tipo' => 'Cerveja',
                'quantidade' => 70,
                'data_entrada_produto' => now(),
            ],
            [
                'marca' => 'Stella Artois',
                'tipo' => 'Cerveja',
                'quantidade' => 30,
                'data_entrada_produto' => now(),
            ],
            [
                'marca' => 'Absolut',
                'tipo' => 'Vodka',
                'quantidade' => 20,
                'data_entrada_produto' => now(),
            ],
            [
                'marca' => 'Bis',
                'tipo' => 'Chocolate',
                'quantidade' => 15,
                'data_entrada_produto' => now(),
            ],
            [
                'marca' => 'Chivas Regal',
                'tipo' => 'Whisky',
                'quantidade' => 10,
                'data_entrada_produto' => now(),
            ],
            [
                'marca' => 'Johnnie Walker',
                'tipo' => 'Whisky',
                'quantidade' => 25,
                'data_entrada_produto' => now(),
            ],
            [
                'marca' => 'Macbook Pro',
                'tipo' => 'Eletrônico',
                'quantidade' => 5,
                'data_entrada_produto' => now(),
            ],
            [
                'marca' => 'Samsung Galaxy S21',
                'tipo' => 'Eletrônico',
                'quantidade' => 15,
                'data_entrada_produto' => now(),
            ],
            [
                'marca' => 'PlayStation 5',
                'tipo' => 'Eletrônico',
                'quantidade' => 8,
                'data_entrada_produto' => now(),
            ],
        ];

        foreach ($appetizers as $appetizer) {
            DB::table('appetizer')->insert($appetizer);
        }
    }
}
