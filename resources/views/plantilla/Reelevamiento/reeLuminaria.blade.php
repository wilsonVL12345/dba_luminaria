@can('Distritos.show')
	
@extends('layout.index')

@section('contenido')


<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="toolbar" id="kt_toolbar">
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<!--begin::Title-->
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Información de Zonas y Urbanizaciones</h1>
				
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
                            <form class="form" action="{{route("registro.equipamiento")}}" id="forregistrarEquipamiento" data-kt-redirect="assets/dist/apps/customers/list.html" method="POST" >
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
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-bold mb-2">AV o Calles
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números letras mayusculas y minusculas - ()"></i>

                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder="Ingrese el Nombre de el Equipamiento" name="txtnombre" id="txtnombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\-\(\)\. ]*"  required />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-8">
                                                <label class="fs-6 fw-bold mb-2">Descripcion</label>
                                                <textarea class="form-control form-control-solid" rows="3" name="txtdescripcion" id="txtdescripcion" placeholder="Ingrese una Breve Descripcion" ></textarea>
                                            </div>
                                            <!--end::Input group-->
                                            
                                        </div>
                                        <div class="row g-9 mb-8">
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
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-9 fv-row">
                                                    <label for="reeUrbanizacionRegis" class="required fs-5 fw-bold mb-2">Urbanizacion</label>
                                                    
                                                    <select  aria-label="Select a Country"
                                                    data-control="select2"
                                                    data-placeholder="Seleccionar Urbanizacion"
                                                    data-dropdown-parent="#registrarReelevamiento"
                                                    class="form-control form-select-solid " name="reeUrbanizacionRegis" id="reeUrbanizacionRegis" required>
                                                    <option value="">Seleccion...</option>
                                                    </select>
                                            </div>
                                            <!--end::Col-->
                                           
                                        </div>

                                         <!--begin::Dropzone-->
                                        
                                         <div class="col-md-9 mb-4">
                                            <label class="required fs-6 fw-bold mb-2">Subir Archivo</label>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten Archivos .RAR o .ZIP"></i>
   
											<input type="file" id="flrar" name="flrar" accept=".rar,.zip" class="form-control">
                                                @error('flrar')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror

										</div>
                                    
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
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registrarReelevamiento">Agregar Nuevo</button>
                </div>
                <br>
                <!--begin::Container toda la parte de  la lista necesaria-->
                <div class="row gy-5 g-xl-10" data-lugar-designado="{{ session('Lugar_Designado') }}" id="app">
                    <div class="col-sm-6 col-xl-2 mb-xl-10" style="display: none;" id="d-1">
                        <a href="/equipos/equipamiento/1" >
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
                        <a href="/equipos/equipamiento/2" >
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
                        <a href="/equipos/equipamiento/3" >
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
                        <a href="/equipos/equipamiento/4" >
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
                        <a href="/equipos/equipamiento/5" >
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
                        <a href="/equipos/equipamiento/6" >
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
                        <a href="/equipos/equipamiento/7" >
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
                        <a href="/equipos/equipamiento/8" >
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
                        <a href="/equipos/equipamiento/9" >
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
                        <a href="/equipos/equipamiento/10" >
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
                        <a href="/equipos/equipamiento/11" >
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
                        <a href="/equipos/equipamiento/12" >
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
                        <a href="/equipos/equipamiento/13" >
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
                        <a href="/equipos/equipamiento/14" >
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
