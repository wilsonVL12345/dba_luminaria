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
	{{-- todo el lugar que te interesa --}}
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container">
										<div class="card mb-5 mb-xl-10">
											<div class="card-body pt-9 pb-0">
												<div class="margin ">
													<!--begin::Modal -MODIficar urbanizacion-->
                                                                <!--begin::Form-->
                                                                {{-- <form class="form" action="{{route('editar.distrito',$urbEdit->id)}}" id="formregistroUrbanizacion" method="POST"> --}}
                                                                    <form class="form mx-auto" style="max-width: 900px;" action="{{route('editar.distrito',$urbEdit->id)}}" id="formregistroUrbanizacion" method="POST">
                                                                    @csrf
                                                                    <!--begin::Modal header-->
                                                                        <!--begin::Modal title-->
                                                                        <h2>Modificar Urbanizacion</h2>
                                                                      <!--begin::Scroll-->
                                                                      <div class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_new_address_header" data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">
                                                                        
                                                                        <div class="row mb-5">
                                                                            <!--begin::Col-->
                                                                            <div class="col-md-6 fv-row">
                                                                                <label class="required fs-6 fw-bold mb-2">Distrito</label>
                                                                                <select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Seleccione..." name="txtdistritom" id="txtdistritom" required>
                                                                                            <option value="">Seleccione...</option>
                                                                                            @foreach ($distEdit as $itemd)
                                                                                            <option value="{{$itemd->id}}" {{$urbEdit->Nrodistrito==$itemd->id?'selected':''}}>{{$itemd->Distrito}}</option>
                                                                                            @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <!--end::Col-->
                                                                        </div>
                                                                        <!--end::Input group-->
                                                                        <div class="row mb-5">
                                                                            <!--begin::Col-->
                                                                            <div class="col-md-6 fv-row">
                                                                                <label class="required fs-5 fw-bold mb-2">Urbanizacion
                                                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números letras mayusculas y minusculas - ()"></i>

                                                                                </label>
                                                                                <!--end::Label-->
                                                                                <!--begin::Input-->
                                                                                <input type="text" class="form-control form-control-solid" placeholder="Ingrese el Nombre de la Urbanizacion" name="txtzonaUrbanizacionm" id="txtzonaUrbanizacionm" value="{{$urbEdit->nombre_urbanizacion}}" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\-\(\)\.]*" required/>
                                                                                <!--end::Input-->
                                                                            </div>
                                                                            <!--end::Col-->
                                                                        </div>
                                                                    <div class="modal-footer flex-center">
                                                                        <!--begin::Button-->
                                                                        {{-- <button type="button" i class="btn btn-light me-3" data-bs-dismiss="modal" >Cerrar</button> --}}
                                                                        <a href="/detallesDistritos" type="button" i class="btn btn-light me-3">Cerrar</a>
                                                                        <!--end::Button-->
                                                                        <!--begin::Button-->
                                                                        <button type="submit" id="kt_modal_new_address_submit" class="btn btn-primary">
                                                                            <span class="indicator-label">Registrar</span>
                                                                            <span class="indicator-progress">Please wait...
                                                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                        </button>
                                                                        <!--end::Button-->
                                                                    </div>
                                                                    <!--end::Modal footer-->
                                                                </form>
												</div>
															<!--end::Container-->
											</div>
										</div>
		</div>
							
</div>

@endsection