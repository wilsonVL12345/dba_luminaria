@can('dashboard.show')

@extends('layout.index')
@section('contenido')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="toolbar" id="kt_toolbar">
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">&nbsp;&nbsp; ANALISIS DE ACTIVIDADES DE MANTENIMIENTO, INSPECCION Y PROYECTOS </h1>

				<span class="h-20px border-gray-300 border-start mx-4"></span>
			</div>
		</div>
	</div>
</div>
	 {{-- para la parte de detalles --}}
		<div class="post d-flex flex-column-fluid" id="kt_post">
			<div id="kt_content_container" class="container-xxl">
					<div class="row g-5 g-xl-10">
						
							<div class="col-xl-4 mb-xl-10">

								<div class="card card-flush h-md-100">
										<div class="card-header flex-nowrap pt-5">
											<!--begin::Title-->
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bolder text-dark">Datos de Mantenimiento Anuales</span>
												<span class="text-gray-400 pt-2 fw-bold fs-6">14  Distritos</span>
											</h3>
										</div>
										<div class="card-body pt-5 ps-6">

											<div id="detallesAnual" class="min-h-auto" style="height: 350px ;">
											</div>
										</div>
								</div>
							</div>
							<div class="col-xl-8 mb-xl-10">
								<!--begin::Chart widget 18-->
								<div class="card card-flush h-xl-100">
									<!--begin::Header-->
									<div class="card-header pt-7">
										<!--begin::Title-->
										<h3 class="card-title align-items-start flex-column">
											<span class="card-label fw-bolder text-gray-800">Datos generales de todos los Distritos Mensuales</span>
											<span class="text-gray-400 mt-1 fw-bold fs-6">Estadisticas</span>
										</h3>
										<!--end::Title-->
										<!--begin::Toolbar-->

										<!--end::Toolbar-->
									</div>
									<!--end::Header-->
									<!--begin::Body-->
									<div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
										<!--begin::Chart-->
										<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
													<div id="graficosdetalles"  style="height: 350px;"></div>
										</div>
										<!--end::Chart-->
									</div>
									<!--end: Card Body-->
								</div>
								<!--end::Chart widget 18-->
							</div>
						<!--end::Col-->
					</div>
			</div>
		</div>


	<div class="post d-flex flex-column-fluid" id="kt_post">
		<div id="kt_content_container" class="container-xxl">
				<div class="row g-5 g-xl-10">

					

						<div class="col-xl-4 mb-xl-10">
								<div class="card card-flush h-md-100">
									<div class="card-header flex-nowrap pt-5">
										<!--begin::Title-->
										<h3 class="card-title align-items-start flex-column">
											<span class="card-label fw-bolder text-dark">Datos de Inspecciones Anuales</span>
											<span class="text-gray-400 pt-2 fw-bold fs-6">14  Distritos</span>
										</h3>
									</div>
										<div class="card-body pt-5 ps-6">

												<div id="inspeccionAnual" class="min-h-auto" style="height: 350px ;">
												</div>
										</div>
								</div>
						</div>
						<div class="col-xl-8 mb-xl-10">
							<!--begin::Chart widget 18-->
							<div class="card card-flush h-xl-100">
								<!--begin::Header-->
								<div class="card-header pt-7">
									<!--begin::Title-->
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder text-gray-800">Datos generales de todos los Distritos Mensuales</span>
										<span class="text-gray-400 mt-1 fw-bold fs-6">Estadisticas</span>
									</h3>
									<!--end::Title-->
									<!--begin::Toolbar-->

									<!--end::Toolbar-->
								</div>
								<!--end::Header-->
								<!--begin::Body-->
								<div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
									<!--begin::Chart-->
									<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
												<div id="graficosinspecciones"  style="height: 350px;"></div>
									</div>
									<!--end::Chart-->
								</div>
								<!--end: Card Body-->
							</div>
							<!--end::Chart widget 18-->
						</div>
						<!--end::Col-->
					</div>
				</div>
			</div>
		


	<div class="post d-flex flex-column-fluid" id="kt_post">
			<div id="kt_content_container" class="container-xxl">
					<div class="row g-5 g-xl-10">
						
						<style>
							.responsive-heading {
							  font-family: Arial, sans-serif;
							  font-size: 2em; /* Tamaño de fuente base */
							  text-align: center;
							  margin: 20px 0;
							  color: #282261; /* Color del texto */
						  
							  /* Estilos responsive */
							  @media (max-width: 768px) {
								font-size: 1.5em; /* Reducir el tamaño de la fuente en pantallas pequeñas */
							  }
						  
							  @media (max-width: 480px) {
								font-size: 1.2em; /* Reducir aún más el tamaño de la fuente en pantallas muy pequeñas */
							  }
							}
						  </style>
						<div class="col-xl-4 mb-xl-10">
							<div class="card card-flush h-md-100">
								<div class="card-header flex-nowrap pt-5">
									<!--begin::Title-->
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder text-dark">Datos de Proyectos Anuales</span>
										<span class="text-gray-400 pt-2 fw-bold fs-6">14  Distritos</span>
									</h3>
								</div>
									<div class="card-body pt-5 ps-6">

											<div id="proyectoAnual" class="min-h-auto" style="height: 350px ;">
											</div>
									</div>
							</div>
						</div>
						<div class="col-xl-8 mb-xl-10">
							<!--begin::Chart widget 18-->
							<div class="card card-flush h-xl-100">
								<!--begin::Header-->
								<div class="card-header pt-7">
									<!--begin::Title-->
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder text-gray-800">Datos generales de todos los Distritos Mensuales</span>
										<span class="text-gray-400 mt-1 fw-bold fs-6">Estadisticas</span>
									</h3>
									<!--end::Title-->
									<!--begin::Toolbar-->

									<!--end::Toolbar-->
								</div>
								<!--end::Header-->
								<!--begin::Body-->
								<div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
									<!--begin::Chart-->
									<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
												<div id="graficosproyectos"  style="height: 350px;"></div>
									</div>
									<!--end::Chart-->
								</div>
								<!--end: Card Body-->
							</div>
							<!--end::Chart widget 18-->
						</div>
					<!--end::Col-->
					</div>
			</div>

	</div>




@endsection
@endcan