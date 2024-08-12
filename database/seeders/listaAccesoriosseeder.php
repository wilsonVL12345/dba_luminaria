<?php

namespace Database\Seeders;

use App\Models\lista_accesorio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class listaAccesoriosseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $listaacc = [
            ['id' => 1, 'Nombre_Item' => 'LUMINARIA CON TECNOLOGIA LED 150-175W'],
            ['id' => 2, 'Nombre_Item' => 'LUMINARIA CON TECNOLOGIA LED 78-80W'],
            ['id' => 3, 'Nombre_Item' => 'LUMINARIA DE SAP 250W/230V'],
            ['id' => 4, 'Nombre_Item' => 'REFLECTOR CON TECNOLOGIA LED DE 200-250W'],
            ['id' => 5, 'Nombre_Item' => 'LAMPARA TUBULAR SAP 250W/230V E-40'],
            ['id' => 6, 'Nombre_Item' => 'LAMPARA TUBULAR SAP 150W/230V E-40'],
            ['id' => 7, 'Nombre_Item' => 'LAMPARA PARA SAP 70W/230V E-27'],
            ['id' => 8, 'Nombre_Item' => 'LAMPARA TUBULAR SAP 400 W/230V E-40'],
            ['id' => 9, 'Nombre_Item' => 'BALASTO SAP 250 W/230V 50 HZ'],
            ['id' => 10, 'Nombre_Item' => 'BALASTO SAP 150W/230V 50 HZ'],
            ['id' => 11, 'Nombre_Item' => 'BALASTO SAP 70W/230V 50 HZ'],
            ['id' => 12, 'Nombre_Item' => 'BALASTO SAP 400W/230V 50 HZ'],
            ['id' => 13, 'Nombre_Item' => 'FOTOCONTROL'],
            ['id' => 14, 'Nombre_Item' => 'MÉNSULA PARA FOTOCONTROL'],
            ['id' => 15, 'Nombre_Item' => 'IGNITOR'],
            ['id' => 16, 'Nombre_Item' => 'CABLE DUPLEX'],
            ['id' => 17, 'Nombre_Item' => 'CONDUCTOR (ALAMBRE DE CU) AISLADO AWG-TW Nº 12'],
            ['id' => 18, 'Nombre_Item' => 'CINTA AISLANTE'],
            ['id' => 19, 'Nombre_Item' => 'CONDENSADOR 20-25 UF SAP 150W/230V 50 HZ.'],
            ['id' => 20, 'Nombre_Item' => 'CONDENSADOR 32-33 UF SAP 250W/230V 50 HZ.'],
            ['id' => 21, 'Nombre_Item' => 'RACK DE UNA VIA CON AISLADOR CARRETE Y MALLA Nº 8 (COMPLETA)'],
            ['id' => 22, 'Nombre_Item' => 'BRAZO METALICO TIPO 1'],
            ['id' => 23, 'Nombre_Item' => 'POSTE METÁLICO DE DOS BRAZOS CON BASE Y CANASTILLO'],
            ['id' => 24, 'Nombre_Item' => 'POSTE METALICO DE UN BRAZO CON BASE Y CANASTILLO'],
            ['id' => 25, 'Nombre_Item' => 'CAJA DISTRIBUIDORA PARA TERMICOS'],
            ['id' => 26, 'Nombre_Item' => 'ALAMBRE DE AMARRE'],
            ['id' => 27, 'Nombre_Item' => 'SOCKET DE PORCELANA E-40'],
            ['id' => 28, 'Nombre_Item' => 'SOCKET DE PORCELANA E-27'],
            ['id' => 29, 'Nombre_Item' => 'TERMOMAGNETICO 2PX40A (BIPOLAR)'],
            ['id' => 30, 'Nombre_Item' => 'TERMOMAGNETICO 2PX63A (BIPOLAR)'],
            ['id' => 31, 'Nombre_Item' => 'TERMOMAGNETICO (3P-63A) TRIPOLAR'],
            ['id' => 32, 'Nombre_Item' => 'TERMOMAGNETICO (3P-32A) TRIPOLAR'],
            ['id' => 33, 'Nombre_Item' => 'TERMOMAGNETICO (2P-10A) BIPOLAR'],
            ['id' => 34, 'Nombre_Item' => 'TERMINAL ZAPATITO (16MM)'],
            ['id' => 35, 'Nombre_Item' => 'BASE PARA FOTOCONTROL CON MENSULA'],
            ['id' => 36, 'Nombre_Item' => 'BRAZO METALICO TIPO 3'],
            ['id' => 37, 'Nombre_Item' => 'BRAZO METALICO TIPO 2'],
            ['id' => 38, 'Nombre_Item' => 'MEDIDOR DE LUZ (ELECTRONICO DIRECTO 5/100AMP)'],
            ['id' => 39, 'Nombre_Item' => 'CAJA PARA MEDIDOR (TRIFASICO)'],
            ['id' => 40, 'Nombre_Item' => 'CABLE DE COBRE (7 HILOS #8 AWG-100 MTS)'],
            ['id' => 41, 'Nombre_Item' => 'FUSIBLE TRIFASICO DE 100 AMP 22X58 MM2'],
            ['id' => 42, 'Nombre_Item' => 'PORTA FUSIBLE – ELEMENTO DE CORTE-22X58 mm 100AMP'],
            ['id' => 43, 'Nombre_Item' => 'CONTACTOR (3 POLOS 380V 400V 22KW, 230V 50/60HZ)'],
            ['id' => 44, 'Nombre_Item' => 'TEMPORIZADOR (DIGITAL 220V)'],
            ['id' => 45, 'Nombre_Item' => 'ALAMBRE DE COBRE #8	'],
            ['id' => 46, 'Nombre_Item' => 'CONECTOR POR PERFORACION'],
            ['id' => 47, 'Nombre_Item' => 'CONECTOR PERNO PARTIDO '],
        ];
        foreach ($listaacc as $newlist) {
            $lista = new lista_accesorio();
            $lista->id = $newlist['id'];  // Acceder correctamente al valor del array
            $lista->Nombre_Item = $newlist['Nombre_Item'];
            $lista->save();  // Guardar el modelo
        }
    }
}
