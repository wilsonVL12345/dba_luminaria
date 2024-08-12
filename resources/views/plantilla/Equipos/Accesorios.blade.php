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
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Lista de Accesorios Disponibles</h1>
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
					
						
						<div class="margin">
							{{-- modal registro accesorios  --}}
							<div class="modal fade" id="modalRegistroAccesorios" tabindex="-1" aria-hidden="true">
								<!--begin::Modal dialog-->
								<div class="modal-dialog modal-dialog-centered mw-650px">
									<!--begin::Modal content-->
									<div class="modal-content">
										<!--begin::Modal header-->
										<div class="modal-header" id="kt_modal_create_api_key_header">
											<!--begin::Modal title-->
											<h2>Componentes</h2>
											<!--end::Modal title-->
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
										<!--begin::Form-->
										<form id="formaccesorios" class="form" action="{{route('registro.accesorios')}}" method="POST">
											@csrf
											<!--begin::Modal body-->
											<div class="modal-body py-10 px-lg-17">
												<!--begin::Scroll-->
												<div class="scroll-y me-n7 pe-7" id="kt_modal_create_api_key_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_create_api_key_header" data-kt-scroll-wrappers="#kt_modal_create_api_key_scroll" data-kt-scroll-offset="300px">
													<!--begin::Notice-->
													
													<!--begin::Input group-->
													<div class="mb-5 fv-row">
														<!--begin::Label-->
														<label class="required fs-5 fw-bold mb-2">Registrar Nuevo Accesorio
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números letras mayusculas y minusculas - ()"></i>

														</label>
														<!--end::Label-->
														<!--begin::Input-->
														<input type="text" class="form-control form-control-solid" placeholder="Ingrese el Nombre del componente" name="txtnombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\-\(\)\.]*" />
														<!--end::Input-->
													</div>
													<!--end::Input group-->
													<!--begin::Input group-->
													
													
												</div>
												<!--end::Scroll-->
											</div>
											<!--end::Modal body-->
											<!--begin::Modal footer-->
											<div class="modal-footer flex-center">
												<!--begin::Button-->
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

												<!--end::Button-->
												<!--begin::Button-->
												<button type="submit" class="btn btn-primary">Registrar</button>

												<!--end::Button-->
											</div>
											<!--end::Modal footer-->
										</form>
										<!--end::Form-->
										
									</div>
									<!--end::Modal content-->
								</div>
								<!--end::Modal dialog-->
							</div>
							{{-- end modal registro accesorios  --}}

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
										<a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal" data-bs-target="#modalRegistroAccesorios">Agregar Componente</a>

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
									<?php
									$num=1;
									?>
									<table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="tableacc">
										<thead>
											<!--begin::Table row-->
											<tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
												<th class="min-w-100px">Nro</th>
												<th class="min-w-100px">Nombre Accesorio</th>
												<th class="min-w-100px">Actividades</th>
												
												
											</tr>
											<!--end::Table row-->
										</thead>
										<tbody class="fw-semibold text-gray-600">
											@foreach ($accesorio as $item)
											<tr class="text-start text-gray-500 fw-bold fs-7">
												<td>
													<a href="#" class="text-gray-900 text-hover-primary"><?php echo $num?></a>
												</td>
												<td>
													<a href="#" class="text-gray-900 text-hover-primary">{{$item->Nombre_Item}}</a>
												</td>
												<td class="text-end">
													<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Action
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
														<div class="menu-item px-3">
															<a href="#" data-bs-toggle="modal" data-bs-target="#modalModificarAccesorios{{$item->id}}" class="menu-link px-3">Editar</a>
														</div>
														<!--end::Menu item-->
														<!--begin::Menu item-->
														<div class="menu-item px-3">
															<a href="{{route('eliminar.accesorios',$item->id)}}" class="menu-link px-3" onclick="return res() " data-kt-customer-table-filter="delete_row">Delete</a>
														</div>
														<!--end::Menu item-->
													</div>
													</td>
													<?php 
													$num++
													?>
													{{-- modal para modificar accesorios --}}
												<div class="modal fade" id="modalModificarAccesorios{{$item->id}}" tabindex="-1" aria-hidden="true">
													<!--begin::Modal dialog-->
													<div class="modal-dialog modal-dialog-centered mw-650px">
														<!--begin::Modal content-->
														<div class="modal-content">
															<!--begin::Modal header-->
															<div class="modal-header" id="kt_modal_create_api_key_header">
																<!--begin::Modal title-->
																<h2>Componentes</h2>
																<!--end::Modal title-->
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
															<!--begin::Form-->
															<form  class="form" action="{{route('editar.accesorios')}}" method="POST">
																@csrf
																<!--begin::Modal body-->
																<div class="modal-body py-10 px-lg-17">
																	<!--begin::Scroll-->
																	<div class="scroll-y me-n7 pe-7" id="kt_modal_create_api_key_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_create_api_key_header" data-kt-scroll-wrappers="#kt_modal_create_api_key_scroll" data-kt-scroll-offset="300px">
																		<!--begin::Notice-->
																		
																		<!--begin::Input group-->
																		<div class="mb-5 fv-row">
																			<!--begin::Label-->
																			<input type="text" name="txtid" id="txtid" value="{{$item->id}}" style="display: none;">
		
																			<label class="required fs-5 fw-bold mb-2">Accesorio
																				<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números letras mayusculas y minusculas - ()"></i>

																			</label>
																			<!--end::Label-->
																			<!--begin::Input-->
																			<input type="text" class="form-control form-control-solid" placeholder="Ingrese el Nombre del componente" name="txtnombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\-\(\)\.]*" value="{{$item->Nombre_Item}}"  required/>
																			<!--end::Input-->
																		</div>
																		<!--end::Input group-->
																		<!--begin::Input group-->
																		
																		
																	</div>
																	<!--end::Scroll-->
																</div>
																<!--end::Modal body-->
																<!--begin::Modal footer-->
																<div class="modal-footer flex-center">
																	<!--begin::Button-->
																	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					
																	<!--end::Button-->
																	<!--begin::Button-->
																	<button type="submit" id="kt_modal_create_api_key_submit" class="btn btn-primary">
																		<span class="indicator-label">Modificar</span>
																		<span class="indicator-progress">Please wait...
																		<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
																	</button>
					
																	<!--end::Button-->
																</div>
																<!--end::Modal footer-->
															</form>
															<!--end::Form-->
															
														</div>
														<!--end::Modal content-->
													</div>
													<!--end::Modal dialog-->
												</div>
													{{-- endmodal para modificar accesorios --}}

											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
						
						{{-- <style>
										
							/* Estilos para filas pares */
							tr:nth-child(even) {
								background-color: #f2f2f2;
							}
							/* Estilos para filas impares */
							tr:nth-child(odd) {
								background-color: #ffffff;
							}
						</style> --}}
				</div>
			</div>
			<div class="card mb-5 mb-xl-10">
				<div class="card-body pt-9 pb-0">
					<h1>Agendar Trabajo</h1>
						
					</div>
				</div>
			</div>
		
		
			
		
		</div>
		<!--end::Container-->
	</div> 
	
</div> 
@endsection