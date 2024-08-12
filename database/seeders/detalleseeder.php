<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\detalle;

class detalleseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detall = new detalle();
        $detall->Nro_Sisco = "0000";
        $detall->Zona = "ninguno";
        $detall->Tipo_Trabajo = "ninguno";
        $detall->Foto_Carta = "ninguno";
        $detall->Fecha_Programado = "2024-07-04";
        $detall->Estado = "ninguno";

        $detall->Users_id = 1;
        $detall->Distritos_id = 15;
        $detall->save();
    }
}
