
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULARIO UAP-R-001</title>
    <style>
        @page {
            margin: 20px;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            font-size: 12px;
        }
        .header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }
        .subheader {
            background-color: #666;
            color: white;
            text-align: center;
            padding: 5px;
            font-size: 13px;
        }
        .label {
            font-weight: bold;
        }
        .items-table th {
            background-color: #444; /* Color gris oscuro para el encabezado de la tabla de items */
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th class="header" colspan="2">FORMULARIO UAP-R-001</th>
        </tr>
        <tr>
            <th class="subheader" colspan="2">DATOS TÉCNICOS DE ACCESORIOS Y LUMINARIAS RETIRADOS</th>
        </tr>
        <tr>
            <td><span class="label">DISTRITO:</span> {{ $datosLum->distrito->Distrito }}</td>
            <td><span class="label">ZONA:</span> {{ $datosLum->zona }}</td>
        </tr>
        <tr>
            <td colspan="2"><span class="label">PROYECTO:</span> {{ $datosLum->Proyecto }}</td>
        </tr>
        <tr>
            <td colspan="2"><span class="label">DIRECCIÓN:</span> {{ $datosLum->Direccion }}</td>
        </tr>
        <tr>
            <td><span class="label">FECHA DE MANTENIMIENTO:</span> {{ $datosLum->Fecha }}</td>
            <td><span class="label">NRO. SISCO:</span> {{ $datosLum->Nro_sisco }}</td>
        </tr>
    </table>

    <table class="items-table">
        <tr>
            <th style="width: 5%;">N°</th>
            <th style="width: 30%;">NOMBRE ÍTEM</th>
            <th style="width: 20%;">CANTIDAD DE ACCESORIOS REUTILIZABLES</th>
            <th style="width: 20%;">CANTIDAD ACCESORIOS NO REUTILIZABLES</th>
            <th style="width: 25%;">CANTIDAD TOTAL</th>
        </tr>
        @foreach ($listalum as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->Nombre }}</td>
            <td>{{ $item->Reutilizables }}</td>
            <td>{{ $item->NoReutilizables }}</td>
            <td>{{ $item->Cantidad }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>