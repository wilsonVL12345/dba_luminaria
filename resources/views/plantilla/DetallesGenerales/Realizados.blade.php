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
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Trabajos de Mantenimientos Realizados</h1>
				<!--end::Title-->
				<!--begin::Separator-->
				<span class="h-20px border-gray-300 border-start mx-4"></span>
				
			</div>
			<!--end::Page title-->
		
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
					
					<div class="margin">
						@include('layout.notificacioncrud')

						<div class="card card-p-0 card-flush">
							<div class="card-header align-items-center py-5 gap-2 gap-md-5">
								<div class="card-title">
									<!--begin::Search-->
									<div class="d-flex align-items-center position-relative my-1">
										<span class="svg-icon fs-1 position-absolute ms-4">...</span>
										<input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Report" />
									</div>
									<!--end::Search-->
									<!--begin::Export buttons-->
									<div id="kt_datatable_example_1_export" class="d-none"></div>
									<!--end::Export buttons-->
								</div>
								<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
									<!--begin::Export dropdown-->
									<button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
										<i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
										Export Report
									</button>
									<!--begin::Menu-->
									<div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<a href="#" class="menu-link px-3" data-kt-export="copy">
											Copy to clipboard
											</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<a href="#" class="menu-link px-3" data-kt-export="excel">
											Export as Excel
											</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<a href="#" class="menu-link px-3" data-kt-export="csv">
											Export as CSV
											</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<a href="#" class="menu-link px-3" data-kt-export="pdf">
											Export as PDF
											</a>
										</div>
										<!--end::Menu item-->
									</div>
									<!--end::Menu-->
									<!--end::Export dropdown-->
	
									<!--begin::Hide default export buttons-->
									<div id="kt_datatable_example_buttons" class="d-none"></div>
									<!--end::Hide default export buttons-->
								</div>
							</div>
							<div class="card-body">
								<table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="detalleRealizado">
									<thead>
										<!--begin::Table row-->
										<tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
											<th class="min-w-100px">Distrito</th>
											<th class="min-w-100px">Urbanizacion</th>
											<th class="min-w-100px">Nro Sisco</th>
											<th class="min-w-100px" style="min-width: 150px;">Tipo de Trabajo</th>
											<th class="min-w-100px">Puntos</th>
											<th class="min-w-100px">Fecha de Atencion</th>
											<th class="min-w-100px">Carta</th>
											<th class="text-end min-w-100px pe-5">Observaciones</th>
											<th class="text-end min-w-100px pe-5">Detalles</th>
											<th class="min-w-100px">Actividades</th>
										</tr>
										<!--end::Table row-->
									</thead>
									<tbody class="fw-semibold text-gray-600">
										@foreach ($detallesrealizados as $itemtrab)
										<tr class="text-start text-gray-500 fw-bold fs-7">
											<td>
												<a href="#" class="text-gray-900 text-hover-primary">{{$itemtrab->distrito->Distrito}}</a>
											</td>
											<td>
												<a href="#" class="text-gray-900 text-hover-primary">{{$itemtrab->Zona}}</a>
											</td>
											<td>
												<div class="text-gray-900 text-hover-primary">{{$itemtrab->Nro_Sisco}}</div>
											</td>
											<td style="min-width: 150px;">
												<a href="#" class="text-gray-900 text-hover-primary">{{$itemtrab->Tipo_Trabajo}}</a>
											</td>
											<td>
												<a href="#" class="text-gray-900 text-hover-primary">{{$itemtrab->Puntos}}</a>
											</td>
											<td>
												<div class="text-gray-900 text-hover-primary">{{$itemtrab->Fecha_Inicio}}</div>
											</td>
											
											@if ($itemtrab->Foto_Carta)
											<td>
												<a href="#" class="text-gray-900 text-hover-primary" data-bs-toggle="modal" data-bs-target="#modalMostrarImagen{{$itemtrab->id}}"><i class="fa-solid fa-image"></i></a>
											</td>
											@else
											<td data-filter="mastercard">
												<a href="#" ></a>
											</td>
											@endif
											<td> 
												<div class="badge badge-light-danger">
													{{$itemtrab->Observaciones}}

												</div>

											</td>
											<td>
												<a href="{{url('detalle/realizados/informacion/'.$itemtrab->id) }}" class="text-gray-600 text-hover-primary mb-1"><i class="fa-regular fa-eye"></i>
												{{-- <a href="#" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalMostrarImagen{{$item->id}}"><i class="fa-solid fa-image"></i></a> --}}

											</td>
											<!--begin::Action=-->
											<td class="text-end">
												<a href="#" class="btn btn-sm btn-light btn-active-light-primary"
													data-kt-menu-trigger="click"
													data-kt-menu-placement="bottom-end">Actions
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
													<span class="svg-icon svg-icon-5 m-0">
														<svg xmlns="http://www.w3.org/2000/svg" width="24"
															height="24" viewBox="0 0 24 24" fill="none">
															<path
																d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
																fill="currentColor" />
														</svg>
													</span>
													<!--end::Svg Icon--></a>
												<!--begin::Menu-->
												<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
													data-kt-menu="true">
													<!--begin::Menu item-->
													{{-- <div class="menu-item px-3">
														<a href="{{url('/datos/ejecutar/'.$item->id)}}" 
															class="menu-link px-3">Instalar</a>
													</div> --}}
													<div class="menu-item px-3">
														<a href="#" data-bs-toggle="modal" data-bs-target="#modalModificarRealizado{{$itemtrab->id}}"
															class="menu-link px-3">Editar</a>
													</div>
													<!--end::Menu item-->
													<!--begin::Menu item-->
													<div class="menu-item px-3">
														
														<a href="{{-- {{url('/usuario/bloquear/'.$item->id) }} --}}" class="menu-link px-3"
															data-kt-customer-table-filter="delete_row">Eliminar</a>
														
													</div>
													<!--end::Menu item-->
												</div>
												<!--end::Menu-->
											</td>
											<!--end::Action=-->
											<!--begin::Modal -imagen carta-->
											<div class="modal fade" id="modalMostrarImagen{{$itemtrab->id}}" tabindex="-1" aria-hidden="true">
												<!--begin::Modal dialog-->
												<div class="modal-dialog mw-700px">
													<!--begin::Modal content-->
													<div class="modal-content">
														<!--begin::Modal header-->
														<div class="modal-header pb-0 border-0 d-flex justify-content-end">
															<!--begin::Close-->
															<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
																<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
																<span class="svg-icon svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
																		<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</div>
															<!--end::Close-->
														</div>
														<!--end::Modal header-->
														<!--begin::Modal body-->
														<div class="modal-body scroll-y mx-5 mx-xl-10 pt-0 pb-15">
															<!--begin::Heading-->
															<div class="text-center mb-13">
																<!--begin::Title-->
																<h1 class="d-flex justify-content-center align-items-center mb-3">Visualizacion de la Carta Emviada
																</h1>
																<!--end::Title-->
																<!--begin::Description-->
																
																<!--end::Description-->
															</div>
															<!--end::Heading-->
															<!--begin::Users-->
															<div class="mh-475px scroll-y me-n7 pe-7">
																<img src="{{$itemtrab->Foto_Carta}}" class="img-fluid" alt="Descripción de la Carta Emviada">
															</div>
															<!--end::Users-->
														</div>
														<!--end::Modal Body-->
													</div>
													<!--end::Modal content-->
												</div>
												<!--end::Modal dialog-->
											</div>
											<!--end::Modal - imagen carta-->
											{{-- modal para modificar trabajos realizados --}}
											<div class="modal fade" id="modalModificarRealizado{{$itemtrab->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
												<!--begin::Modal dialog-->
												<div class="modal-dialog mw-1000px">
													<!--begin::Modal content-->
													<div class="modal-content">
														<!--begin::Modal header-->
														<div class="modal-header">
															<!--begin::Title-->
															<h2>Modificar Trabajos Realizados</h2>
															<!--end::Title-->
															<!--begin::Close-->
															<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
																<span class="svg-icon svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
																		<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
																	</svg>
																</span>
															</div>
															<!--end::Close-->
														</div>
														<!--end::Modal header-->
														<!--begin::Modal body-->
														<div class="modal-body scroll-y m-5">
															<form class="form" action="{{route('edit.realizado',$itemtrab->id)}}" id="formaModRealizado" method="POST" enctype="multipart/form-data">
																@csrf
																<div class="modal-body py-10 px-lg-17">
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
																				<select class="form-control form-select-solid" data-control="select2" data-dropdown-parent="#modalModificarRealizado{{$itemtrab->id}}" name="slurbr" data-id="slurbr" required>
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
																			<div class="col-md-3 mb-3" id="apoyoDistR"  style="display: none;" >
																				
																					@php
																						// Extraer el número del campo de tipo de trabajo
																						preg_match('/D-(\d+)/', $itemtrab->Tipo_Trabajo, $matches);
																						$numeroDistrito = isset($matches[1]) ? (int)$matches[1] : null;
																					@endphp

																					<label for="txtcontratacion" class="required fs-5 fw-bold mb-2">Apoyo a Distrito</label>
																					<select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selecione..." name="apoyoDistRealizado" data-id="apoyoDistRealizado">
																						<option value="">Seleccione...</option>
																						@foreach ($listdistritos as $item)
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
																			<div class="col-md-3 mb-3">
																				<label for="file1" class=" fs-5 fw-bold mb-2">Subir Carta</label>
																				<input type="file" class="form-control form-control-solid" id="file1" name="file1" accept="image/*" >
																			</div>
																			<div class="col-md-3 mb-3">
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
											
																	<div class="mb-3">
																		<div id="listaproy"></div>
																	</div>
																</div>
																<div class="modal-footer justify-content-end">
																	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
											{{-- endmodal para modificar trabajos realizados --}}
										</tr>
											@endforeach
											
									</tbody>
								</table>
							</div>
						</div>
					</div>

									
				</div>
			</div>
			
		</div>
		
		
			
		
	</div>
		<!--end::Container-->
</div> 
	

@endsection