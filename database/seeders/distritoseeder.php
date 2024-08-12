<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\distrito;

class distritoseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $distritos = [
            ['id' => 1, 'Distrito' => 'D-1'],
            ['id' => 2, 'Distrito' => 'D-2'],
            ['id' => 3, 'Distrito' => 'D-3'],
            ['id' => 4, 'Distrito' => 'D-4'],
            ['id' => 5, 'Distrito' => 'D-5'],
            ['id' => 6, 'Distrito' => 'D-6'],
            ['id' => 7, 'Distrito' => 'D-7'],
            ['id' => 8, 'Distrito' => 'D-8'],
            ['id' => 9, 'Distrito' => 'D-9'],
            ['id' => 10, 'Distrito' => 'D-10'],
            ['id' => 11, 'Distrito' => 'D-11'],
            ['id' => 12, 'Distrito' => 'D-12'],
            ['id' => 13, 'Distrito' => 'D-13'],
            ['id' => 14, 'Distrito' => 'D-14'],
            ['id' => 15, 'Distrito' => 'D-15'],
        ];

        foreach ($distritos as $newdist) {
            $addis = new distrito();
            $addis->id = $newdist['id'];  // Acceder correctamente al valor del array
            $addis->Distrito = $newdist['Distrito'];
            $addis->save();  // Guardar el modelo
        }
    }
}
