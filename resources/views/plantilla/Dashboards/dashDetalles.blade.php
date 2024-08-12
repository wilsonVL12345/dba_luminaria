@extends('layout.index')
@section('contenido')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="toolbar" id="kt_toolbar">
		<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Información de Zonas y Urbanizaciones</h1>
				
				<span class="h-20px border-gray-300 border-start mx-4"></span>
			</div>
		</div>
	</div>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="card card-bordered">
		<div class="card-body">
			<div id="graficosdetalles" style="height: 350px;"></div>
		</div>
	</div> 
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<div id="kt_content_container" class="container-xxl">
			<div class="row g-5 g-xl-10 mb-xl-10">
				<div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush overflow-hidden h-md-100">
						<div class="card-header py-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Actividades Distritales - Distrito 1</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Detalles Especificos</span>
							</h3>
						</div>
						<div id="dis1"></div>
					</div>
				</div>
				<div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush overflow-hidden h-md-100">
						<div class="card-header py-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Actividades Distritales - Distrito 2</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Detalles Especificos</span>
							</h3>
						</div>
						<div id="dis2"></div>
					</div>
				</div>
				<div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush overflow-hidden h-md-100">
						<div class="card-header py-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Actividades Distritales - Distrito 3</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Detalles Especificos</span>
							</h3>
						</div>
						<div id="dis3"></div>
					</div>
				</div>
				<div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush overflow-hidden h-md-100">
						<div class="card-header py-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Actividades Distritales - Distrito 4</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Detalles Especificos</span>
							</h3>
						</div>
						<div id="dis4"></div>
					</div>
				</div>
				<div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush overflow-hidden h-md-100">
						<div class="card-header py-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Actividades Distritales - Distrito 5</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Detalles Especificos</span>
							</h3>
						</div>
						<div id="dis5"></div>
					</div>
				</div><div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush overflow-hidden h-md-100">
						<div class="card-header py-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Actividades Distritales - Distrito 6</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Detalles Especificos</span>
							</h3>
						</div>
						<div id="dis6"></div>
					</div>
				</div><div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush overflow-hidden h-md-100">
						<div class="card-header py-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Actividades Distritales - Distrito 7</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Detalles Especificos</span>
							</h3>
						</div>
						<div id="dis7"></div>
					</div>
				</div><div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush overflow-hidden h-md-100">
						<div class="card-header py-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Actividades Distritales - Distrito 8</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Detalles Especificos</span>
							</h3>
						</div>
						<div id="dis8"></div>
					</div>
				</div><div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush overflow-hidden h-md-100">
						<div class="card-header py-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Actividades Distritales - Distrito 9</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Detalles Especificos</span>
							</h3>
						</div>
						<div id="dis9"></div>
					</div>
				</div><div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush overflow-hidden h-md-100">
						<div class="card-header py-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Actividades Distritales - Distrito 10</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Detalles Especificos</span>
							</h3>
						</div>
						<div id="dis10"></div>
					</div>
				</div><div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush overflow-hidden h-md-100">
						<div class="card-header py-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Actividades Distritales - Distrito 11</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Detalles Especificos</span>
							</h3>
						</div>
						<div id="dis11"></div>
					</div>
				</div><div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush overflow-hidden h-md-100">
						<div class="card-header py-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Actividades Distritales - Distrito 12</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Detalles Especificos</span>
							</h3>
						</div>
						<div id="dis12"></div>
					</div>
				</div><div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush overflow-hidden h-md-100">
						<div class="card-header py-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Actividades Distritales - Distrito 13</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Detalles Especificos</span>
							</h3>
						</div>
						<div id="dis13"></div>
					</div>
				</div><div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush overflow-hidden h-md-100">
						<div class="card-header py-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Actividades Distritales - Distrito 14</span>
								<span class="text-gray-400 mt-1 fw-bold fs-6">Detalles Especificos</span>
							</h3>
						</div>
						<div id="dis14"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection