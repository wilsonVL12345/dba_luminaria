@can('proyecto.show')

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
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Almacen</h1>
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
					<div class="card-body pt-9 pb-0">
						<div class="margin">
                            <form  id="formproyectoModificar" method="POST" >
                                @csrf

                                <div class="from row">
                                    <div class="col-md-3 mb-3">
                                        <label for="txtcodProyEsp" class="required fs-5 fw-bold mb-2">Codigo Proyecto
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permite de 6 a 16 digitos numeros y letras"></i>

                                        </label>
                                        <input type="text" class="form-control form-control-solid " id="txtcodProyEsp" name="txtcodProyEsp" pattern="^[a-zA-Z0-9\/\-]{6,16}$" value="{{$proyec->Cuce_Cod}}" required>
                                    </div>
                                    <div class="col-md-2 mb-1">
                                        <label for="sldisProyEsp" class="required fs-5 fw-bold mb-2">Distrito</label>
                                        <select  aria-label="Select a Country"  class="form-control form-select-solid " data-control="select2" name="sldisProyEsp" data-id="sldisProyEsp" required>
                                            @foreach ($listadistrito as $dis)
                                            <option value="{{$dis->id}}" {{$proyec->Distritos_id==$dis->id ? 'selected':''}}>{{$dis->Distrito}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3 mb-2">
                                        <label class="required fs-6 fw-bold mb-2">Fecha de Ejecucion</label>
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
                                            <input type="date" class="form-control form-control-solid ps-12" placeholder="Select a date" name="txtfechaEsp" id="txtfechaEsp" value="{{$proyec->Fecha_Ejecutada}}" required />
                                            <!--end::Datepicker-->
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <div class="col-md-2 mb-1">
                                        <label for="slTrabajom" class="required fs-5 fw-bold mb-2">Trabajo</label>
                                        <select    class="form-control form-select-solid " data-control="select2" name="slTrabajom" data-id="slTrabajom" required>
                                            <option value="Central">Central</option>
                                            @foreach ($listadistrito as $dis)
                                            <option value="{{$dis->Distrito}}" {{$proyec->Distritos_id==$dis->id ? 'selected':''}}>{{$dis->Distrito}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                                <div class="from row">
                                    <div class="col-md-6 mb-3">
                                        <label for="slUrbproyEsp" class="required fs-5 fw-bold mb-2">Urbanizacion</label>
                                        <select class="form-control form-select-solid" data-control="select2"  name="slUrbproyEsp" data-id="slUrbproyEsp" required>
                                            <option value="{{$proyec->Zona}}">{{$proyec->Zona}}</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3 mb-3">
                                        <label for="sltipContraProyEsp" class="required fs-5 fw-bold mb-2">Tipo de Contratacion</label>
                                        <select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selecione..." name="sltipContraProyEsp" required >
                                            <option value="" >Seleccione...</option>
                                            <option value="Bienes" {{$proyec->Tipo_Contratacion=='Bienes'?'selected':''}}>Bienes</option>
                                            <option value="Servicios"{{$proyec->Tipo_Contratacion=='Servicios'?'selected':''}}>Servicios</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="slsubproEsp" class="required fs-5 fw-bold mb-2">Subasta</label>
                                        <select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selecione..." name="slsubproEsp" required >
                                            <option value="" >Seleccione...</option>
                                            <option value="Si" {{$proyec->Subasta=='Si'?'selected':''}} >Si</option>
                                            <option value="No" {{$proyec->Subasta=='No'?'selected':''}}>No</option>
                                            
                                    </select>
                                    </div>
                                </div>
                                <div class="from row">
                                    <div class="col-md-3 mb-3">
                                        <label for="txtmodProyEsp" class="required fs-5 fw-bold mb-2">Modalidad

                                        </label>
                                        <input type="text" class="form-control form-control-solid " id="txtmodProyEsp" name="txtmodProyEsp" value="{{$proyec->Modalidad}}" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="slsubproEsp" class="required fs-5 fw-bold mb-2">Ejecutado Por</label>
                                        <select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Selecione..." name="slsubproEsp" required >
                                            <option value="GAMEA" {{$proyec->Ejecutado_Por=='GAMEA'?'selected':''}} >GAMEA</option>
                                            <option value="Externo" {{$proyec->Ejecutado_Por=='Externo'?'selected':''}}>Externo</option>
                                            
                                    </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="sltipProyEsp" class="required fs-5 fw-bold mb-2">Tipos de Componentes</label>
                                        <input type="text" class="form-control form-control-solid " id="sltipProyEsp" name="sltipProyEsp" value="{{$proyec->Tipo_Componentes}}" readonly>
                                        
                                            
                                                        
                                    </div>
                                    
                                    
                                    <div class="from row">
                                        <div class="col-md-8 mb-3">
                                            <label for="txtobjetoEsp" class="required fs-5 fw-bold mb-2">Objeto de Contratacion
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números letras mayusculas y minusculas - ()"></i>

                                            </label>
                                            <input type="text" class="form-control form-control-solid " id="txtobjetoEsp" name="txtobjetoEsp" value="{{$proyec->Objeto_Contratacion}}" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\-\(\)\. ]*" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="txtprovProyEsp" class="required fs-5 fw-bold mb-2">Proveedor
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números letras mayusculas y minusculas - ()"></i>

                                            </label>
                                            <input type="text" class="form-control form-control-solid " id="txtprovProyEsp" name="txtprovProyEsp"  pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\-\(\)\. ]*" value="{{$proyec->Proveedor}}" required>
                                        </div>
                                    </div>

                                    
								
							<h1 style="font-weight: bold; text-transform: uppercase;">Proyecto Detalles Componentes</h1>
							
                         
                         @if (!$reutilizada->isEmpty())
						 <h3>luminarias Reutilizadas</h3>
							<div class="table-responsive">
								<table class="table table-bordered" >
									<thead>
										<tr class="fw-bold fs-6 text-gray-800">
											<th style="font-weight: bold; text-transform: uppercase; ">Nombre Item</th>
											<th style="font-weight: bold; text-transform: uppercase;">Cantidad</th>
											
										</tr>
									</thead>
									<tbody>
										@foreach ($reutilizada as $item)
										<tr>
											<td><input type="text" class="form-control form-control-solid " id="txtprovProyEsp" name="txtprovProyEsp"  value="{{$item->Nombre_Item}}" required></td>
                                            <td><input type="text" class="form-control form-control-solid " id="txtprovProyEsp" name="txtprovProyEsp"  value="{{$item->Cantidad}}" required></td>
										</tr>
										@endforeach

										
									</tbody>
								</table>
							</div>
									
									@else
										<h5 class="badge badge-light-danger">No hay luminarias Reutilizadas Disponibles</h5>
									@endif
									
									
									@if (!$accesorios->isEmpty())
									<h3>Accesorios</h3>

									
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr class="fw-bold fs-6 text-gray-800">
													<th style="font-weight: bold; text-transform: uppercase; ">Nombre Item</th>
													<th style="font-weight: bold; text-transform: uppercase; ">Cantidad</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($accesorios as $itemacc)
												<tr>
													<td>
                                                        <select class="form-control form-select-solid" data-control="select2" data-search="false" data-hide-search="true" data-placeholder="Selecione..." name="" id="">
                                                        @foreach ($listAccesorios as $item)
                                                            
                                                        <option value="{{$item->Nombre_Item}}" {{ $item->id == $itemacc->Lista_accesorio->id ? 'selected' : '' }}>
                                                            {{$item->Nombre_Item}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    </td>

													<td><input type="text" class="form-control form-control-solid " id="txtprovProyEsp" name="txtprovProyEsp"  value="{{$itemacc->Cantidad}}" required></td>
												</tr>
                                                
											@endforeach

											</tbody>
										</table>
									</div>
									@else
									<h5 class="badge badge-light-danger">No hay Accesorios en este Proyecto</h5>
								@endif
									
									@if (!$luminaria->isEmpty())
									<h3>Luminarias LED</h3>

									
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr class="fw-bold fs-6 text-gray-800">
													<th style="font-weight: bold; text-transform: uppercase; ">Cod_Luminaria Item</th>
													<th style="font-weight: bold; text-transform: uppercase; ">Modelo</th>
													<th style="font-weight: bold; text-transform: uppercase; ">Marca</th>
													<th style="font-weight: bold; text-transform: uppercase; ">Potencia</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($luminaria as $itemlum)
										<tr>
											<td><input type="text" class="form-control form-control-solid " id="txtprovProyEsp" name="txtprovProyEsp"  value="{{$itemlum->Cod_Luminaria}}" required></td>
											<td><input type="text" class="form-control form-control-solid " id="txtprovProyEsp" name="txtprovProyEsp"  value="{{$itemlum->Marca}}" required></td>
											<td><input type="text" class="form-control form-control-solid " id="txtprovProyEsp" name="txtprovProyEsp"  value="{{$itemlum->Modelo}}" required></td>
											
                                            <td>
                                                <select class="form-control form-select-solid" data-control="select2" data-search="false" data-hide-search="true" data-placeholder="Selecione..." name="" id="">
                                                    <option value="75 Watts"{{'75 Watts'==$itemlum->Potencia ? 'selected':''}}>75 Watts</option>
                                                    <option value="150 Watts"{{'150 Watts'==$itemlum->Potencia ? 'selected':''}}>150 Watts</option>
                                                    <option value="200 Watts"{{'200 Watts'==$itemlum->Potencia ? 'selected':''}}>200 Watts</option>
                                                    <option value="250 Watts"{{'250 Watts'==$itemlum->Potencia ? 'selected':''}}>250 Watts</option>
                                                </select>
                                            </td>
											
										</tr>
										@endforeach
											</tbody>
										</table>
									</div>
									@else
									<h5 class="badge badge-light-danger">No hay luminarias LED en este Proyecto</h5>
								@endif
							
						</div>
                        <div class="modal-footer justify-content-end">
                            <!--begin::Button-->
                            <a href="/proyectos/almacen" type="button" i class="btn btn-secundary me-3">Cerrar</a>

                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="modadRegistraUsuarios_submit" class="btn btn-primary">
                                <span class="indicator-label">Registrar</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </form>

						

					</div>
				</div>
			</div>
				<div class="card mb-5 mb-xl-10">
					<div class="card-body pt-9 pb-0">
						{{-- <h1>Agendar Trabajo</h1> --}}
						
					</div>
				</div>
		</div>
		
		
			
		
		
		<!--end::Container-->
	</div> 
	
</div> 
@endsection
@endcan