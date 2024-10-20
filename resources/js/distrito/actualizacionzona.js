/* $(document).ready(function () {
    const $distritoSelect = $('#txtdistrito');
    const $zonaUrbanizacionSelect = $('#txtzonaUrbanizacion');

    $.ajax({
        url: '/api/apidistritos',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            function actualizarZonasUrbanizaciones() {
                const distritoSeleccionado = $distritoSelect.val();
                $zonaUrbanizacionSelect.empty().append('<option value="">Seleccione...</option>');

                const zonasUrbanizaciones = data.filter(item => item.Distrito == distritoSeleccionado);

                $.each(zonasUrbanizaciones, function (index, item) {
                    $zonaUrbanizacionSelect.append(`<option value="${item.Zona_Urbanizacion}">${item.Zona_Urbanizacion}</option>`);
                });
            }

            $distritoSelect.on('change', actualizarZonasUrbanizaciones);
            actualizarZonasUrbanizaciones(); // Inicializar las zonas/urbanizaciones al cargar el modal
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener los datos de los distritos:', error);
        }
    });
}); */

$(document).ready(function () {
    const $distritoSelect = $('#sldistrito');
    const $tableBody = $('#tablaUrbanicazionFiltrada tbody');

    $.ajax({
        url: '/api/apidistritos',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            function actualizarZonasUrbanizaciones() {
                const distritoSeleccionado = $distritoSelect.val();
                $tableBody.empty();

                const zonasUrbanizaciones = data.filter(item => item.Nrodistrito == distritoSeleccionado);

                $.each(zonasUrbanizaciones, function (index, item) {
                    $tableBody.append(`
                        
                        <tr>
                            <td>
									<div class="form-check form-check-sm form-check-custom form-check-solid">
										<input class="form-check-input" type="checkbox" value="1" />
									</div>
							</td>
                            <td>
                                <a href="#"
												class="text-gray-800 text-hover-primary mb-1">${item.Nrodistrito}</a>
                            </td>
                            <td>
                            <a href="#"
										class="text-gray-600 text-hover-primary mb-1">${item.nombre_urbanizacion}</a>
                            </td>
                            
                            <td>
                            <a href="#"
										class="text-gray-600 text-hover-primary mb-1" ></a>
                            </td>
                            <td data-filter="">
                                    <a href="#"
                                          class="text-gray-600 text-hover-primary mb-1">${item.lng}</a>
                             </td>
                             <td>
                            <a href="#"
										class="text-gray-600 text-hover-primary mb-1">${item.lat}</a>
                            </td>
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
															<a href="#"
															data-bs-toggle="modal" data-bs-target="#modalmodificarUrbanizacion{{$itemurb->id}}"	class="menu-link px-3">Editar</a>
														</div>
														<!--end::Menu item-->
														<!--begin::Menu item-->
														<div class="menu-item px-3">
															<a href="#" class="menu-link px-3"
																data-kt-customer-table-filter="delete_row">Delete</a>
														</div>
														<!--end::Menu item-->
													</div>
													<!--end::Menu-->
							</td>
                            <!--end::Action=-->
												<!-- Modal para Modificar distritos-->
															<!--begin::Modal -modificar urbanizacion-->
															<div class="modal fade" id="modalmodificarUrbanizacion{{$itemurb->id}}" tabindex="-1" aria-hidden="true">
																<!--begin::Modal dialog-->
																<div class="modal-dialog modal-dialog-centered mw-650px">
																	<!--begin::Modal content-->
																	<div class="modal-content">
																		<!--begin::Form-->
																		<form class="form" action="{{route('editar.distrito')}}" id="kt_modal_new_address_form" method="POST">
																			@csrf
																			<!--begin::Modal header-->
																			<div class="modal-header" id="kt_modal_new_address_header">
																				<!--begin::Modal title-->
																				<h2>Modificar Datos</h2>
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
																				<div class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_new_address_header" data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">
																					<!--begin::Notice-->
																					<!--begin::Notice-->
																					<div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
																						<!--begin::Icon-->
																						<!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
																						<span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
																							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																								<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
																								<rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
																								<rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
																							</svg>
																						</span>
																						<!--end::Svg Icon-->
																						<!--end::Icon-->
																						<!--begin::Wrapper-->
																						<div class="d-flex flex-stack flex-grow-1">
																							<!--begin::Content-->
																							<div class="fw-bold">
																								<h4 class="text-gray-900 fw-bolder">Advertencia</h4>
																								<div class="fs-6 text-gray-700">Una ves  Modificado el Datos no podras Recuperarlo
																								</div>
																							</div>
																							<!--end::Content-->
																						</div>
																						<!--end::Wrapper-->
																					</div>
																					<!--end::Notice-->
																					<!--end::Notice-->
																					<!--begin::Input group-->
																					<div class="row mb-5">
																						<!--begin::Col-->
																						<div class="col-md-6 fv-row">
																							<input type="text" id="txtid" name="txtid" value="{{$itemurb->id}}" readonly style="display: none;" >
																							<label class="required fs-6 fw-bold mb-2">Distrito</label>
																							<select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Seleccione..." name="txtdistritom" id="txtdistritom">
																										<option value="">Seleccione...</option>
																										<option value="1"{{$itemurb->Nrodistrito== '1' ? 'selected' : ''}}> 1</option> 
																										<option value="2"{{$itemurb->Nrodistrito== '2' ? 'selected' : ''}}> 2</option> 
																										<option value="3"{{$itemurb->Nrodistrito== '3' ? 'selected' : ''}}> 3</option> 
																										<option value="4"{{$itemurb->Nrodistrito== '4' ? 'selected' : ''}}> 4</option> 
																										<option value="5"{{$itemurb->Nrodistrito== '5' ? 'selected' : ''}}> 5</option> 
																										<option value="6"{{$itemurb->Nrodistrito== '6' ? 'selected' : ''}}> 6</option> 
																										<option value="7"{{$itemurb->Nrodistrito== '7' ? 'selected' : ''}}> 7</option> 
																										<option value="8"{{$itemurb->Nrodistrito== '8' ? 'selected' : ''}}> 8</option> 
																										<option value="9"{{$itemurb->Nrodistrito== '9' ? 'selected' : ''}}> 9</option> 
																										<option value="10"{{$itemurb->Nrodistrito== '10' ? 'selected' : ''}}> 10</option> 
																										<option value="11"{{$itemurb->Nrodistrito== '11' ? 'selected' : ''}}> 11</option> 
																										<option value="12"{{$itemurb->Nrodistrito== '12' ? 'selected' : ''}}> 12</option> 
																										<option value="13"{{$itemurb->Nrodistrito== '13' ? 'selected' : ''}}> 13</option> 
																										<option value="14"{{$itemurb->Nrodistrito== '14' ? 'selected' : ''}}> 14</option> 
																							</select>
																						</div>
																						<!--end::Col-->
																						
																					</div>
																					<!--end::Input group-->
																				
																					<!--begin::Input group-->
																					<div class="d-flex flex-column mb-5 fv-row">
																						<!--begin::Label-->
																						<label class="required fs-5 fw-bold mb-2">Urbanizacion</label>
																						<!--end::Label-->
																						<!--begin::Input-->
																						<input class="form-control form-control-solid" placeholder="" name="txtzonaUrbanizacionm" value="{{$itemurb->nombre_urbanizacion}}"  required/>
																						<!--end::Input-->
																					</div>
																					<!--end::Input group-->
																					
																					
																					
																				
																				</div>
																				<!--end::Scroll-->
																			</div>
																			<!--end::Modal body-->
																			<!--begin::Modal footer-->
																			<div class="modal-footer flex-center">
																				<!--begin::Button-->
																				<button type="button" i class="btn btn-light me-3" data-bs-dismiss="modal" >Cerrar</button>
																				<!--end::Button-->
																				<!--begin::Button-->
																				<button type="submit" id="kt_modal_new_address_submit" class="btn btn-primary">
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
															<!--end::Modal -modificar urbanizacion-->
                        </tr>
                    `);
                });
            }

            $distritoSelect.on('change', actualizarZonasUrbanizaciones);
            actualizarZonasUrbanizaciones(); // Inicializar la tabla al cargar la página
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener los datos de los distritos:', error);
        }
    });
});