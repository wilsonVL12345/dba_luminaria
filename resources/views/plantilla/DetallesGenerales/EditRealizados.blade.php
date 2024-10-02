@can('detallesGen.show')

@extends('layout.index')

@section('contenido')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Toolbar-->
	<div class="toolbar" id="kt_toolbar">
		<!--begin::Container-->
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<!--begin::Page title-->
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<!--begin::Title-->
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Realizados</h1>
				<!--end::Title-->
				<!--begin::Separator-->
				<span class="h-20px border-gray-300 border-start mx-4"></span>
				<!--end::Separator-->
				
				
			</div>
			<!--end::Page title-->
			<!--begin::Actions-->
		
		</div>
		<!--end::Container-->
	</div>
	<!--end::Toolbar-->
	<!--begin::Post-->
	{{-- todo el lugar que te interesa --}}
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Navbar-->
			<div class="card mb-5 mb-xl-10">
				<div class="card-body pt-9 pb-0">
					<div class="card-body pt-9 pb-0">
						<div class="margin">
                            <div>
                                @include('layout.notificacioncrud')
                            </div>
                            <form class="form" action="{{route('edit.realizado',$itemtrab->id) }}" id="formaModRealizado" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="scroll-y me-n7 pe-7" id="modadRegistraUsuarios_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modadRegistraUsuarios_header" data-kt-scroll-wrappers="#modadRegistraUsuarios_scroll" data-kt-scroll-offset="300px">
                                        
                                        <!-- Primera fila -->
                                        <div class="form row">
                                            <div class="col-md-3 mb-3">
                                                <label for="slDisR" class="required fs-5 fw-bold mb-2">Distrito</label>
                                                <!-- Opciones -->
                                                <select class="form-control form-select-solid" data-control="select2" name="slDisR" data-id="slDisR" required>
                                                    @foreach ($listdistritos as $dis)
                                                    <option value="{{$dis->id}}" {{$itemtrab->Distritos_id==$dis->id ? 'selected':''}}>{{$dis->Distrito}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="tenror" class="required fs-5 fw-bold mb-2">Nro Sisco
                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números y - en este formato ejem 252353-2024  "></i>

                                                </label>
                                                <input type="text" class="form-control form-control-solid" id="tenror" name="tenror" placeholder="Ingresar Datos" value="{{$itemtrab->Nro_Sisco}}" pattern="^[0-9]{5,6}-[0-9]{4}$" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="slurbr" class="required fs-5 fw-bold mb-2">Urbanizacion</label>
                                                <select class="form-control form-select-solid" data-control="select2"  name="slurbr" data-id="slurbr" required>
                                                    <option value="{{$itemtrab->Zona}}"  >{{$itemtrab->Zona}}</option>
                                                </select>
                                            </div>
                                            
                                        </div>
                                        
                                        <!-- Segunda fila -->
                                        <div class="form row">
                                            <div class="col-md-8 mb-3">
                                                
                                                    
                                                    @php
                                                        $texto = strtolower($itemtrab->Tipo_Trabajo);
                                                        $opcionesSeleccionadas = [
                                                            'Mantenimiento' => strpos($texto, 'mantenimiento') !== false,
                                                            'Instalacion' => strpos($texto, 'instalacion') !== false,
                                                            'Apoyo Carro Canasta' => strpos($texto, 'apoyo') !== false && strpos($texto, 'carro') !== false && strpos($texto, 'canasta') !== false
                                                        ];
                                                    @endphp
                                                    <label for="txtcomponentes" class="required fs-5 fw-bold mb-2">Tipo de Trabajo</label>
                                                    <select  class="form-control form-select-lg form-select-solid" data-control="select2" name="tetipTrabrrea[]" data-placeholder="{{$itemtrab->Tipo_Trabajo}}"   data-allow-clear="true" multiple="multiple" data-id="tipoTrabajoSelectrea" required>

                                                        <option value="Mantenimiento" {{ $opcionesSeleccionadas['Mantenimiento'] ? 'selected' : '' }}>Mantenimiento</option>
                                                        <option value="Instalacion" {{ $opcionesSeleccionadas['Instalacion'] ? 'selected' : '' }}>Instalacion</option>
                                                        <option value="Apoyo Carro Canasta" {{ $opcionesSeleccionadas['Apoyo Carro Canasta'] ? 'selected' : '' }}>Apoyo Carro Canasta</option>
                                                    </select>	
                                            
                                                                
                                            </div>
                                            {{-- esta parte no esta visible --}}
                                            <div class="col-md-3 mb-3" id="apoyoDistR"  style="display: none;" >
                                                
                                                    @php
                                                        // Extraer el número del campo de tipo de trabajo
                                                        preg_match('/D-(\d+)/', $itemtrab->Tipo_Trabajo, $matches);
                                                        $numeroDistrito = isset($matches[1]) ? (int)$matches[1] : null;
                                                    @endphp

                                                    <label for="txtcontratacion" class="required fs-5 fw-bold mb-2">Apoyo a Distrito</label>
                                                    <select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selecione..." name="apoyoDistRealizado" data-id="apoyoDistRealizado">
                                                        <option value="">Seleccione...</option>
                                                        @foreach ($disApoyo as $item)
                                                            @php
                                                                // Extraer el número del distrito actual
                                                                preg_match('/D-(\d+)/', $item->Distrito, $itemMatches);
                                                                $itemNumero = isset($itemMatches[1]) ? (int)$itemMatches[1] : null;
                                                            @endphp
                                                            <option value="{{ $item->Distrito }}" {{ $numeroDistrito === $itemNumero ? 'selected' : '' }}>
                                                                {{ $item->Distrito }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                            </div>

                                        </div>
            
                                        <!-- Tercera fila -->
                                        <div class="form row">
                                            <div class="col-md-4 mb-3">
                                                <label for="file1" class=" fs-5 fw-bold mb-2">Subir Carta</label>
                                                <input type="file" class="form-control form-control-solid" id="file1" name="file1"  accept="image/png, image/jpeg" >
                                            </div>
                                            <div class="col-md-2 mb-1">
                                                    <label for="rnotificar" class="fs-5 fw-bold mb-2">Notificar?</label>
                                                    @if ($itemtrab->Observaciones)
                                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                                            <input class="form-check-input" name="rnotificar" id="rnotificar" type="checkbox" checked value="1" />
                                                            <span class="form-check-label fw-bold text-muted">Si</span>
                                                        </label>
                                                    @else
                                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                                            <input class="form-check-input" name="rnotificar" id="rnotificar" type="checkbox" value="1" />
                                                            <span class="form-check-label fw-bold text-muted">Si</span>
                                                        </label>
                                                    @endif
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="text5" class="required fs-5 fw-bold mb-2">Puntos
                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números positivos asta max 500"></i>

                                                </label>
                                                <input type="text" class="form-control form-control-solid" id="text5" name="text5" value="{{$itemtrab->Puntos}}" placeholder="Ingresar Datos" pattern="^([1-9][0-9]{0,2}|500)$" required>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="dtFechaAtenr" class="required fs-5 fw-bold mb-2">Fecha de Atencion
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permite fechas entre la semana"></i>

                                                </label>
                                                <input type="date" class="form-control form-control-solid" id="dtFechaAtenr" name="dtFechaAtenr" value="{{$itemtrab->Fecha_Inicio}}" required>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="modal-footer justify-content-end">
                                    </div>

							<h1 style="font-weight: bold; text-transform: uppercase;">Componentes Observados, con fallas</h1>
                            
                            <h3>Componentes Observados</h3>
							<div class="table-responsive">
								<table class="table table-bordered" >
									<thead>
										<tr class="fw-bold fs-6 text-gray-800">
											<th style="font-weight: bold; text-transform: uppercase; ">
                                                Nro
                                            </th>
											<th style="font-weight: bold; text-transform: uppercase;">Nombre Item</th>
											<th style="font-weight: bold; text-transform: uppercase;">Cantidad</th>
											
										</tr>
									</thead>
									<tbody>
                                        <?php  $num=1;
                                         ?>
										@foreach ($listacc as $item)
										<tr>
											<td><?php echo $num; ?></td>
											<td>
                                                {{-- {{$item->lista_accesorio->Nombre_Item}} --}}
                                                <select class="form-control form-select-solid" data-control="select2" data-search="false" data-hide-search="true" data-placeholder="Selecione..." name="itemReal[{{$item->id}}]" id="itemReal[{{$item->id}}]">
                                                    @foreach ($listAccesorios as $items)
                                                        
                                                   {{--  <option value="{{$items->id}}" {{ $items->id == $item->lista_accesorio->id ? 'selected' : '' }}>
                                                        {{$items->Nombre_Item}}
                                                    </option> --}}
                                                    <option value="{{$items->id}}" {{ $item->Id_Lista_accesorios == $items->id ? 'selected' : '' }}>
                                                        {{$items->Nombre_Item}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
											<td><input type="text" class="form-control form-control-solid " id="txtcantRea[{{$items->id}}]" name="txtcantRea[{{$item->id}}]" pattern="^([1-9][0-9]{0,2}|500)$" value="{{$item->Cantidad}}" required></td>
                                            <?php  $num++; ?>
										</tr>
										@endforeach

										
									</tbody>
								</table>
							</div>
                            <div class="mb-3">
                                <div id="listaproy"></div>
                            </div>
                        <div class="modal-footer justify-content-end">
                                <a href="/detalles/realizados" type="button" i class="btn btn-danger me-3">Cerrar</a>
                            <button type="submit" id="modadRegistraUsuarios_submit" class="btn btn-primary">
                                <span class="indicator-label">Modificar</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                         
                      
							
						</div>
					</div>
				</div>
			</div>
				
		</div>
		
		
			
		
		
		<!--end::Container-->
	</div> 
	
</div> 
@endsection
@endcan