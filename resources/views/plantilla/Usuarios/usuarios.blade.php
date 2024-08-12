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
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Gestionar Usuarios</h1>
				<!--end::Title-->
				<!--begin::Separator-->
				<span class="h-20px border-gray-300 border-start mx-4"></span>
				<!--end::Separator-->
				<!--begin::Breadcrumb-->
				{{-- <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">
						<a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item">
						<span class="bullet bg-gray-300 w-5px h-2px"></span>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">Account</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item">
						<span class="bullet bg-gray-300 w-5px h-2px"></span>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-dark">Security</li>
					<!--end::Item-->
				</ul> --}}
				<!--end::Breadcrumb-->
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
						<div>
							@include('layout.notificacioncrud')
						</div>
						<div class="card card-p-0 card-flush">
							
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
										<input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Buscar Usuarios" />
									</div>
									<!--end::Search-->
									<!--begin::Export buttons-->
									<div id="tablaUsuarios_1_export" class="d-none"></div>
									<!--end::Export buttons-->
								</div>
								<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
									
									<!--begin::Export dropdown-->
									<button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
										<i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
										Export Report
									</button>
									
									<!--begin::Menu-->
									<div id="tablaUsuarios_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
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
										</div>
										</a>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<a href="#" class="menu-link px-3" data-kt-export="pdf">
												Export as PDF
											</a>
										</div>
										<!--end::Menu item-->
								    </div>
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modadRegistraUsuarios">Agregar Nuevo</button>
									<!--end::Menu-->
									<!--end::Export dropdown-->
						
									<!--begin::Hide default export buttons-->
									<div id="tablausuariosexport" class="d-none"></div>
									<!--end::Hide default export buttons-->
								</div>
								<!--begin::Modal - registrar usuarios-->
								<div class="modal fade" id="modadRegistraUsuarios" tabindex="-1" aria-hidden="true">
									<!--begin::Modal dialog-->
									<div class="modal-dialog modal-dialog-centered mw-650px">
										<!--begin::Modal content-->
										<div class="modal-content">
											<!--begin::Form-->
											<form class="form" action="{{route("registro.usuario")}}" id="modadRegistraUsuarios_form" method="POST">
												@csrf
												<!--begin::Modal header-->
												<div class="modal-header" id="modadRegistraUsuarios_header">
													<!--begin::Modal title-->
													<h2>Registrar Nuevo Usuario</h2>
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
												<!--begin::Modal body-->
												<div class="modal-body py-10 px-lg-17">
													<!--begin::Scroll-->
													<div class="scroll-y me-n7 pe-7" id="modadRegistraUsuarios_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modadRegistraUsuarios_header" data-kt-scroll-wrappers="#modadRegistraUsuarios_scroll" data-kt-scroll-offset="300px">
														<!--begin::Notice-->
														<!--begin::Notice-->
														
														<!--end::Notice-->
														<!--end::Notice-->
														<!--begin::Input group-->
														<div class="d-flex flex-column mb-5 fv-row">
															<!--begin::Label-->
															<label class="required fs-5 fw-bold mb-2">Nombres
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Solo se permiten letras y espacios"></i>

															</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input  type="text" class="form-control form-control-solid" placeholder="Ingrese el Nombre" name="txtnombre" pattern="[A-Za-z\s]+"  required  />
															 {{-- @error('txtnombre')
																<span style="color: red;">{{ $message }}</span>
															@enderror --}}
															<!--end::Input-->
														</div> 
														<div class="row mb-5">
															<!--begin::Col-->
															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class="required fs-5 fw-bold mb-2">Paterno
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten letras, sin espacios"></i>

																</label>
																<!--end::Label-->
																<!--begin::Input-->
																<input type="text" class="form-control form-control-solid" placeholder="" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$" name="txtpaterno"  title="Solo se permiten letras y espacios" required  />
																<!--end::Input-->
															</div> 
															<!--end::Col-->
															<!--begin::Col-->
															<div class="col-md-6 fv-row">
																<!--end::Label-->
																<label class="required fs-5 fw-bold mb-2">Materno
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten letras, sin espacios"></i>

																</label>
																<!--end::Label-->
																<!--end::Input-->
																<input type="text" class="form-control form-control-solid" placeholder="" name="txtmaterno" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$" required  />
																<!--end::Input-->
															</div> 
															<!--end::Col-->
														</div>
														<!--end::Input group-->
														<!--begin::Input group-->
														
														<div class="row mb-5">
															<!--begin::Col-->
															<div class="col-md-6 fv-row">
																<!--begin::Label-->
																<label class="required fs-5 fw-bold mb-2">C.I.
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Solo se permiten números de 7 a 8 digitos"></i>

																</label>
																<!--end::Label-->
																<!--begin::Input-->
																<input type="text" class="form-control form-control-solid" placeholder="" name="txtci"  pattern="^[0-9]{7,9}$"
																required  />
																<!--end::Input-->
															</div> 
															<!--end::Col-->
															<!--begin::Col-->
															
																<div class="col-md-6 fv-row">
																	<label class="required fs-6 fw-bold mb-2">Expedido</label>
																	<select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selecione..." name="txtexpedido" required >
																		<option value="" >Seleccione...</option>
 																		<option value="LP">La paz</option>
																		<option value="SCZ">Santa Cruz</option>
																		<option value="CO">Cochabamba</option>
																		<option value="OR">Oruro</option>
																		<option value="PO">Potosí</option>
																		<option value="TJ">Tarija</option>
																		<option value="CH">Chuquisaca</option>
																		<option value="BE">Beni</option>
																		<option value="PA">Pando</option>
																</select>
																</div>
															
															<!--end::Col-->
														</div>
														<div class="d-flex flex-column mb-5 fv-row">
															<!--begin::Label-->
															<label class="required fs-5 fw-bold mb-2">Celular
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números"></i>

															</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input  type="text" class="form-control form-control-solid" placeholder="Ingrese el Nombre" name="txtcelular" required pattern="^[0-9]{7,9}$" id="txtcelular"  />
															<!--end::I requirednput-->
														</div>
														<div class="d-flex flex-column mb-5 fv-row">
															<label class="required fs-6 fw-bold mb-2">Genero</label>
															<select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selecione..." name="txtgenero" required >
																<option value="" >Seleccione...</option>
 																<option value="F">Femenino</option>
																<option value="M">Masculino</option>
														</select>
														</div>
														<!--end::Input group-->
														<div class="col-md-6 fv-row">
															<label class="required fs-6 fw-bold mb-2">Cargo</label>
															<select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selecione..." name="txtcargo" required >
																<option value="" >Seleccione...</option>
																<option value="Administrador">Administrador</option>
																<option value="Coordinador">Coordinador</option>
																<option value="Tecnico">Tecnico</option>
														
															</select>
													
														
													</div>
														<!--begin::Input group-->
														<div class="d-flex flex-column mb-5 fv-row">
															<label class="required fs-6 fw-bold mb-2">Responsable de</label>
																	<select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selecione..." name="txtlugarDesignado" required >
																		<option value="" >Seleccione...</option>
 																		<option value="1">Distrito 1</option> 
																		<option value="2">Distrito 2</option> 
																		<option value="3">Distrito 3</option> 
																		<option value="4">Distrito 4</option> 
																		<option value="5">Distrito 5</option> 
																		<option value="6">Distrito 6</option> 
																		<option value="7">Distrito 7</option> 
																		<option value="8">Distrito 8</option> 
																		<option value="9">Distrito 9</option> 
																		<option value="10">Distrito 10</option> 
																		<option value="11">Distrito 11</option> 
																		<option value="12">Distrito 12</option> 
																		<option value="13">Distrito 13</option> 
																		<option value="14">Distrito 14</option> 
																		<option value="Alcaldia">Alcaldia</option> 
																	</select>
														</div>
														<!--end::Input group-->
														
														<!--begin::Input group-->
														<div class="fv-row mb-5">
															<!--begin::Wrapper-->
															<div class="d-flex flex-stack">
																<!--begin::Label-->
																<div class="me-5">
																	<!--begin::Label-->
																	<label class="fs-5 fw-bold">Desea Habilitar Usuario</label>
																	<!--end::Label-->
																	<!--begin::Input-->
																	<div class="fs-7 fw-bold text-muted">Aviso! si habilita, el usuario podra ingresar al sistema</div>
																	<!--end::Input-->
																</div>
																<!--end::Label-->
																<!--begin::Switch-->
																<label class="form-check form-switch form-check-custom form-check-solid">
																	<!--begin::Input-->
																	<input class="form-check-input" name="txtestado"  type="checkbox" value="1"  checked="checked"  />
																	<!--end::Input-->
																	<!--begin::Label-->
																	<span class="form-check-label fw-bold text-muted">activo</span>
																	<!--end::Label-->
																</label>
																<!--end::Switch-->
															</div>
															<!--begin::Wrapper-->
														</div>
														<!--end::Input group-->
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
													<button type="submit" id="modadRegistraUsuarios_submit" class="btn btn-primary">
														<span class="indicator-label">Registrar</span>
														<span class="indicator-progress">Please wait...
														<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
													</button>
													<!--end::Button-->
												</div>
												<!--end::Modal footer-->
											</form>
											<!--end::Form-->
										</div>
									</div>
								</div>
								<!--end::Modal - registrar usuarios-->
							</div>
							<div class="card-body">
								<table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="tablaUsuarios">
									<thead>
										<tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
											<th class="min-w-100px">name</th>
											<th class="min-w-100px">Paterno</th>
											<th class="min-w-100px">Materno</th>
											<th class="min-w-100px">Status</th>
											<th class="min-w-100px">C.I.</th>
											<th class="text-end min-w-75px">Expedido</th>
											<th class="min-w-100px">Cargo</th>
											
											<th class="text-end min-w-75px">Responsable</th>
											
											<th class="text-end min-w-100px pe-5">Actividad</th>
										</tr>
										<!--end::Table row-->
									</thead>
									<tbody class="fw-semibold text-gray-600">
										@foreach ($user as $itemus)
											
										<tr class="text-start text-gray-500 fw-bold fs-7 {{-- text-uppercase --}}">
											<td>
												<a href="#" class="text-gray-600 text-hover-primary mb-1">{{$itemus->name}}</a>
											</td>
											<td>
												<a href="#" class="text-gray-600 text-hover-primary mb-1">{{$itemus->Paterno}}</a>
											</td>
											<td>
												<a href="#" class="text-gray-600 text-hover-primary mb-1">{{$itemus->Materno}}</a>
											</td>
											<td>
												<div class="{{ $itemus->Estado == 'Activo' ? 'badge badge-light-success' : 'badge badge-light-danger' }}">{{$itemus->Estado}}</div>
											</td>
											<td>
												<div class="text-gray-600 text-hover-primary mb-1">{{$itemus->Ci}}</div>
											</td>
											<td class="text-gray-600 text-hover-primary mb-1">{{$itemus->Expedido}}</td>
											<td>
												<a href="#" class="text-gray-600 text-hover-primary mb-1">{{$itemus->Cargo}}</a>
											</td>
											
											<td class="text-end pe-0">{{$itemus->Lugar_Designado}}</td>
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
													<div class="menu-item px-3">
														<a href="#" data-bs-toggle="modal" data-bs-target="#modalModificarUsuario{{$itemus->id}}"
															class="menu-link px-3">Editar</a>
													</div>
													<!--end::Menu item-->
													<!--begin::Menu item-->
													<div class="menu-item px-3">
														@if ($itemus->Estado=='Activo')
														<a href="{{url('/usuario/bloquear/'.$itemus->id) }}" class="menu-link px-3"
															data-kt-customer-table-filter="delete_row">Bloquear</a>
														@else
														
														<a href="{{url('/usuario/desbloquear/'.$itemus->id)}}" class="menu-link px-3"
															data-kt-customer-table-filter="delete_row">Desbloquear</a>
															@endif
													</div>
													<!--end::Menu item-->
												</div>
												<!--end::Menu-->
											</td>
											<!--end::Action=-->

													<!--begin::Modal - modificar usuarios-->
												<div class="modal fade" id="modalModificarUsuario{{$itemus->id}}" tabindex="-1" aria-hidden="true">
													<!--begin::Modal dialog-->
													<div class="modal-dialog modal-dialog-centered mw-650px">
														<!--begin::Modal content-->
														<div class="modal-content">
															<!--begin::Form-->
															<form class="form" action="{{route('editar.usuario')}}" id="modadModificarUsuarios_form" method="POST">
																@csrf
																<!--begin::Modal header-->
																<div class="modal-header" id="modadModificarUsuarios_header">
																	<!--begin::Modal title-->
																	<h2>Modificar Usuario</h2>
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
																<!--begin::Modal body-->
																<div class="modal-body py-10 px-lg-17">
																	<!--begin::Scroll-->
																
																	<div class="scroll-y me-n7 pe-7" id="modadModificarUsuarios_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modadRegistraUsuarios_header" data-kt-scroll-wrappers="#modadRegistraUsuarios_scroll" data-kt-scroll-offset="300px">
																		<!--begin::Notice-->
																		<!--begin::Notice-->
																		
																		<!--end::Notice-->
																		<!--end::Notice-->
																		<!--begin::Input group-->
																		<div class="d-flex flex-column mb-5 fv-row">
																			<!--begin::Label-->
																			<input type="" name="txtid" id="txtid" value="{{$itemus->id}}"  style="display: none;">
																			<label class="required fs-5 fw-bold mb-2">Nombre
																			<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Solo se permiten letras y espacios"></i>

																			</label>
																			<!--end::Label-->
																			<!--begin::Input-->
																			<input  type="text" class="form-control form-control-solid" placeholder="Ingrese el Nombre" name="txtnombre" pattern="[A-Za-z\s]+" required value="{{$itemus->name}}" />
																			<!--end::Input-->
																		</div> 
																		<div class="row mb-5">
																			<!--begin::Col-->
																			<div class="col-md-6 fv-row">
																				<!--begin::Label-->
																				<label class="required fs-5 fw-bold mb-2">Paterno
																				<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten letras, sin espacios"></i>

																				</label>
																				<!--end::Label-->
																				<!--begin::Input-->
																				<input type="text" class="form-control form-control-solid" placeholder="" name="txtpaterno" value="{{$itemus->Paterno}}" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$" required  />
																				<!--end::Input-->
																			</div> 
																			<!--end::Col-->
																			<!--begin::Col-->
																			<div class="col-md-6 fv-row">
																				<!--end::Label-->
																				<label class="required fs-5 fw-bold mb-2">Materno
																				<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten letras, sin espacios"></i>

																				</label>
																				<!--end::Label-->
																				<!--end::Input-->
																				<input type="text" class="form-control form-control-solid" placeholder="" name="txtmaterno" value="{{$itemus->Materno}}" pattern="^[A-Za-záéíóúüñÁÉÍÓÚÜ]+$" required  />
																				<!--end::Input-->
																			</div> 
																			<!--end::Col-->
																		</div>
																		<!--end::Input group-->
																		<!--begin::Input group-->
																		
																		<div class="row mb-5">
																			<!--begin::Col-->
																			<div class="col-md-6 fv-row">
																				<!--begin::Label-->
																				<label class="required fs-5 fw-bold mb-2">C.I.
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Solo se permiten números de 7 a 8 digitos"></i>

																				</label>
																				<!--end::Label-->
																				<!--begin::Input-->
																				<input type="text" class="form-control form-control-solid" placeholder="" name="txtci" value="{{$itemus->Ci}}" pattern="^[0-9]{7,9}$" required  />
																				<!--end::Input-->
																			</div> 
																			<!--end::Col-->
																			<!--begin::Col-->
																			
																				<div class="col-md-6 fv-row">
																					<label class="required fs-6 fw-bold mb-2">Expedido</label>
																					<select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selecione..." name="txtexpedido" required >
																						<option value="" >Seleccione...</option>
																						<option value="LP"{{$itemus->Expedido=='LP'?'selected':''}}>La paz</option>
																						<option value="SCZ"{{$itemus->Expedido=='SCZ'?'selected':''}}>Santa Cruz</option>
																						<option value="CO"{{$itemus->Expedido=='CO'?'selected':''}}>Cochabamba</option>
																						<option value="OR"{{$itemus->Expedido=='OR'?'selected':''}}>Oruro</option>
																						<option value="PO"{{$itemus->Expedido=='PO'?'selected':''}}>Potosí</option>
																						<option value="TJ"{{$itemus->Expedido=='TJ'?'selected':''}}>Tarija</option>
																						<option value="CH"{{$itemus->Expedido=='CH'?'selected':''}}>Chuquisaca</option>
																						<option value="BE"{{$itemus->Expedido=='BE'?'selected':''}}>Beni</option>
																						<option value="PA"{{$itemus->Expedido=='PA'?'selected':''}}>Pando</option>
																					</select>
																				</div>
																			<!--end::Col-->
																		</div>
																		<div class="d-flex flex-column mb-5 fv-row">
																			<!--begin::Label-->
																			<label class="required fs-5 fw-bold mb-2">Celular
																			<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números"></i>

																			</label>
																			<!--end::Label-->
																			<!--begin::Input-->
																			<input  type="text" class="form-control form-control-solid" placeholder="Ingrese el Nombre" name="txtcelular"   id="txtcelular" value="{{$itemus->Celular}}" pattern="^[0-9]{7,9}$" required />
																			<!--end::I requirednput-->
																		</div>
																		<div class="d-flex flex-column mb-5 fv-row">
																			<label class="required fs-6 fw-bold mb-2">Genero</label>
																			<select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selecione..." name="txtgenero" required >
																				<option value="" >Seleccione...</option>
																				<option value="F" {{$itemus->Genero=='F'?'selected':''}}>Femenino</option>
																				<option value="M" {{$itemus->Genero=='M'?'selected':''}}>Masculino</option>
																			</select>
																		</div>
																		<!--end::Input group-->
																		<div class="row mb-5">
																				<div class="col-md-6 fv-row">
																					<label class="required fs-6 fw-bold mb-2">Cargo</label>
																					<select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selecione..." name="txtcargo" required >
																						<option value="" >Seleccione...</option>
																						<option value="Administrador" {{$itemus->Cargo=='Administrador'?'selected':''}}>Administrador</option>
																						<option value="Coordinador" {{$itemus->Cargo=='Coordinador'?'selected':''}}>Coordinador</option>
																						<option value="Tecnico" {{$itemus->Cargo=='Tecnico'?'selected':''}}>Tecnico</option>
																				
																					</select>
																				</div>
																					<!--begin::Input group-->
																				<div class="col-md-6 fv-row">
																					<label class="required fs-6 fw-bold mb-2">Responsable de</label>
																							<select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selecione..." name="txtlugarDesignado" required >
																								<option value="" >Seleccione...</option>
																								<option value="1" {{$itemus->Lugar_Designado=='1'?'selected':''}}>Distrito 1</option> 
																								<option value="2" {{$itemus->Lugar_Designado=='2'?'selected':''}}>Distrito 2</option> 
																								<option value="3" {{$itemus->Lugar_Designado=='3'?'selected':''}}>Distrito 3</option> 
																								<option value="4" {{$itemus->Lugar_Designado=='4'?'selected':''}}>Distrito 4</option> 
																								<option value="5" {{$itemus->Lugar_Designado=='5'?'selected':''}}>Distrito 5</option> 
																								<option value="6" {{$itemus->Lugar_Designado=='6'?'selected':''}}>Distrito 6</option> 
																								<option value="7" {{$itemus->Lugar_Designado=='7'?'selected':''}}>Distrito 7</option> 
																								<option value="8" {{$itemus->Lugar_Designado=='8'?'selected':''}}>Distrito 8</option> 
																								<option value="9" {{$itemus->Lugar_Designado=='9'?'selected':''}}>Distrito 9</option> 
																								<option value="10" {{$itemus->Lugar_Designado=='10'?'selected':''}}>Distrito 10</option> 
																								<option value="11" {{$itemus->Lugar_Designado=='11'?'selected':''}}>Distrito 11</option> 
																								<option value="12" {{$itemus->Lugar_Designado=='12'?'selected':''}}>Distrito 12</option> 
																								<option value="13" {{$itemus->Lugar_Designado=='13'?'selected':''}}>Distrito 13</option> 
																								<option value="14" {{$itemus->Lugar_Designado=='14'?'selected':''}}>Distrito 14</option> 
																								<option value="Alcaldia" {{$itemus->Lugar_Designado=='Alcaldia'?'selected':''}}>Alcaldia</option> 
																							</select>
																				</div>
																				<!--end::Input group-->
																				
																		
																		</div>
																		<!--end::Scroll-->
																	</div>
																</div>
																<!--end::Modal body-->
																<!--begin::Modal footer-->
																<div class="modal-footer flex-center">
																	<!--begin::Button-->
																	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
																	<!--end::Button-->
																	<!--begin::Button-->
																	<button type="submit" id="modadModificarUsuarios_submit" class="btn btn-primary">
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
													</div>
												</div>
												<!--end::Modal - modificar usuarios-->	
										</tr>
										@endforeach

									</tbody>
								</table>
							</div>
						</div>
					</div>
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
	

@endsection