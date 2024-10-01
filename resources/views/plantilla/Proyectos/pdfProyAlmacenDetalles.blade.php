
 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Proyecto</title>
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
            <th class="header" colspan="4">DETALLES DE PROYECTOS</th>
        </tr>
        <tr>
            <th class="subheader" colspan="4">DATOS TÉCNICOS DE ACCESORIOS, LUMINARIAS LED Y LUMINARIAS RETIRADOS</th>
        </tr>
        <tr >
			<td colspan="2"><span  class="label">Cod-PROYECTO:</span> {{ $proyec->Cuce_Cod }}</td>
            <td colspan="2"><span class="label">DISTRITO:</span> {{ $proyec->distrito->Distrito }}</td>
        </tr>
        <tr>
            <td colspan="4"><span class="label">TIPOS DE COMPONENTES:</span> {{ $proyec->Tipo_Componentes }}</td>
        </tr>
        <tr>
            <td colspan="4"><span class="label">URBANIZACION:</span> {{ $proyec->Zona }}</td>
        </tr>
        <tr>
            @if ($proyec->Estado=='Finalizado')
            <td colspan="1"><span class="label">SUBASTA:</span> {{ $proyec->Subasta }}</td>
            <td colspan="2"><span class="label">MODALIDAD:</span> {{ $proyec->Modalidad }}</td>
            <td colspan="1"><span class="label">TRABAJO:</span> {{ $proyec->Trabajo }}</td>
                
            @else
            <td colspan="2"><span class="label">SUBASTA:</span> {{ $proyec->Subasta }}</td>
            <td colspan="2"><span class="label">MODALIDAD:</span> {{ $proyec->Modalidad }}</td>
            @endif

        </tr>
		<tr>
            <td colspan="1"><span class="label">TIPO DE CONTRATACION:</span> {{ $proyec->Tipo_Contratacion }}</td>
            
			<td colspan="1"><span class="label">ESTADO:</span> {{ $proyec->Estado }}</td>
            <td colspan="2"><span class="label">FECHA DE ADQUISICION:</span> {{ $proyec->Fecha_Programada }}</td>
        </tr>
		@if ($proyec->Estado=='Finalizado')
		<tr>
			<td colspan="1"><span class="label">EJECUTADO POR:</span> {{ $proyec->Ejecutado_Por }}</td>
			<td colspan="1"><span class="label">A CARGO DE:</span>  {{$ejecutador->name.' '.$ejecutador->Paterno}}"</td>
            <td colspan="2"><span class="label">FECHA DE INSTALACION:</span> {{ $proyec->Fecha_Ejecutada }}</td>
        </tr>
		@endif
		<tr>
            <td colspan="4"><span class="label">OBJETO DE CONTRATACION:</span> {{ $proyec->Objeto_Contratacion }}</td>
        </tr>
    </table>




    @if (!$reutilizada->isEmpty())
        <table class="items-table">
            <thead>
				<tr>
					<td colspan="4" class="table-title">DATOS DE LUMINARIAS REUTILIZADAS</td>
				</tr>
                <tr>
                    <th>Nombre Item</th>
                    <th>Cantidad</th>
                    <th>Utilizados</th>
                    <th>Disponibles</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reutilizada as $item)
                <tr>
                    <td>{{$item->Nombre_Item}}</td>
                    <td>{{$item->Cantidad}}</td>
                    <td>{{$item->Utilizados}}</td>
                    <td>{{$item->Disponibles}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="badge badge-light-danger">No hay luminarias Reutilizadas Disponibles</p>
    @endif

    @if (!$accesorios->isEmpty())
        <table class="items-table">
            <thead>
				<tr>
					<td colspan="4" class="table-title">DATOS DE ACCESORIOS</td>
				</tr>
                <tr>
                    <th>Nombre Item</th>
                    <th>Cantidad</th>
                    <th>Utilizados</th>
                    <th>Disponibles</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accesorios as $itemacc)
                <tr>
                    <td>{{$itemacc->Lista_accesorio->Nombre_Item}}</td>
                    <td>{{$itemacc->Cantidad}}</td>
                    <td>{{$itemacc->Utilizados}}</td>
                    <td>{{$itemacc->Disponibles}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="badge badge-light-danger">No hay Accesorios en este Proyecto</p>
    @endif

    @if (!$luminaria->isEmpty())
        <table class="items-table">
            <thead>
				<tr>
					<td colspan="5" class="table-title">DATOS DE LUMINARIAS TIPO LED</td>
				</tr>
                <tr>
                    <th>Cod_Luminaria Item</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Potencia</th>
                    <th>Instalado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($luminaria as $itemlum)
                <tr>
                    <td>{{$itemlum->Cod_Luminaria}}</td>
                    <td>{{$itemlum->Marca}}</td>
                    <td>{{$itemlum->Modelo}}</td>
                    <td>{{$itemlum->Potencia}}</td>
                    <td>{{$itemlum->Lugar_Instalado ?? 'No'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="badge badge-light-danger">No hay luminarias LED en este Proyecto</p>
    @endif
</body>
</html> 
