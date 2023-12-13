<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Outputs;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        /*
        \App\Models\User::factory()->create([
             'name' => 'Ricardo Ferreira Moreira'
             'email' => 'ricardo@teste.com.br,
             'password' => 'ricardoteste'
        ]);

        */
        /*
        $this->call([
            AppetizerSeeder::class,
        ]);
        */
        $this->call([
            OutputsSeeder::class,
        ]);
    }
}
