@can('proyecto.show')

@extends('layout.index')

@section('contenido')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="toolbar" id="kt_toolbar">
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Proyectos Finalizados</h1>
				<span class="h-20px border-gray-300 border-start mx-4"></span>
				
			</div>
		</div>
	</div>
	{{-- todo el lugar que te interesa --}}
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<div class="card mb-5 mb-xl-10">
				<div class="card-body pt-9 pb-0">
					<div class="card-body pt-9 pb-0">
						
						<div class="margin">
							@include('layout.notificacioncrud')
								<div class="card-header align-items-center py-5 gap-2 gap-md-5">
									<div class="card-title">
										<!--begin::Search-->
										<div class="d-flex align-items-center position-relative my-1">
											<span class="svg-icon fs-1 position-absolute ms-4">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" {...$$props}>
													<g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9">
														<path d="m11.25 11.25l3 3" />
														<circle cx="7.5" cy="7.5" r="4.75" />
													</g>
												</svg>
											</span>
											<input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Report" />
										</div>
										<!--end::Search-->
										<!--begin::Export buttons-->
										<div id="kt_datatable_example_1_export" class="d-none"></div>
										<!--end::Export buttons-->
									</div>
								@can('proyecto.export')

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
									@endcan
								</div>
								<div class="card-body">
									<table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="tablaEjecutado">
										<thead>
											<!--begin::Table row-->
											<tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
												
												<th class="min-w-100px">Cuce</th>
												<th class="min-w-100px">Distrito</th>
												<th class="min-w-100px">Urbanizacion </th>
												<th class="min-w-100px">Fecha</th>
												<th class="min-w-100px">Tipo de Componentes</th>
												<th class="min-w-100px">Ejecutado Por </th>
												<th class="min-w-100px">Detalles</th>
												<th class="min-w-100px">Actividad</th>
											</tr>
											<!--end::Table row-->
										</thead>
										<tbody class="fw-semibold text-gray-600">
											{{-- @foreach ($proyectoObras as $items)
																<?php
																$cant=0;
																$totalcant=0;
																$cantlum=0;
																$totallum=0;
																$cantreu=0;
																$totalreu=0;
																$total=0;
																$totalgeneral=0;
																?>									
																@foreach ($accesorio as $acce)
																
																		@if($items->id==$acce->Proyectos_id)
																			@if ($acce->Disponibles>0)
																			<?php
																			$cant=$cant+$acce->Disponibles;
																			$totalcant=$totalcant+$acce->Cantidad;
																			?>	
																			
																			@endif
																		@endif
																@endforeach
																@foreach ($luminaria as $lum)
																
																		@if($items->id==$lum->Proyectos_id)
																			@if ($lum->Lugar_Instalado=='Si')
																				
																			@else
																			<?php
																			$cantlum++;
																			$totallum++;
																			?>	
																				
																			@endif
																		@endif
																@endforeach
																@foreach ($reutilizada as $reu)
																
																		@if($items->id==$reu->Proyectos_id)
																			@if ($reu->Disponibles>0)
																			<?php
																			$cantreu=$cantreu+$reu->Disponibles;
																			$totalreu=$totalreu+$reu->Cantidad;
																			?>	
																			@endif
																		@endif
																@endforeach
																<?php
																$total=$totalcant+$totallum+$totalreu;
																$totalgeneral=$cant+$cantreu+$cantlum;
																?>
											<tr class="text-start text-gray-500 fw-bold fs-7" style="">


												<td>
													<a href="#" class="text-gray-900 text-hover-primary">{{$items->Cuce_Cod}}</a>
												</td>
												<td>
													<a href="#" class="text-gray-900 text-hover-primary">{{$items->distrito->Distrito}}</a>
												</td>
												<td>
													<div class="text-gray-900 text-hover-primary">{{$items->Zona}}</div>
												</td>
												<td>
													<a href="#" class="text-gray-900 text-hover-primary">{{$items->Fecha_Ejecutada}}</a>
												</td>
												<td>
													<a href="#" class="text-gray-900 text-hover-primary">{{$items->Tipo_Componentes}}</a>
												</td>
												<td>
													<div class="text-gray-900 text-hover-primary">{{$items->Ejecutado_Por}}</div>
												</td>
												
												<td>
													<a href="{{url('/detallesAccesorios/almacen/'.$items->id) }}" class="text-gray-900 text-hover-primary"><i class="fa-regular fa-eye"></i></a>
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
																@can('proyecto.install')
																
																
																@if ($cant>0 || $cantreu>0 || $cantlum>0 )

																<div class="menu-item px-3">
																	
																	<a href="{{url('/datos/ejecutar/'.$items->id)}}" 
																		class="menu-link px-3">Terminar Inst </a>
																</div>
																@endif
																<!--begin::Menu items-->
																@endcan
														@can('proyecto.edit')

																<div class="menu-item px-3">
																	<a href="{{url('/showModificar/obras/'.$items->id)}}"  
																		class="menu-link px-3">Editar </a>
																</div>
														@endcan
																<!--end::Menu item-->
																<!--begin::Menu item-->
														@can('proyecto.delete')
																
																<div class="menu-item px-3">
																	
																	<a href="{{url('/eliminar/proyecto'.$items->id) }}" class="menu-link px-3 delete-link"
																		data-kt-customer-table-filter="delete_row">Eliminar</a>
																	
																</div>
														@endcan
														@can('proyecto.report')


																<div class="menu-item px-3">
																	
																	<a href="{{url('/Almacen/detalles/pdf'.$items->id) }}" class="menu-link px-3" target="_blank"
																		data-kt-customer-table-filter="delete_row">Reporte</a>
																	
																</div>
														@endcan
																<!--end::Menu item-->
															</div>
															<!--end::Menu-->
												</td>
												<!--end::Action=-->
												@can('proyecto.edit')
												@endcan
											</tr>
											@endforeach --}}
										</tbody>
									</table>
								</div>
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
@endcan