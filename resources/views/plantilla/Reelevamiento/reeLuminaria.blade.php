@can('Reelevamiento.show')

	
@extends('layout.index')

@section('contenido')


<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="toolbar" id="kt_toolbar">
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<!--begin::Title-->
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Reelevamientos Urbanizaciones</h1>
				
				<span class="h-20px border-gray-300 border-start mx-4"></span>
				
				
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
			<!--begin::Actions-->
		
		</div>
		<!--end::Container-->
	</div>
	<!--end::Toolbar-->
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Navbar-->
                {{-- registrar reelevamientos --}}
                <div class="modal fade" id="registrarReelevamiento" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Form-->
                            {{-- formulario de registro de equipamiento --}}
                            <form class="form" action="{{route("reelevamiento.create")}}" id="reelevamientoCreate" data-kt-redirect="assets/dist/apps/customers/list.html" enctype="multipart/form-data" method="POST" >
                                @csrf
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_add_customer_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bolder">Registrar Nuevo Reelevamiento</h2>
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
                                        <div class="row g-6 mb-4">
                                            <!--begin::Col-->
                                            <div class="col-md-3 fv-row">
                                               <label class="required fs-5 fw-bold mb-2">Distrito</label>
                                               <select class="form-control form-select-solid" data-control="select2" data-search="false" data-dropdown-parent="#registrarReelevamiento" data-hide-search="true" data-placeholder="Selecione..." name="reeDistritoRegis" id="reeDistritoRegis"
                                                 required >

                                                   <option value="">Seleccione...</option>
                                                   @foreach ($lista as $ite)
                                                   <option value="{{$ite->id}}">{{$ite->Distrito}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                           <div class="col-md-6 mb-4">
                                               <label class="required fs-5 fw-bold mb-2">Fecha
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
                                                   <input type="date" class="form-control form-control-solid ps-12" placeholder="Select a date" name="reeFechaRegis" id="reeFechaRegis"    required />
                                                   <!--end::Datepicker-->
                                               </div>
                                               <!--end::Input-->
                                           </div>
                                           <!--end::Col-->
                                           <!--begin::Col-->
                                          
                                           <!--end::Col-->
                                          
                                       </div>
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fs-5 fw-bold mb-2">AV o Calles
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números letras mayusculas y minusculas - ()"></i>

                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder="Ingrese el Nombre de el Equipamiento" name="reeAvCalle" id="reeAvCalle" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\-\(\)\., ]*"
                                            required />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-8">
                                                <label class=" fs-5 fw-bold mb-2">Descripcion</label>
                                                <textarea class="form-control form-control-solid" rows="3" name="reeDescripRegis" id="reeDescripRegis" placeholder="Ingrese una Breve Descripcion" ></textarea>
                                            </div>
                                            <!--end::Input group-->
                                            
                                        </div>
                                        
                                        <div class="from row">
                                            <label for="reeUrbanizacionRegis" class="required fs-5 fw-bold mb-2">Urbanizacion</label>
                                            
                                            <select  aria-label="Select a Country"
                                            data-control="select2"
                                            data-placeholder="Seleccionar Urbanizacion"
                                            data-dropdown-parent="#registrarReelevamiento"
                                            class="form-control form-select-solid " name="reeUrbanizacionRegis" id="reeUrbanizacionRegis" required>
                                            <option value="">Seleccion...</option>
                                            </select>
                                        </div>
                                        <br>

                                         <!--begin::Dropzone-->
                                        
                                         <div class="col-md-9 mb-4">
                                            <label class="required fs-5 fw-bold mb-2">Subir Archivo</label>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten Archivos .RAR o .ZIP"></i>
   
											<input type="file" id="flrar" name="flrar" accept=".rar,.zip" class="form-control" required>
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
                                        <button type="submit" id="submitButtons" class="btn btn-primary">Registrar</button>
                                        
                                    </div>
                                
                                </div>
                                <!--end::Modal footer-->
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                </div>
                {{-- endregistrar reelevamientos --}}
                <div>
                    @include('layout.notificacioncrud')
                </div>
                @can('Reelevamiento.create')
                
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registrarReelevamiento">Agregar Nuevo</button>
                </div>
                @endcan
                <br>
                <!--begin::Container toda la parte de  la lista necesaria-->
                <div class="row gy-5 g-xl-10" data-lugar-designado="{{ session('Lugar_Designado') }}" id="app">
                    <div class="col-sm-6 col-xl-2 mb-xl-10" style="display: none;" id="d-1">
                        <a href="/reelevamientos/dis/1" >
                        <!--begin::Card widget 2-->
                        <div class="card h-lg-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <!--begin::Icon-->
                                <div class="m-0">
                                    <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 16 16" {...$$props}>
                                            <path fill="currentColor" d="M14.341 3.579c-.347-.473-.831-1.027-1.362-1.558S11.894 1.006 11.421.659C10.615.068 10.224 0 10 0H2.25C1.561 0 1 .561 1 1.25v13.5c0 .689.561 1.25 1.25 1.25h11.5c.689 0 1.25-.561 1.25-1.25V5c0-.224-.068-.615-.659-1.421m-2.07-.85c.48.48.856.912 1.134 1.271h-2.406V1.595c.359.278.792.654 1.271 1.134zM14 14.75c0 .136-.114.25-.25.25H2.25a.253.253 0 0 1-.25-.25V1.25c0-.135.115-.25.25-.25H10v3.5a.5.5 0 0 0 .5.5H14z" />
                                            <path fill="currentColor" d="M4 1h2v1H4zm2 1h2v1H6zM4 3h2v1H4zm2 1h2v1H6zM4 5h2v1H4zm2 1h2v1H6zM4 7h2v1H4zm2 1h2v1H6zm-2 5.25c0 .412.338.75.75.75h2.5c.412 0 .75-.338.75-.75v-2.5a.753.753 0 0 0-.75-.75H6V9H4zM7 12v1H5v-1z" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Section-->
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">D-1</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-bold fs-6 text-gray-400">Distrito</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Badge-->
                                <span class="badge badge-primary fs-base">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ $reelevamientosPorDistrito[1] }}</span>
                                <!--end::Badge-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card widget 2-->
                        </a>
                    </div>
                    <!--end::Col-->
                    <div class="col-sm-6 col-xl-2 mb-xl-10" style="display: none;" id="d-2">
                        <a href="/reelevamientos/dis/2" >
                            <!--begin::Card widget 2-->
                        <div class="card h-lg-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <!--begin::Icon-->
                                <div class="m-0">
                                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra001.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48" {...$$props}>
                                            <g fill="none" stroke="currentColor" stroke-width="4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 38v6h28v-6m0-18v-6L30 4H10v16" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M28 4v10h10" />
                                                <path stroke-linecap="round" d="M16 12h4" />
                                                <rect width="40" height="18" x="4" y="20" stroke-linejoin="round" rx="2" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 25h6l-6 8h6" />
                                                <path stroke-linecap="round" d="M24 25v8m7-8v8" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M31 25h3.5a2.5 2.5 0 0 1 2.5 2.5v0a2.5 2.5 0 0 1-2.5 2.5H31" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Section-->
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">D-2</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-bold fs-6 text-gray-400">Distrito</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Badge-->
                                <span class="badge badge-primary fs-base">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ $reelevamientosPorDistrito[2] }}</span>
                                <!--end::Badge-->
                            </div>
                            <!--end::Body-->
                        </div>
                            <!--end::Card widget 2-->
                    </a>
                    </div>
                    <!--end::Col-->
                    <div class="col-sm-6 col-xl-2 mb-xl-10" style="display: none;" id="d-3">
                        <a href="/reelevamientos/dis/3" >
                            <!--begin::Card widget 2-->
                        <div class="card h-lg-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <!--begin::Icon-->
                                <div class="m-0">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs048.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 16 16" {...$$props}>
                                            <path fill="currentColor" d="M14.341 3.579c-.347-.473-.831-1.027-1.362-1.558S11.894 1.006 11.421.659C10.615.068 10.224 0 10 0H2.25C1.561 0 1 .561 1 1.25v13.5c0 .689.561 1.25 1.25 1.25h11.5c.689 0 1.25-.561 1.25-1.25V5c0-.224-.068-.615-.659-1.421m-2.07-.85c.48.48.856.912 1.134 1.271h-2.406V1.595c.359.278.792.654 1.271 1.134zM14 14.75c0 .136-.114.25-.25.25H2.25a.253.253 0 0 1-.25-.25V1.25c0-.135.115-.25.25-.25H10v3.5a.5.5 0 0 0 .5.5H14z" />
                                            <path fill="currentColor" d="M4 1h2v1H4zm2 1h2v1H6zM4 3h2v1H4zm2 1h2v1H6zM4 5h2v1H4zm2 1h2v1H6zM4 7h2v1H4zm2 1h2v1H6zm-2 5.25c0 .412.338.75.75.75h2.5c.412 0 .75-.338.75-.75v-2.5a.753.753 0 0 0-.75-.75H6V9H4zM7 12v1H5v-1z" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Section-->
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">D-3</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-bold fs-6 text-gray-400">Distrito</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Badge-->
                                <span class="badge badge-primary fs-base">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ $reelevamientosPorDistrito[3] }}</span>
                                <!--end::Badge-->
                            </div>
                            <!--end::Body-->
                        </div>
                            <!--end::Card widget 2-->
                    </a>
                    </div>
                    <!--end::Col-->
                    <div class="col-sm-6 col-xl-2 mb-xl-10" style="display: none;" id="d-4">
                        <a href="/reelevamientos/dis/4" >
                            <!--begin::Card widget 2-->
                        <div class="card h-lg-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <!--begin::Icon-->
                                <div class="m-0">
                                    <!--begin::Svg Icon | path: icons/duotune/maps/map002.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48" {...$$props}>
                                            <g fill="none" stroke="currentColor" stroke-width="4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 38v6h28v-6m0-18v-6L30 4H10v16" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M28 4v10h10" />
                                                <path stroke-linecap="round" d="M16 12h4" />
                                                <rect width="40" height="18" x="4" y="20" stroke-linejoin="round" rx="2" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 25h6l-6 8h6" />
                                                <path stroke-linecap="round" d="M24 25v8m7-8v8" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M31 25h3.5a2.5 2.5 0 0 1 2.5 2.5v0a2.5 2.5 0 0 1-2.5 2.5H31" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Section-->
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">D-4</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-bold fs-6 text-gray-400">Distrito</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Badge-->
                                <span class="badge badge-primary fs-base">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ $reelevamientosPorDistrito[4] }}</span>
                                <!--end::Badge-->
                            </div>
                            <!--end::Body-->
                        </div>
                            <!--end::Card widget 2-->
                    </a>
                    </div>
                    <!--end::Col-->
                    <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10" style="display: none;" id="d-5">
                        <a href="/reelevamientos/dis/5" >
                            <!--begin::Card widget 2-->
                        <div class="card h-lg-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <!--begin::Icon-->
                                <div class="m-0">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs037.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 16 16" {...$$props}>
                                            <path fill="currentColor" d="M14.341 3.579c-.347-.473-.831-1.027-1.362-1.558S11.894 1.006 11.421.659C10.615.068 10.224 0 10 0H2.25C1.561 0 1 .561 1 1.25v13.5c0 .689.561 1.25 1.25 1.25h11.5c.689 0 1.25-.561 1.25-1.25V5c0-.224-.068-.615-.659-1.421m-2.07-.85c.48.48.856.912 1.134 1.271h-2.406V1.595c.359.278.792.654 1.271 1.134zM14 14.75c0 .136-.114.25-.25.25H2.25a.253.253 0 0 1-.25-.25V1.25c0-.135.115-.25.25-.25H10v3.5a.5.5 0 0 0 .5.5H14z" />
                                            <path fill="currentColor" d="M4 1h2v1H4zm2 1h2v1H6zM4 3h2v1H4zm2 1h2v1H6zM4 5h2v1H4zm2 1h2v1H6zM4 7h2v1H4zm2 1h2v1H6zm-2 5.25c0 .412.338.75.75.75h2.5c.412 0 .75-.338.75-.75v-2.5a.753.753 0 0 0-.75-.75H6V9H4zM7 12v1H5v-1z" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Section-->
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">D-5</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-bold fs-6 text-gray-400">Distrito</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Badge-->
                                <span class="badge badge-primary fs-base">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ $reelevamientosPorDistrito[5] }}</span>
                                <!--end::Badge-->
                            </div>
                            <!--end::Body-->
                        </div>
                            <!--end::Card widget 2-->
                    </a>
                    </div>
                    <!--end::Col-->
                    <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10" style="display: none;" id="d-6">
                        <a href="/reelevamientos/dis/6" >
                            <!--begin::Card widget 2-->
                        <div class="card h-lg-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <!--begin::Icon-->
                                <div class="m-0">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48" {...$$props}>
                                            <g fill="none" stroke="currentColor" stroke-width="4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 38v6h28v-6m0-18v-6L30 4H10v16" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M28 4v10h10" />
                                                <path stroke-linecap="round" d="M16 12h4" />
                                                <rect width="40" height="18" x="4" y="20" stroke-linejoin="round" rx="2" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 25h6l-6 8h6" />
                                                <path stroke-linecap="round" d="M24 25v8m7-8v8" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M31 25h3.5a2.5 2.5 0 0 1 2.5 2.5v0a2.5 2.5 0 0 1-2.5 2.5H31" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Section-->
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">D-6</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-bold fs-6 text-gray-400">Distrito</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Badge-->
                                <span class="badge badge-primary fs-base">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ $reelevamientosPorDistrito[6] }}</span>
                                <!--end::Badge-->
                            </div>
                            <!--end::Body-->
                        </div>
                            <!--end::Card widget 2-->
                    </a>
                    </div>
                    <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10" style="display: none;" id="d-7">
                        <a href="/reelevamientos/dis/7" >
                            <!--begin::Card widget 2-->
                        <div class="card h-lg-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <!--begin::Icon-->
                                <div class="m-0">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 16 16" {...$$props}>
                                            <path fill="currentColor" d="M14.341 3.579c-.347-.473-.831-1.027-1.362-1.558S11.894 1.006 11.421.659C10.615.068 10.224 0 10 0H2.25C1.561 0 1 .561 1 1.25v13.5c0 .689.561 1.25 1.25 1.25h11.5c.689 0 1.25-.561 1.25-1.25V5c0-.224-.068-.615-.659-1.421m-2.07-.85c.48.48.856.912 1.134 1.271h-2.406V1.595c.359.278.792.654 1.271 1.134zM14 14.75c0 .136-.114.25-.25.25H2.25a.253.253 0 0 1-.25-.25V1.25c0-.135.115-.25.25-.25H10v3.5a.5.5 0 0 0 .5.5H14z" />
                                            <path fill="currentColor" d="M4 1h2v1H4zm2 1h2v1H6zM4 3h2v1H4zm2 1h2v1H6zM4 5h2v1H4zm2 1h2v1H6zM4 7h2v1H4zm2 1h2v1H6zm-2 5.25c0 .412.338.75.75.75h2.5c.412 0 .75-.338.75-.75v-2.5a.753.753 0 0 0-.75-.75H6V9H4zM7 12v1H5v-1z" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Section-->
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">D-7</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-bold fs-6 text-gray-400">Distrito</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Badge-->
                                <span class="badge badge-primary fs-base">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ $reelevamientosPorDistrito[7] }}</span>
                                <!--end::Badge-->
                            </div>
                            <!--end::Body-->
                        </div>
                            <!--end::Card widget 2-->
                    </a>
                    </div>
                    <!--end::Col-->
                    <div class="col-sm-6 col-xl-2 mb-xl-10" style="display: none;" id="d-8">
                        <a href="/reelevamientos/dis/8" >
                            <!--begin::Card widget 2-->
                        <div class="card h-lg-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <!--begin::Icon-->
                                <div class="m-0">
                                    <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48" {...$$props}>
                                            <g fill="none" stroke="currentColor" stroke-width="4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 38v6h28v-6m0-18v-6L30 4H10v16" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M28 4v10h10" />
                                                <path stroke-linecap="round" d="M16 12h4" />
                                                <rect width="40" height="18" x="4" y="20" stroke-linejoin="round" rx="2" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 25h6l-6 8h6" />
                                                <path stroke-linecap="round" d="M24 25v8m7-8v8" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M31 25h3.5a2.5 2.5 0 0 1 2.5 2.5v0a2.5 2.5 0 0 1-2.5 2.5H31" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Section-->
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">D-8</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-bold fs-6 text-gray-400">Distrito</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Badge-->
                                <span class="badge badge-primary fs-base">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ $reelevamientosPorDistrito[8] }}</span>
                                <!--end::Badge-->
                            </div>
                            <!--end::Body-->
                        </div>
                            <!--end::Card widget 2-->
                    </a>
                    </div>
                    <!--end::Col-->
                    <div class="col-sm-6 col-xl-2 mb-xl-10" style="display: none;" id="d-9">
                        <a href="/reelevamientos/dis/9" >
                            <!--begin::Card widget 2-->
                        <div class="card h-lg-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <!--begin::Icon-->
                                <div class="m-0">
                                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra001.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 16 16" {...$$props}>
                                            <path fill="currentColor" d="M14.341 3.579c-.347-.473-.831-1.027-1.362-1.558S11.894 1.006 11.421.659C10.615.068 10.224 0 10 0H2.25C1.561 0 1 .561 1 1.25v13.5c0 .689.561 1.25 1.25 1.25h11.5c.689 0 1.25-.561 1.25-1.25V5c0-.224-.068-.615-.659-1.421m-2.07-.85c.48.48.856.912 1.134 1.271h-2.406V1.595c.359.278.792.654 1.271 1.134zM14 14.75c0 .136-.114.25-.25.25H2.25a.253.253 0 0 1-.25-.25V1.25c0-.135.115-.25.25-.25H10v3.5a.5.5 0 0 0 .5.5H14z" />
                                            <path fill="currentColor" d="M4 1h2v1H4zm2 1h2v1H6zM4 3h2v1H4zm2 1h2v1H6zM4 5h2v1H4zm2 1h2v1H6zM4 7h2v1H4zm2 1h2v1H6zm-2 5.25c0 .412.338.75.75.75h2.5c.412 0 .75-.338.75-.75v-2.5a.753.753 0 0 0-.75-.75H6V9H4zM7 12v1H5v-1z" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Section-->
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">D-9</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-bold fs-6 text-gray-400">Distrito</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Badge-->
                                <span class="badge badge-primary fs-base">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ $reelevamientosPorDistrito[9] }}</span>
                                <!--end::Badge-->
                            </div>
                            <!--end::Body-->
                        </div>
                            <!--end::Card widget 2-->
                    </a>
                    </div>
                    <!--end::Col-->
                    <div class="col-sm-6 col-xl-2 mb-xl-10" style="display: none;" id="d-10">
                        <a href="/reelevamientos/dis/10" >
                            <!--begin::Card widget 2-->
                        <div class="card h-lg-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <!--begin::Icon-->
                                <div class="m-0">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs048.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48" {...$$props}>
                                            <g fill="none" stroke="currentColor" stroke-width="4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 38v6h28v-6m0-18v-6L30 4H10v16" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M28 4v10h10" />
                                                <path stroke-linecap="round" d="M16 12h4" />
                                                <rect width="40" height="18" x="4" y="20" stroke-linejoin="round" rx="2" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 25h6l-6 8h6" />
                                                <path stroke-linecap="round" d="M24 25v8m7-8v8" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M31 25h3.5a2.5 2.5 0 0 1 2.5 2.5v0a2.5 2.5 0 0 1-2.5 2.5H31" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Section-->
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">D-10</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-bold fs-6 text-gray-400">Distrito</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Badge-->
                                <span class="badge badge-primary fs-base">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ $reelevamientosPorDistrito[10] }}</span>
                                <!--end::Badge-->
                            </div>
                            <!--end::Body-->
                        </div>
                            <!--end::Card widget 2-->
                    </a>
                    </div>
                    <!--end::Col-->
                    <div class="col-sm-6 col-xl-2 mb-xl-10" style="display: none;" id="d-11">
                        <a href="/reelevamientos/dis/11" >
                            <!--begin::Card widget 2-->
                        <div class="card h-lg-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <!--begin::Icon-->
                                <div class="m-0">
                                    <!--begin::Svg Icon | path: icons/duotune/maps/map002.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 16 16" {...$$props}>
                                            <path fill="currentColor" d="M14.341 3.579c-.347-.473-.831-1.027-1.362-1.558S11.894 1.006 11.421.659C10.615.068 10.224 0 10 0H2.25C1.561 0 1 .561 1 1.25v13.5c0 .689.561 1.25 1.25 1.25h11.5c.689 0 1.25-.561 1.25-1.25V5c0-.224-.068-.615-.659-1.421m-2.07-.85c.48.48.856.912 1.134 1.271h-2.406V1.595c.359.278.792.654 1.271 1.134zM14 14.75c0 .136-.114.25-.25.25H2.25a.253.253 0 0 1-.25-.25V1.25c0-.135.115-.25.25-.25H10v3.5a.5.5 0 0 0 .5.5H14z" />
                                            <path fill="currentColor" d="M4 1h2v1H4zm2 1h2v1H6zM4 3h2v1H4zm2 1h2v1H6zM4 5h2v1H4zm2 1h2v1H6zM4 7h2v1H4zm2 1h2v1H6zm-2 5.25c0 .412.338.75.75.75h2.5c.412 0 .75-.338.75-.75v-2.5a.753.753 0 0 0-.75-.75H6V9H4zM7 12v1H5v-1z" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Section-->
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">D-11</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-bold fs-6 text-gray-400">Distrito</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Badge-->
                                <span class="badge badge-primary fs-base">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ $reelevamientosPorDistrito[11] }}</span>
                                <!--end::Badge-->
                            </div>
                            <!--end::Body-->
                        </div>
                            <!--end::Card widget 2-->
                    </a>
                    </div>
                    <!--end::Col-->
                    <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10" style="display: none;" id="d-12">
                        <a href="/reelevamientos/dis/12" >
                            <!--begin::Card widget 2-->
                        <div class="card h-lg-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <!--begin::Icon-->
                                <div class="m-0">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs037.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48" {...$$props}>
                                            <g fill="none" stroke="currentColor" stroke-width="4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 38v6h28v-6m0-18v-6L30 4H10v16" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M28 4v10h10" />
                                                <path stroke-linecap="round" d="M16 12h4" />
                                                <rect width="40" height="18" x="4" y="20" stroke-linejoin="round" rx="2" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 25h6l-6 8h6" />
                                                <path stroke-linecap="round" d="M24 25v8m7-8v8" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M31 25h3.5a2.5 2.5 0 0 1 2.5 2.5v0a2.5 2.5 0 0 1-2.5 2.5H31" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Section-->
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">D-12</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-bold fs-6 text-gray-400">Distrito</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Badge-->
                                <span class="badge badge-primary fs-base">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ $reelevamientosPorDistrito[12] }}</span>
                                <!--end::Badge-->
                            </div>
                            <!--end::Body-->
                        </div>
                            <!--end::Card widget 2-->
                    </a>
                    </div>
                    <!--end::Col-->
                    <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10" style="display: none;" id="d-13">
                        <a href="/reelevamientos/dis/13" >
                            <!--begin::Card widget 2-->
                        <div class="card h-lg-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <!--begin::Icon-->
                                <div class="m-0">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 16 16" {...$$props}>
                                            <path fill="currentColor" d="M14.341 3.579c-.347-.473-.831-1.027-1.362-1.558S11.894 1.006 11.421.659C10.615.068 10.224 0 10 0H2.25C1.561 0 1 .561 1 1.25v13.5c0 .689.561 1.25 1.25 1.25h11.5c.689 0 1.25-.561 1.25-1.25V5c0-.224-.068-.615-.659-1.421m-2.07-.85c.48.48.856.912 1.134 1.271h-2.406V1.595c.359.278.792.654 1.271 1.134zM14 14.75c0 .136-.114.25-.25.25H2.25a.253.253 0 0 1-.25-.25V1.25c0-.135.115-.25.25-.25H10v3.5a.5.5 0 0 0 .5.5H14z" />
                                            <path fill="currentColor" d="M4 1h2v1H4zm2 1h2v1H6zM4 3h2v1H4zm2 1h2v1H6zM4 5h2v1H4zm2 1h2v1H6zM4 7h2v1H4zm2 1h2v1H6zm-2 5.25c0 .412.338.75.75.75h2.5c.412 0 .75-.338.75-.75v-2.5a.753.753 0 0 0-.75-.75H6V9H4zM7 12v1H5v-1z" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Section-->
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">D-13</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-bold fs-6 text-gray-400">Distrito</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Badge-->
                                <span class="badge badge-primary fs-base">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ $reelevamientosPorDistrito[13] }}</span>
                                <!--end::Badge-->
                            </div>
                            <!--end::Body-->
                        </div>
                            <!--end::Card widget 2-->
                    </a>
                    </div>
                    <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10" style="display: none;" id="d-14">
                        <a href="/reelevamientos/dis/14" >
                            <!--begin::Card widget 2-->
                        <div class="card h-lg-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <!--begin::Icon-->
                                <div class="m-0">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48" {...$$props}>
                                            <g fill="none" stroke="currentColor" stroke-width="4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 38v6h28v-6m0-18v-6L30 4H10v16" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M28 4v10h10" />
                                                <path stroke-linecap="round" d="M16 12h4" />
                                                <rect width="40" height="18" x="4" y="20" stroke-linejoin="round" rx="2" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 25h6l-6 8h6" />
                                                <path stroke-linecap="round" d="M24 25v8m7-8v8" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M31 25h3.5a2.5 2.5 0 0 1 2.5 2.5v0a2.5 2.5 0 0 1-2.5 2.5H31" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Section-->
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">D-14</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-bold fs-6 text-gray-400">Distrito</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Badge-->
                                <span class="badge badge-primary fs-base">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ $reelevamientosPorDistrito[14] }}</span>
                                <!--end::Badge-->
                            </div>
                            <!--end::Body-->
                        </div>
                            <!--end::Card widget 2-->
                    </a>
                    </div>
                </div>
                
                        <!--end::Container-->
		</div>
							
    </div>
</div>



@endsection


@endcan
