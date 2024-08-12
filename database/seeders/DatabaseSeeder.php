<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\lista_accesorio;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(class: userseeder::class);
        $this->call(class: distritoseeder::class);
        $this->call(class: detalleseeder::class);
        $this->call(class: proyectoseeder::class);
        $this->call(class: urbanizacionseeder::class);
        $this->call(class: listaAccesoriosseeder::class);
    }
}
