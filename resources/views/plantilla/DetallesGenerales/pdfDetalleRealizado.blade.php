
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de trabajos de mantenimiento</title>
    <style>
        @page {
            margin-top: 20px;
        margin-right: 20px;
        margin-bottom: 20px;
        margin-left: 70px;
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
            background-color: #5e5a5a; 
            color: white;
            font-weight: bold;
        }
		.badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        .badge-light-danger {
            background-color: #fefafa;
            color: #f84235;
        }
		.table-title {
            background-color: #383737;
            color: white;
            text-align: center;
            padding: 5px;
            font-size: 13px;
            font-weight: bold;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        } 
		
		
    </style>
</head>
<body>
   
	<table>
        <tr>
            <th class="header" colspan="4">DETALLES DE MANTENIMIENTO</th>
        </tr>
        <tr>
            <th class="subheader" colspan="4">DATOS TÉCNICOS DE ACCESORIOS EN MAL ESTADO</th>
        </tr>
        <tr >
			<td colspan="1"><span  class="label">Nro SISCO:</span> {{ $trabajo->Nro_Sisco }}</td>
            <td colspan="1"><span class="label">DISTRITO:</span> {{ $trabajo->distrito->Distrito }}</td>
            <td colspan="2"><span class="label">FECHA PROGRAMADA:</span> {{ $trabajo->Fecha_Programado }}</td>

        </tr>
        <tr>
            <td colspan="4"><span class="label">TIPO DE TRABAJO:</span> {{ $trabajo->Tipo_Trabajo }}</td>
        </tr>
        <tr>
            <td colspan="4"><span class="label">URBANIZACION:</span> {{ $trabajo->Zona }}</td>
        </tr>
        <tr>
            <td colspan="1"><span class="label">PUNTOS:</span> {{ $trabajo->Puntos }}</td>
            <td colspan="1"><span class="label">EJECUTADO POR:</span>{{$ejecutador->name.' '.$ejecutador->Paterno}}</td>
            <td colspan="2"><span class="label">FECHA DE INSTALACION:</span> {{ $trabajo->Fecha_Inicio }}</td>
        </tr>
		
		
		<tr>
            <td colspan="4"><span class="label">DETALLES:</span> {{ $trabajo->Detalles }}</td>
        </tr>
    </table>

    @if (!$listacc->isEmpty())
        <table class="items-table">
            <thead>
				<tr>
					<td colspan="4" class="table-title">DATOS DE ACCESORIOS OBSERVADOS, CON FALLAS</td>
				</tr>
                <tr>
                    <th colspan="1">Nro</th>
                    <th colspan="2">Nombre Item</th>
                    <th colspan="1">Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listacc as $itemacc => $item)
                <tr>
                    <td colspan="1">{{$itemacc +1}}</td>
                    <td colspan="2">{{$item->lista_accesorio->Nombre_Item}}</td>
                    <td colspan="1">{{$item->Cantidad}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- @foreach ($listalum as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->Nombre }}</td>
            <td>{{ $item->Reutilizables }}</td>
            <td>{{ $item->NoReutilizables }}</td>
            <td>{{ $item->Cantidad }}</td>
        </tr>
        @endforeach --}}
    @else
        <p class="badge badge-light-danger">No hay Accesorios en este Proyecto</p>
    @endif

   
</body>
</html> 
