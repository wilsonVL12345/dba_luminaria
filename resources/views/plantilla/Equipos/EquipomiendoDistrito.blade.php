@can('equipamiento.show')
    
@extends('layout.index')

@section('contenido')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="toolbar" id="kt_toolbar">
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Detalles de Equipamientos Distritales</h1>
				<span class="h-20px border-gray-300 border-start mx-4"></span>
				
			</div>
		
		</div>
	</div>
	{{-- todo el lugar que te interesa --}}
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Navbar-->
							<!--begin::Modal - registrar equipamiento - Add-->

                            <div class="post d-flex flex-column-fluid" id="kt_post">
                                <div id="kt_content_container" class="container-xxl">
                                    <!--begin::Modal - registrar equipamiento - Add-->
                                <div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
                                    <!--begin::Modal dialog-->
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <!--begin::Modal content-->
                                        <div class="modal-content">
                                            <!--begin::Form-->
                                            <form class="form" action="{{route("registro.equipamiento")}}" id="kt_modal_add_customer_form" data-kt-redirect="assets/dist/apps/customers/list.html" method="POST" >
                                                @csrf
                                                <!--begin::Modal header-->
                                                <div class="modal-header" id="kt_modal_add_customer_header">
                                                    <!--begin::Modal title-->
                                                    <h2 class="fw-bolder">Registrar Nuevo Equipamiento</h2>
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
                                                            <label class="required fs-6 fw-bold mb-2">Nombre Item
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
                                                            <div class="col-md-6 fv-row">
                                                                <label class="required fs-6 fw-bold mb-2">Estado</label>
                                                                <select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selecione..." name="txtestado" required >

                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Bueno">Bueno </option>
                                                                    <option value="Regular">Regular </option>
                                                                    <option value="Bueno ">Bueno </option>
                                                                    <option value="En Mantenimiento">En Mantenimiento</option>
                                                                </select>
                                                            </div>
                                                            <!--end::Col-->
                                                            <!--begin::Col-->
                                                            <div class="col-md-6 fv-row">
                                                                <label class="required fs-6 fw-bold mb-2">Distrito</label>
                                                                <select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selecione..." name="txtdistrito" required >

                                                                    <option value="">Seleccione...</option>
                                                                    @foreach ($lista as $ite)
                                                                    <option value="{{$ite->id}}">{{$ite->Distrito}}</option>
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
							<!--endbegin::Modal - registrar equipamiento - Add-->
                            <div>
                                @include('layout.notificacioncrud')
                            </div>
                            @can('equipamiento.create')
                                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Agregar Nuevo</button>
                                    </div>
                            @endcan

                                    <br>
                                  

                                    <div class="row gy-5 g-xl-10">
                                        <div class="col-sm-6 col-xl-2 mb-xl-10">
                                            <a href="/equipos/equipamiento/1" >
                                            <!--begin::Card widget 2-->
                                            <div class="card h-lg-100">
                                                <!--begin::Body-->
                                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                                    <!--begin::Icon-->
                                                    <div class="m-0">
                                                        <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z" fill="currentColor" />
                                                                <path d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z" fill="currentColor" />
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
                                                    <!--end::Svg Icon-->{{ $equipamientosPorDistrito[1] }}</span>
                                                    <!--end::Badge-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                            <!--end::Card widget 2-->
                                            </a>
                                        </div>
                                        <!--end::Col-->
                                        <div class="col-sm-6 col-xl-2 mb-xl-10">
                                            <a href="/equipos/equipamiento/2" >
                                                <!--begin::Card widget 2-->
                                            <div class="card h-lg-100">
                                                <!--begin::Body-->
                                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                                    <!--begin::Icon-->
                                                    <div class="m-0">
                                                        <!--begin::Svg Icon | path: icons/duotune/graphs/gra001.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M14 3V21H10V3C10 2.4 10.4 2 11 2H13C13.6 2 14 2.4 14 3ZM7 14H5C4.4 14 4 14.4 4 15V21H8V15C8 14.4 7.6 14 7 14Z" fill="currentColor" />
                                                                <path d="M21 20H20V8C20 7.4 19.6 7 19 7H17C16.4 7 16 7.4 16 8V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z" fill="currentColor" />
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
                                                    <!--end::Svg Icon-->{{ $equipamientosPorDistrito[2] }}</span>
                                                    <!--end::Badge-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                             <!--end::Card widget 2-->
                                        </a>
                                        </div>
                                        <!--end::Col-->
                                        <div class="col-sm-6 col-xl-2 mb-xl-10">
                                            <a href="/equipos/equipamiento/3" >
                                                <!--begin::Card widget 2-->
                                            <div class="card h-lg-100">
                                                <!--begin::Body-->
                                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                                    <!--begin::Icon-->
                                                    <div class="m-0">
                                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs048.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                                            <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
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
                                                    <!--end::Svg Icon-->{{ $equipamientosPorDistrito[3] }}</span>
                                                    <!--end::Badge-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                             <!--end::Card widget 2-->
                                        </a>
                                        </div>
                                        <!--end::Col-->
                                        <div class="col-sm-6 col-xl-2 mb-xl-10">
                                            <a href="/equipos/equipamiento/4" >
                                                <!--begin::Card widget 2-->
                                            <div class="card h-lg-100">
                                                <!--begin::Body-->
                                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                                    <!--begin::Icon-->
                                                    <div class="m-0">
                                                        <!--begin::Svg Icon | path: icons/duotune/maps/map002.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path d="M8.7 4.19995L4 6.30005V18.8999L8.7 16.8V19L3.1 21.5C2.6 21.7 2 21.4 2 20.8V6C2 5.4 2.3 4.89995 2.9 4.69995L8.7 2.09998V4.19995Z" fill="currentColor" />
                                                                <path d="M15.3 19.8L20 17.6999V5.09992L15.3 7.19989V4.99994L20.9 2.49994C21.4 2.29994 22 2.59989 22 3.19989V17.9999C22 18.5999 21.7 19.1 21.1 19.3L15.3 21.8998V19.8Z" fill="currentColor" />
                                                                <path opacity="0.3" d="M15.3 7.19995L20 5.09998V17.7L15.3 19.8V7.19995Z" fill="currentColor" />
                                                                <path opacity="0.3" d="M8.70001 4.19995V2L15.4 5V7.19995L8.70001 4.19995ZM8.70001 16.8V19L15.4 22V19.8L8.70001 16.8Z" fill="currentColor" />
                                                                <path opacity="0.3" d="M8.7 16.8L4 18.8999V6.30005L8.7 4.19995V16.8Z" fill="currentColor" />
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
                                                    <!--end::Svg Icon-->{{ $equipamientosPorDistrito[4] }}</span>
                                                    <!--end::Badge-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                             <!--end::Card widget 2-->
                                        </a>
                                        </div>
                                        <!--end::Col-->
                                        <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10">
                                            <a href="/equipos/equipamiento/5" >
                                                <!--begin::Card widget 2-->
                                            <div class="card h-lg-100">
                                                <!--begin::Body-->
                                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                                    <!--begin::Icon-->
                                                    <div class="m-0">
                                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs037.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M2.10001 10C3.00001 5.6 6.69998 2.3 11.2 2L8.79999 4.39999L11.1 7C9.60001 7.3 8.30001 8.19999 7.60001 9.59999L4.5 12.4L2.10001 10ZM19.3 11.5L16.4 14C15.7 15.5 14.4 16.6 12.7 16.9L15 19.5L12.6 21.9C17.1 21.6 20.8 18.2 21.7 13.9L19.3 11.5Z" fill="currentColor" />
                                                                <path d="M13.8 2.09998C18.2 2.99998 21.5 6.69998 21.8 11.2L19.4 8.79997L16.8 11C16.5 9.39998 15.5 8.09998 14 7.39998L11.4 4.39998L13.8 2.09998ZM12.3 19.4L9.69998 16.4C8.29998 15.7 7.3 14.4 7 12.8L4.39999 15.1L2 12.7C2.3 17.2 5.7 20.9 10 21.8L12.3 19.4Z" fill="currentColor" />
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
                                                    <!--end::Svg Icon-->{{ $equipamientosPorDistrito[5] }}</span>
                                                    <!--end::Badge-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                             <!--end::Card widget 2-->
                                        </a>
                                        </div>
                                        <!--end::Col-->
                                        <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10">
                                            <a href="/equipos/equipamiento/6" >
                                                <!--begin::Card widget 2-->
                                            <div class="card h-lg-100">
                                                <!--begin::Body-->
                                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                                    <!--begin::Icon-->
                                                    <div class="m-0">
                                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor" />
                                                                <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor" />
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
                                                    <!--end::Svg Icon-->{{ $equipamientosPorDistrito[6] }}</span>
                                                    <!--end::Badge-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                             <!--end::Card widget 2-->
                                        </a>
                                        </div>
                                        <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10">
                                            <a href="/equipos/equipamiento/7" >
                                                <!--begin::Card widget 2-->
                                            <div class="card h-lg-100">
                                                <!--begin::Body-->
                                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                                    <!--begin::Icon-->
                                                    <div class="m-0">
                                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor" />
                                                                <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor" />
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
                                                    <!--end::Svg Icon-->{{ $equipamientosPorDistrito[7] }}</span>
                                                    <!--end::Badge-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                             <!--end::Card widget 2-->
                                        </a>
                                        </div>
                                        <!--end::Col-->
                                        <div class="col-sm-6 col-xl-2 mb-xl-10">
                                            <a href="/equipos/equipamiento/8" >
                                                <!--begin::Card widget 2-->
                                            <div class="card h-lg-100">
                                                <!--begin::Body-->
                                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                                    <!--begin::Icon-->
                                                    <div class="m-0">
                                                        <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z" fill="currentColor" />
                                                                <path d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z" fill="currentColor" />
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
                                                    <!--end::Svg Icon-->{{ $equipamientosPorDistrito[8] }}</span>
                                                    <!--end::Badge-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                             <!--end::Card widget 2-->
                                        </a>
                                        </div>
                                        <!--end::Col-->
                                        <div class="col-sm-6 col-xl-2 mb-xl-10">
                                            <a href="/equipos/equipamiento/9" >
                                                <!--begin::Card widget 2-->
                                            <div class="card h-lg-100">
                                                <!--begin::Body-->
                                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                                    <!--begin::Icon-->
                                                    <div class="m-0">
                                                        <!--begin::Svg Icon | path: icons/duotune/graphs/gra001.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M14 3V21H10V3C10 2.4 10.4 2 11 2H13C13.6 2 14 2.4 14 3ZM7 14H5C4.4 14 4 14.4 4 15V21H8V15C8 14.4 7.6 14 7 14Z" fill="currentColor" />
                                                                <path d="M21 20H20V8C20 7.4 19.6 7 19 7H17C16.4 7 16 7.4 16 8V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z" fill="currentColor" />
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
                                                    <!--end::Svg Icon-->{{ $equipamientosPorDistrito[9] }}</span>
                                                    <!--end::Badge-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                             <!--end::Card widget 2-->
                                        </a>
                                        </div>
                                        <!--end::Col-->
                                        <div class="col-sm-6 col-xl-2 mb-xl-10">
                                            <a href="/equipos/equipamiento/10" >
                                                <!--begin::Card widget 2-->
                                            <div class="card h-lg-100">
                                                <!--begin::Body-->
                                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                                    <!--begin::Icon-->
                                                    <div class="m-0">
                                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs048.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                                            <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
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
                                                    <!--end::Svg Icon-->{{ $equipamientosPorDistrito[10] }}</span>
                                                    <!--end::Badge-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                             <!--end::Card widget 2-->
                                        </a>
                                        </div>
                                        <!--end::Col-->
                                        <div class="col-sm-6 col-xl-2 mb-xl-10">
                                            <a href="/equipos/equipamiento/11" >
                                                <!--begin::Card widget 2-->
                                            <div class="card h-lg-100">
                                                <!--begin::Body-->
                                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                                    <!--begin::Icon-->
                                                    <div class="m-0">
                                                        <!--begin::Svg Icon | path: icons/duotune/maps/map002.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path d="M8.7 4.19995L4 6.30005V18.8999L8.7 16.8V19L3.1 21.5C2.6 21.7 2 21.4 2 20.8V6C2 5.4 2.3 4.89995 2.9 4.69995L8.7 2.09998V4.19995Z" fill="currentColor" />
                                                                <path d="M15.3 19.8L20 17.6999V5.09992L15.3 7.19989V4.99994L20.9 2.49994C21.4 2.29994 22 2.59989 22 3.19989V17.9999C22 18.5999 21.7 19.1 21.1 19.3L15.3 21.8998V19.8Z" fill="currentColor" />
                                                                <path opacity="0.3" d="M15.3 7.19995L20 5.09998V17.7L15.3 19.8V7.19995Z" fill="currentColor" />
                                                                <path opacity="0.3" d="M8.70001 4.19995V2L15.4 5V7.19995L8.70001 4.19995ZM8.70001 16.8V19L15.4 22V19.8L8.70001 16.8Z" fill="currentColor" />
                                                                <path opacity="0.3" d="M8.7 16.8L4 18.8999V6.30005L8.7 4.19995V16.8Z" fill="currentColor" />
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
                                                    <!--end::Svg Icon-->{{ $equipamientosPorDistrito[11] }}</span>
                                                    <!--end::Badge-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                             <!--end::Card widget 2-->
                                        </a>
                                        </div>
                                        <!--end::Col-->
                                        <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10">
                                            <a href="/equipos/equipamiento/12" >
                                                <!--begin::Card widget 2-->
                                            <div class="card h-lg-100">
                                                <!--begin::Body-->
                                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                                    <!--begin::Icon-->
                                                    <div class="m-0">
                                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs037.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M2.10001 10C3.00001 5.6 6.69998 2.3 11.2 2L8.79999 4.39999L11.1 7C9.60001 7.3 8.30001 8.19999 7.60001 9.59999L4.5 12.4L2.10001 10ZM19.3 11.5L16.4 14C15.7 15.5 14.4 16.6 12.7 16.9L15 19.5L12.6 21.9C17.1 21.6 20.8 18.2 21.7 13.9L19.3 11.5Z" fill="currentColor" />
                                                                <path d="M13.8 2.09998C18.2 2.99998 21.5 6.69998 21.8 11.2L19.4 8.79997L16.8 11C16.5 9.39998 15.5 8.09998 14 7.39998L11.4 4.39998L13.8 2.09998ZM12.3 19.4L9.69998 16.4C8.29998 15.7 7.3 14.4 7 12.8L4.39999 15.1L2 12.7C2.3 17.2 5.7 20.9 10 21.8L12.3 19.4Z" fill="currentColor" />
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
                                                    <!--end::Svg Icon-->{{ $equipamientosPorDistrito[12] }}</span>
                                                    <!--end::Badge-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                             <!--end::Card widget 2-->
                                        </a>
                                        </div>
                                        <!--end::Col-->
                                        <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10">
                                            <a href="/equipos/equipamiento/13" >
                                                <!--begin::Card widget 2-->
                                            <div class="card h-lg-100">
                                                <!--begin::Body-->
                                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                                    <!--begin::Icon-->
                                                    <div class="m-0">
                                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor" />
                                                                <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor" />
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
                                                    <!--end::Svg Icon-->{{ $equipamientosPorDistrito[13] }}</span>
                                                    <!--end::Badge-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                             <!--end::Card widget 2-->
                                        </a>
                                        </div>
                                        <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10">
                                            <a href="/equipos/equipamiento/14" >
                                                <!--begin::Card widget 2-->
                                            <div class="card h-lg-100">
                                                <!--begin::Body-->
                                                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                                    <!--begin::Icon-->
                                                    <div class="m-0">
                                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor" />
                                                                <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor" />
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
                                                    <!--end::Svg Icon-->{{ $equipamientosPorDistrito[14] }}</span>
                                                    <!--end::Badge-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                             <!--end::Card widget 2-->
                                        </a>
                                        </div>
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
		<!--end::Container-->
</div> 
@endsection
@endcan
