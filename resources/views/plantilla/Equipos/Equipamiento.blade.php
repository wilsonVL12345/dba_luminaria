@can('equipamiento.show')
	
@extends('layout.index')

@section('contenido')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="toolbar" id="kt_toolbar">
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Equipamientos Distritales</h1>
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
							<a href="/equipamiento/distrito"  >
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
									<input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Buscar..." />
								</div>
								<!--end::Search-->
								<!--begin::Export buttons-->
								<div id="kt_datatable_example_1_export" class="d-none"></div>
								<!--end::Export buttons-->
							</div>
							@can('equipamiento.export')
								
							<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
								<!--begin::Export dropdown-->
								<button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
									<i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
									Generar Reporte
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
							<table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="equipamientotabla">
								<thead>
									<!--begin::Table row-->
									<tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
												<th class="min-w-125px">Nombre Equipamiento</th>
												<th class="min-w-125px">Descripcion</th>
												<th class="min-w-125px">Estado</th>
												<th class="min-w-125px">Distrito</th>
												<th class="text-end min-w-70px">Actividades</th>
									</tr>
									<!--end::Table row-->
								</thead>
								<tbody class="text-gray-600">
									{{-- @foreach ($equipos as $itememp)
									<tr class="text-start text-gray-500 fw-bold fs-7">
										<td>
											<a href="#" class="text-gray-900 text-hover-primary">{{$itememp->Nombre_Item}}</a>
										</td>
										<td>
											<a href="#" class="text-gray-900 text-hover-primary">{{$itememp->Descripcion}}</a>
										</td>
										<td>
											<div class="text-gray-900 text-hover-primary">{{$itememp->estado}}</div>
										</td>
										<td>
											<a href="#" class="text-gray-900 text-hover-primary">{{$itememp->distrito->Distrito}}</a>
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
												@can('equipamiento.edit')
												
												<div class="menu-item px-3">
													<a href="#" data-bs-toggle="modal" data-bs-target="#modalModificar{{$itememp->id}}" class="menu-link px-3">Editar</a>
												</div>
												@endcan

												<!--end::Menu item-->
												<!--begin::Menu item-->
												@can('equipamiento.delete')
												<div class="menu-item px-3">
													<a href="{{url('/eliminar/equipamiento'.$itememp->id) }}" class="menu-link px-3 delete-link" data-kt-customer-table-filter="delete_row">Eliminar</a>
												</div>
												@endcan

												<!--end::Menu item-->
											</div>
										</td>
										<!--modal para modificar-->
										@can('equipamiento.edit')
										<div class="modalmodificar">
											<div class="modal fade" id="modalModificar{{$itememp->id}}" tabindex="-1" aria-hidden="true">
												<!--begin::Modal dialog-->
												<div class="modal-dialog modal-dialog-centered mw-650px">
													<!--begin::Modal content-->
													<div class="modal-content">
														<!--begin::Form-->
														<form class="form" action="{{route("editar.equipamiento")}}" id="formEquipamiendotModificar" data-kt-redirect="assets/dist/apps/customers/list.html" method="POST" >
															@csrf
															<!--begin::Modal header-->
															<div class="modal-header" id="kt_modal_add_customer_header">
																<!--begin::Modal title-->
																<h2 class="fw-bolder">Modificar Equipamiento</h2>
																
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
														
															<div class="modal-body py-10 px-lg-17">
																<!--begin::Scroll-->
																<div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Label-->
																		<input type="text" class="form-control" id="txtid" aria-describedby="emailHelp" name="txtid" value="{{$itememp->id}}" style="display: none;">
																		<label class="d-flex align-items-center fs-6 fw-bold mb-2">
																			<span class="required">Nombre Item</span>
																			<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números letras mayusculas y minusculas - ()"></i>

																		</label>
																		<!--end::Label-->
																		<!--begin::Input-->
																		<input type="text" class="form-control form-control-solid" placeholder="Ingrese el Nombre de el Equipamiento" name="txtnombre" id="txtnombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\-\(\)\. ]*"  value="{{$itememp->Nombre_Item}}" required />
																		<!--end::Input-->
																	</div>
																	<!--end::Input group-->
																	<!--begin::Input group-->
																	<div class="fv-row mb-7">
																		<!--begin::Input group-->
																		<div class="d-flex flex-column mb-8">
																			<label class="d-flex align-items-center fs-6 fw-bold mb-2">
																				<span class="required">Descripcion</span>
																			</label>
																			<textarea class="form-control form-control-solid" rows="3" name="txtdescripcion" id="txtdescripcion" placeholder="Ingrese una Breve Descripcion" >{{$itememp->Descripcion}}</textarea>
																		</div>
																		<!--end::Input group-->
																		
																	</div>
																	<div class="row g-9 mb-8">
																		<!--begin::Col-->
																		<div class="col-md-6 fv-row">
																			<label class="d-flex align-items-center fs-6 fw-bold mb-2">
																				<span class="required">Estado</span>
																			</label>
																			<select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Seleccione..." name="txtestado" id="txtestado"   required>
																				<option value="" disabled selected>Seleccione...</option>
																				<option value="Malo"{{$itememp->estado == 'Malo' ? 'selected' : ''}}>Malo </option>
																				<option value="Regular"{{$itememp->estado == 'Regular' ? 'selected' : ''}}>Regular </option>
																				<option value="Bueno"{{$itememp->estado == 'Bueno' ? 'selected' : ''}}>Bueno </option>
																				<option value="En Mantenimiento"{{$itememp->estado == 'En Mantenimiento' ? 'selected' : ''}}>En Mantenimiento</option>
																			
																			</select>
																		</div>
																		<!--end::Col-->
																		<!--begin::Col-->
																		<div class="col-md-6 fv-row">
																			<label class="d-flex align-items-center fs-6 fw-bold mb-2">
																				<span class="required">Distrito</span>
																			</label>
																			<select class="form-control  form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Seleccione..." name="txtdistrito" id="txtdistrito" required>
																				<option value="" disabled selected>Seleccione...</option>
																				@foreach ($lista as $ite)
																				<option value="{{$ite->id}}" {{$ite->Distrito == $itememp->distrito->Distrito ? 'selected' : ''}}>{{$ite->Distrito}}</option>
																				@endforeach
																			</select>
																		</div>
																		<!--end::Col-->
																	</div>
																
																</div>
																<!--end::Scroll-->
															</div>
															<!--end::Modal body-->
															<!--begin::Modal footer-->
															<div class="modal-footer flex-center">
																<div class="text-center">
																	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
																	<button type="submit" class="btn btn-primary">Registrar</button>
																	
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
										<!--end::endmodal para modificar-->
									</tr>
									@endforeach --}}
								</tbody>
							</table>
							<!--modal para modificar-->
							@can('equipamiento.edit')
							<div class="modalmodificar">
								<div class="modal fade" id="modalModificar" tabindex="-1" aria-hidden="true">
									<!--begin::Modal dialog-->
									<div class="modal-dialog modal-dialog-centered mw-650px">
										<!--begin::Modal content-->
										<div class="modal-content">
											<!--begin::Form-->
											<form class="form" action="{{route("editar.equipamiento")}}" id="formEquipamiendotModificar" data-kt-redirect="assets/dist/apps/customers/list.html" method="POST" >
												@csrf
												<!--begin::Modal header-->
												<div class="modal-header" id="kt_modal_add_customer_header">
													<!--begin::Modal title-->
													<h2 class="fw-bolder">Modificar Equipamiento</h2>
													
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
											
												<div class="modal-body py-10 px-lg-17">
													<!--begin::Scroll-->
													<div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
														<!--begin::Input group-->
														<div class="fv-row mb-7">
															<!--begin::Label-->
															<input type="text" class="form-control" id="txtid" aria-describedby="emailHelp" name="txtid"  style="display: none;">
															<label class="d-flex align-items-center fs-6 fw-bold mb-2">
																<span class="required">Nombre Item</span>
																<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números letras mayusculas y minusculas - ()"></i>

															</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input type="text" class="form-control form-control-solid" placeholder="Ingrese el Nombre de el Equipamiento" name="txtnombre" id="txtnombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\-\(\)\. ]*"   required />
															<!--end::Input-->
														</div>
														<!--end::Input group-->
														<!--begin::Input group-->
														<div class="fv-row mb-7">
															<!--begin::Input group-->
															<div class="d-flex flex-column mb-8">
																<label class="d-flex align-items-center fs-6 fw-bold mb-2">
																	<span class="required">Descripcion</span>
																</label>
																<textarea class="form-control form-control-solid" rows="3" name="txtdescripcion" id="txtdescripcion" placeholder="Ingrese una Breve Descripcion" ></textarea>
															</div>
															<!--end::Input group-->
															
														</div>
														<div class="row g-9 mb-8">
															<!--begin::Col-->
															<div class="col-md-6 fv-row">
																<label class="d-flex align-items-center fs-6 fw-bold mb-2">
																	<span class="required">Estado</span>
																</label>
																<select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Seleccione..." name="txtestado" id="txtestado"   required>
																	<option value="" disabled selected>Seleccione...</option>
																	<option value="Malo">Malo </option>
																	<option value="Regular">Regular </option>
																	<option value="Bueno">Bueno </option>
																	<option value="En Mantenimiento">En Mantenimiento</option>
																
																</select>
															</div>
															<!--end::Col-->
															<!--begin::Col-->
															<div class="col-md-6 fv-row">
																<label class="d-flex align-items-center fs-6 fw-bold mb-2">
																	<span class="required">Distrito</span>
																</label>
																<select class="form-control  form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Seleccione..." name="txtdistrito" id="txtdistrito" required>
																	<option value="" disabled selected>Seleccione...</option>
																	@foreach ($lista as $ite)
																	<option value="{{$ite->id}}" >{{$ite->Distrito}}</option>
																	@endforeach
																</select>
															</div>
															<!--end::Col-->
														</div>
													
													</div>
													<!--end::Scroll-->
												</div>
												<!--end::Modal body-->
												<!--begin::Modal footer-->
												<div class="modal-footer flex-center">
													<div class="text-center">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
														<button type="submit" id="btnGuardarCambios" class="btn btn-primary registers-link">Registrar</button>
														
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
							<!--end::endmodal para modificar-->
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
@push('scriptsvistas')
<script src="{{ asset('assets/js/equipos/equipamiento/tablaequipos.js') }}" defer></script>
		
	@endpush
@endcan
