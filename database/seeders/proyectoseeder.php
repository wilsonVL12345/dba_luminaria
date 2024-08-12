<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\proyecto;

class proyectoseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detall = new proyecto();
        $detall->Cuce_Cod = "0000";
        $detall->Zona = "proyecFake";
        $detall->Tipo_Contratacion = "proyecFake";
        $detall->Estado = "proyecFake";
        $detall->Subasta = "proyecFake";
        $detall->Modalidad = "proyecFake";
        $detall->Objeto_Contratacion = "proyecFake";
        $detall->Tipo_Componentes = "proyecFake";
        $detall->Ejecutado_Por = "proyecFake";

        $detall->Observaciones = "proyecFake";
        $detall->Proveedor = "proyecFake";
        $detall->Users_id = 1;
        $detall->Distritos_id = 15;
        $detall->save();
    }
}
