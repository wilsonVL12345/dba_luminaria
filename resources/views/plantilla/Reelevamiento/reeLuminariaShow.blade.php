@can('Reelevamiento.show')

@extends('layout.index')

@section('contenido')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="toolbar" id="kt_toolbar">
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Detalles de Reelevamientos Distritales</h1>
				<span class="h-20px border-gray-300 border-start mx-4"></span>
				
			</div>
		
			
		</div>
	</div>
	{{-- todo el lugar que te interesa --}}
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Navbar-->
			<div class="card mb-5 mb-xl-10">
				<div class="card-body pt-9 pb-0">
						
					
					
				<div class="margin">
					<!--begin::Modal - registrar equipamiento - Add-->
					<div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
						<!--begin::Modal dialog-->
						<div class="modal-dialog modal-dialog-centered mw-650px">
							<!--begin::Modal content-->
							<div class="modal-content">
								<!--begin::Form-->
							
								<!--end::Form-->
							</div>
						</div>
					</div>
							<!--endbegin::Modal - registrar equipamiento - Add-->

					{{-- <div>
					</div> --}}
					@include('layout.notificacioncrud')
					<div class="card card-p-0 card-flush" >
							<div style="display: flex; justify-content: flex-end;">
								<a href="/reelevamientos"  >
									<span class="svg-icon svg-icon-5 m-0">
										<svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 256 256" {...$$props}>
											<path fill="currentColor" d="M228 128a12 12 0 0 1-12 12H69l51.52 51.51a12 12 0 0 1-17 17l-72-72a12 12 0 0 1 0-17l72-72a12 12 0 0 1 17 17L69 116h147a12 12 0 0 1 12 12" />
										</svg>
									</span>
								</a>
								
							</div>
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
							@can('Reelevamiento.export')
							
								
							<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
								<!--begin::Export dropdown-->
								<button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
									<i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
									Export Report
								</button>

								<!--begin::Add customer-->
								{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Agregar Nuevo</button> --}}
								<!--end::Add customer-->
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
							<table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="reelevamientoLuminaria">
								<thead>
									<!--begin::Table row-->
									<tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
												<th class="min-w-125px">Av / Calle</th>
												<th class="min-w-125px">Urbanizacion</th>
												<th class="min-w-125px">Distrito</th>
												<th class="min-w-125px">Fecha</th>
												<th class="min-w-125px">Descripcion</th>
												<th class="min-w-125px">Archivo</th>
												<th class="text-end min-w-70px">Actividades</th>
									</tr>
									<!--end::Table row-->
								</thead>
								<tbody class="text-gray-600">
									{{-- @foreach ($showReele as $reele)
									<tr class="text-start text-gray-500 fw-bold fs-7">
										<td>
											<a href="#" class="text-gray-900 text-hover-primary">{{$reele->Av_calles}}</a>
										</td>
										<td>
											<a href="#" class="text-gray-900 text-hover-primary">{{$reele->Urbanizacion->nombre_urbanizacion}}</a>
										</td>
										<td>
											<a href="#" class="text-gray-900 text-hover-primary">{{$reele->distrito->Distrito}}</a>
										</td>
										<td>
											<a href="#" class="text-gray-900 text-hover-primary">{{$reele->Fecha}}</a>
										</td>
										
										
										<td>
											<a href="#" class="text-gray-900 text-hover-primary">{{$reele->Descripcion}}</a>
										</td>
										<td>
											<a href="{{asset($reele->Archivos)}}" download class="text-gray-900 text-hover-primary">
												<img src="{{asset('assets/media/icons/rarblue.png')}}" width="40" height="40"></a>
										</td>
										<td class="text-end">
											<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
											<span class="svg-icon svg-icon-5 m-0">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
												</svg>
											</span>
											<!--end::Svg Icon--></a>
											<!--begin::Menu-->
											<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
												<!--begin::Menu item-->
												@can('Reelevamiento.edit')
												
												<div class="menu-item px-3">
													<a href="#" data-bs-toggle="modal" data-bs-target="#modalModificarReele{{$reele->id}}" class="menu-link px-3">Editar</a>
												</div>
												@endcan
												

												<!--end::Menu item-->
												<!--begin::Menu item-->
												@can('Reelevamiento.delete')
												<div class="menu-item px-3">
													<a href="{{url('/eliminar/reelevamiento'.$reele->id) }}" class="menu-link px-3 delete-link" data-kt-customer-table-filter="delete_row">Eliminar</a>
												</div>
												@endcan

												<!--end::Menu item-->
											</div>
										</td>
										@can('Reelevamiento.edit')
										<div class="modalmodificar">
											<div class="modal fade" id="modalModificarReele{{$reele->id}}" tabindex="-1" aria-hidden="true">
												<!--begin::Modal dialog-->
												<div class="modal-dialog modal-dialog-centered mw-650px">
													<!--begin::Modal content-->
													<div class="modal-content">
														 <form class="form" action="{{route('reelevamiento.modificar',$reele->id)}}" id="reelevamientoCreate" data-kt-redirect="assets/dist/apps/customers/list.html" enctype="multipart/form-data" method="POST" >
															@csrf
															<!--begin::Modal header-->
															<div class="modal-header" id="kt_modal_add_customer_header">
																<!--begin::Modal title-->
																<h2 class="fw-bolder">Modificar Reelevamiento</h2>
																<!--end::Modal title-->
																<!--begin::Close-->
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
																<!--end::Close-->
															</div>
															<!--end::Modal header-->
															<!--begin::Modal body-->
															<div class="modal-body py-10 px-lg-17">
																<!--begin::Scroll-->
																<div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<label class="required fs-5 fw-bold mb-2">AV o Calles
																			<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números letras mayusculas y minusculas - ()"></i>
							
																		</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input type="text" class="form-control form-control-solid" placeholder="Ingrese el Nombre de el Equipamiento" name="reeAvCalleMod" id="reeAvCalleMod" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\-\(\)\., ]*"
																		required value="{{$reele->Av_calles}}" />
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Input group-->
																		<div class="d-flex flex-column mb-8">
																			<label class=" fs-5 fw-bold mb-2">Descripcion</label>
																			<textarea class="form-control form-control-solid" rows="3" name="reeDescripRegisMod" id="reeDescripRegisMod" placeholder="Ingrese una Breve Descripcion"  >{{$reele->Descripcion}}</textarea>
																		</div>
																		<!--end::Input group-->
																		
																	</div>
																	<div class="row g-6 mb-4">
																		 <!--begin::Col-->
																		 <div class="col-md-3 fv-row">
																			<label class="required fs-5 fw-bold mb-2">Distrito</label>
																			<select class="form-control form-select-solid" data-control="select2" data-search="false" data-dropdown-parent="#modalModificarReele{{$reele->id}}" data-hide-search="true" data-placeholder="Selecione..." name="reeDistritoRegisMod" data-id="reeDistritoRegisMod"
																			  required >
																				<option value="">Seleccione...</option>
																				@foreach ($lista as $ite)
																				<option value="{{$ite->id}}" {{$reele->Distritos_id==$ite->id?'selected':''}}>{{$ite->Distrito}}</option>
																				@endforeach
																			</select>
																		</div>
																		<div class="col-md-6 mb-4">
																			<label class="required fs-5 fw-bold mb-2">Fecha Programada
																				<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permite fechas actuales"></i>
								
																			</label>
																			<!--begin::Input-->
																			<div class="position-relative d-flex align-items-center">
																				<!--begin::Icon-->
																				<!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
																				<span class="svg-icon svg-icon-2 position-absolute mx-4">
																					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																						<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor" />
																						<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor" />
																						<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor" />
																					</svg>
																				</span>
																				<!--end::Svg Icon-->
																				<!--end::Icon-->
																				<!--begin::Datepicker-->
																				<input type="date" class="form-control form-control-solid ps-12" placeholder="Select a date" name="reeFechaRegisMod" id="reeFechaRegisMod" value="{{$reele->Fecha}}"    required />
																				<!--end::Datepicker-->
																			</div>
																			<!--end::Input-->
																		</div>
																		<!--end::Col-->
																		<!--begin::Col-->
																	   
																		<!--end::Col-->
																	   
																	</div>
																	<div class="from row">
																		<label for="reeUrbanizacionRegis" class="required fs-5 fw-bold mb-2">Urbanizacion</label>
																		
																		<select aria-label="Seleccionar Urbanización"
																			data-control="select2"
																			data-placeholder="Seleccionar Urbanización"
																			data-dropdown-parent="#modalModificarReele{{$reele->id}}"
																			class="form-control form-select-solid" 
																			name="reeUrbanizacionRegisMod" 
																			data-id="reeUrbanizacionRegisMod" 
																			required>
																			
																			<!-- Opción seleccionada por defecto -->
																			<option value="{{$reele->Urbanizacion_id}}" selected>{{$reele->urbanizacion->nombre_urbanizacion}}</option>
																		</select>
																	</div>
																	<br>
							
																	 <!--begin::Dropzone-->
																	
																	 <div class="col-md-9 mb-4">
																		<label class=" fs-5 fw-bold mb-2">Subir Archivo</label>
																		<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten Archivos .RAR o .ZIP"></i>
							   
																		<input type="file" id="flrarMod" name="flrarMod" accept=".rar,.zip" class="form-control" >
																			@error('flrar')
																				<small class="text-danger">{{$message}}</small>
																			@enderror
							
																	</div>
																	<br>
																	
																
																</div>
																<!--end::Scroll-->
															</div>
															<!--end::Modal body-->
															<!--begin::Modal footer-->
															<div class="modal-footer flex-center">
																<div class="text-center">
																	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
																	<button type="submit" id="submitButtons" class="btn btn-primary">Modificar</button>
																	
																</div>
															
															</div>
															<!--end::Modal footer-->
														</form>
														<!--end::Form-->
													</div>
												</div>
											</div>
											<!--begin::Modal - New Target-->

										</div>
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
				
		<!--end::Container-->
</div> 
@endsection
@endcan
