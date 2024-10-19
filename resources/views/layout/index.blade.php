<?php
	if (empty(session()->get('id'))) {
      return redirect('/login'); 
	}
	?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<base href="">
	<title>Unidad de luminarias publicas GAMEA</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

@include('layout.head')
</head>
<body id="kt_body"
	class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
	style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
	<div class="d-flex flex-column flex-root">
		<div class="page d-flex flex-row flex-column-fluid">
			<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true"
				data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
				data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
				data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
				{{-- para la parte del logo de la luminariak --}}
				<div class="aside-logo flex-column-auto" id="kt_aside_logo">
						
						
							<div class="logo-container">
								<a href="#" class="d-flex align-items-center">
									<img alt="Logo" src="{{ asset('assets/media/logos/trace.svg') }}" class="h-50px logo loguito  " />
									<span class="logo-text logo loguito"> LUMINARIA</span>

								</a>

							</div>
							<style>
								.logo-container {
									display: flex;
									justify-content: center;
									align-items: center;
									width: 100%;
									padding: 5px 0;
								}

								.logo-container a {
									display: flex;
									align-items: center;
									text-decoration: none;
								}

								.logo-container img.logo {
									height: 120px;
									width: auto;
								}

								.logo-text {
									
									font-family: Arial, sans-serif;
									font-size: 18px; /* Ajusta este tamaño según sea necesario */
									font-weight: bold;
									color: #ffffff; /* Asume que el fondo es oscuro, ajusta si es necesario */
									margin-left: 10px; /* Espacio entre el logo y el texto */ 

								}
							</style>
					
					<div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
						data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
						data-kt-toggle-name="aside-minimize">
						<span class="svg-icon svg-icon-1 rotate-180">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
								fill="none">
								<path opacity="0.5"
									d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
									fill="currentColor" />
								<path
									d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
									fill="currentColor" />
							</svg>
						</span>
					</div>
				</div>
			
				{{-- esta parte llama a lo que es el menu principal --}}
				@include('...layout.menu')
				
			</div>
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<div id="kt_header" style="" class="header align-items-stretch">
					{{-- para la parte de la cabezera principal --}}
					<div class="container-fluid d-flex align-items-stretch justify-content-between" >
						<div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
							<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
								id="kt_aside_mobile_toggle">
								<span class="svg-icon svg-icon-1">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none">
										<path
											d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
											fill="currentColor" />
										<path opacity="0.3"
											d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
											fill="currentColor" />
									</svg>
								</span>
							</div>
						</div>
						
						<style>
						.custom-header {
							font-family: 'Times New Roman', Times, serif;
							color: #131325;
							line-height: 1.2;
						}
						.custom-header h1 {
							font-size: 1.5rem;
							font-weight: bold;
							margin-bottom: 0.25rem;
							white-space: nowrap;
							overflow: hidden;
							text-overflow: ellipsis;
						}
						@media (min-width: 768px) {
							.custom-header h1 {
								font-size: 1.75rem;
							}
						}
						@media (min-width: 992px) {
							.custom-header h1 {
								font-size: 2rem;
							}
						}
						@media (max-width: 575.98px) {
							.custom-header .title-full, .custom-header .title-medium, .custom-header .secondary-title {
								display: none;
							}
							.custom-header .title-short {
								display: inline;
							}
						}
						@media (min-width: 576px) and (max-width: 991.98px) {
							.custom-header .title-full, .custom-header .title-short, .custom-header .secondary-title {
								display: none;
							}
							.custom-header .title-medium {
								display: inline;
							}
						}
						@media (min-width: 992px) {
							.custom-header .title-medium, .custom-header .title-short {
								display: none;
							}
							.custom-header .title-full, .custom-header .secondary-title {
								display: inline;
							}
						}
						.stats-container {
							display: flex;
							justify-content: flex-end;
							align-items: center;
							flex-wrap: nowrap;
							gap: 20px;
						}
						.stat-item {
							text-align: center;
							white-space: nowrap;
						}
						.stat-value {
							font-size: 1.2rem;
							font-weight: bold;
							color: #009ef7;
						}
						.stat-label {
							font-size: 0.9rem;
							color: #5e6278;
						}

						@media (max-width: 1400px) {
						/* Cambiar el ancho mínimo de los contenedores */
						.min-w-100px, .min-w-75px, .min-w-85px {
							min-width: 30px !important;
						}

						/* Ocultar las etiquetas de texto debajo de los números */
						.fw-bold.fs-6.text-gray-400 {
							display: none;
						}
						}

						</style>
						
									<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
										<a href="#" class="d-lg-none">
											<img alt="Logo gamea" src="/assets/media/logos/gamea.svg" class="h-40px" />
										</a>
										<div class="custom-header ms-3">
											<h1>
												<span class="title-full">DIRECCION DE ALUMBRADO PUBLICO</span>
												<span class="title-medium">DIRECCION DE ALUMBRADO</span>
												<span class="title-short"> </span>
											</h1>
											<h1 class="secondary-title">
												UNIDAD OPERATIVA 
											</h1>
										</div>
									</div>
								
						<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
							<div class="d-flex align-items-stretch" id="kt_header_nav">
								<div class="header-menu align-items-stretch" data-kt-drawer="true"
									data-kt-drawer-name="header-menu"
									data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
									data-kt-drawer-width="{default:'200px', '300px': '250px'}"
									data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle"
									data-kt-swapper="true" data-kt-swapper-mode="prepend"
									data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">

								<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" {{-- menuprincipal --}}
								id="#kt_header_menu" data-kt-menu="true"> 

								{{-- la parte de arriba todo  --}}
								</div>
								</div>
							</div>
							@if (session('cargo')=='Administrador'||session('cargo')=='Admin'||session('cargo')=='Veedor')
							@else
							<div class="d-flex flex-wrap ms-auto ">
								<a href="/pendiente/trabajo">
								<div class="border border-gray-300 border-dashed rounded min-w-100px py-2 px-3 me-6 mb-3">
									<div class="d-flex align-items-center">
										<span class="svg-icon svg-icon-3 svg-icon-danger me-2">
											<svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 16 16" {...$$props}>
												<path fill="currentColor" fill-rule="evenodd" d="M11.25 2.5a2.25 2.25 0 0 0-2.154 2.904l.13.43l-.317.318l-6.254 6.253l-.53-.53l.53.53a.664.664 0 0 0 .94.94L9.848 7.09l.318-.318l.43.13a2.25 2.25 0 0 0 2.685-3.124l-1.5 1.501a.75.75 0 1 1-1.061-1.06l1.5-1.5a2.24 2.24 0 0 0-.97-.22ZM7.5 4.75a3.75 3.75 0 1 1 3.114 3.696L10.061 9l.939.94l.47-.47l.53-.53l.53.53l1.875 1.875a2.164 2.164 0 1 1-3.06 3.06L9.47 12.53L8.94 12l.53-.53l.47-.47l-.94-.94l-4.345 4.345l-.53-.53l.53.53a2.164 2.164 0 1 1-3.06-3.06L5.939 7L3.5 4.56l-.617.617l-.507-.761l-1-1.5l-.341-.512l.435-.434l.5-.5l.434-.435l.512.341l1.5 1l.761.507l-.616.617L7 5.94l.554-.554A4 4 0 0 1 7.5 4.75m4.5 6.31l1.345 1.345a.664.664 0 0 1-.94.94L11.061 12z" clip-rule="evenodd" />
											</svg>
										</span>
										<div class="fs-2 fw-bolder" style="color: black;" data-kt-countup="true" data-kt-countup-value="{{ $mantenimientoCount }}" >0</div>
									</div>
									<div class="fw-bold fs-6 text-gray-400">Mantenimientos</div>
								</div>
									</a>
								<a href="/proyectos/almacen">
								<div class="border border-gray-300 border-dashed rounded min-w-75px py-2 px-3 me-6 mb-3">
									<div class="d-flex align-items-center">
										<span class="svg-icon svg-icon-3 svg-icon-danger me-2">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
												viewBox="0 0 24 24" fill="none">
												<path opacity="0.3"
													d="M4.05424 15.1982C8.34524 7.76818 13.5782 3.26318 20.9282 2.01418C21.0729 1.98837 21.2216 1.99789 21.3618 2.04193C21.502 2.08597 21.6294 2.16323 21.7333 2.26712C21.8372 2.37101 21.9144 2.49846 21.9585 2.63863C22.0025 2.7788 22.012 2.92754 21.9862 3.07218C20.7372 10.4222 16.2322 15.6552 8.80224 19.9462L4.05424 15.1982ZM3.81924 17.3372L2.63324 20.4482C2.58427 20.5765 2.5735 20.7163 2.6022 20.8507C2.63091 20.9851 2.69788 21.1082 2.79503 21.2054C2.89218 21.3025 3.01536 21.3695 3.14972 21.3982C3.28408 21.4269 3.42387 21.4161 3.55224 21.3672L6.66524 20.1802L3.81924 17.3372ZM16.5002 5.99818C16.2036 5.99818 15.9136 6.08615 15.6669 6.25097C15.4202 6.41579 15.228 6.65006 15.1144 6.92415C15.0009 7.19824 14.9712 7.49984 15.0291 7.79081C15.0869 8.08178 15.2298 8.34906 15.4396 8.55884C15.6494 8.76862 15.9166 8.91148 16.2076 8.96935C16.4986 9.02723 16.8002 8.99753 17.0743 8.884C17.3484 8.77046 17.5826 8.5782 17.7474 8.33153C17.9123 8.08486 18.0002 7.79485 18.0002 7.49818C18.0002 7.10035 17.8422 6.71882 17.5609 6.43752C17.2796 6.15621 16.8981 5.99818 16.5002 5.99818Z"
													fill="currentColor" />
												<path
													d="M4.05423 15.1982L2.24723 13.3912C2.15505 13.299 2.08547 13.1867 2.04395 13.0632C2.00243 12.9396 1.9901 12.8081 2.00793 12.679C2.02575 12.5498 2.07325 12.4266 2.14669 12.3189C2.22013 12.2112 2.31752 12.1219 2.43123 12.0582L9.15323 8.28918C7.17353 10.3717 5.4607 12.6926 4.05423 15.1982ZM8.80023 19.9442L10.6072 21.7512C10.6994 21.8434 10.8117 21.9129 10.9352 21.9545C11.0588 21.996 11.1903 22.0083 11.3195 21.9905C11.4486 21.9727 11.5718 21.9252 11.6795 21.8517C11.7872 21.7783 11.8765 21.6809 11.9402 21.5672L15.7092 14.8442C13.6269 16.8245 11.3061 18.5377 8.80023 19.9442ZM7.04023 18.1832L12.5832 12.6402C12.7381 12.4759 12.8228 12.2577 12.8195 12.032C12.8161 11.8063 12.725 11.5907 12.5653 11.4311C12.4057 11.2714 12.1901 11.1803 11.9644 11.1769C11.7387 11.1736 11.5205 11.2583 11.3562 11.4132L5.81323 16.9562L7.04023 18.1832Z"
													fill="currentColor" />
											</svg>
										</span>
										<div class="fs-2 fw-bolder" style="color: black;" data-kt-countup="true" data-kt-countup-value="{{$proyectoCount}}">0</div>
									</div>
									<div class="fw-bold fs-6 text-gray-400">Proyectos</div>
								</div>
									</a>
								<a href="/inspecciones/espera">
								<div class="border border-gray-300 border-dashed rounded min-w-85px py-2 px-3 me-6 mb-3">
									<div class="d-flex align-items-center">
										<span class="svg-icon svg-icon-3 svg-icon-danger me-2">
											<svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 32 32" {...$$props}>
												<path fill="currentColor" d="m29.707 19.293l-3-3a1 1 0 0 0-1.414 0L16 25.586V30h4.414l9.293-9.293a1 1 0 0 0 0-1.414M19.586 28H18v-1.586l5-5L24.586 23zM26 21.586L24.414 20L26 18.414L27.586 20zM20 13v-2h-2.142a4 4 0 0 0-.425-1.019l1.517-1.517l-1.414-1.414l-1.517 1.517A4 4 0 0 0 15 8.142V6h-2v2.142a4 4 0 0 0-1.019.425L10.464 7.05L9.05 8.464l1.517 1.517A4 4 0 0 0 10.142 11H8v2h2.142a4 4 0 0 0 .425 1.019L9.05 15.536l1.414 1.414l1.517-1.517a4 4 0 0 0 1.019.425V18h2v-2.142a4 4 0 0 0 1.019-.425l1.517 1.517l1.414-1.414l-1.517-1.517A4 4 0 0 0 17.858 13zm-6 1a2 2 0 1 1 2-2a2.003 2.003 0 0 1-2 2" />
												<path fill="currentColor" d="M12 30H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10h-2V4H6v24h6Z" />
											</svg>
										</span>
										<div class="fs-2 fw-bolder" style="color: black;" data-kt-countup="true" data-kt-countup-value="{{$inspeccionCount}}" >0</div>
									</div>
									<div class="fw-bold fs-6 text-gray-400">Inspecciones</div>
								</div>
								</a>
							</div>
							@endif
							{{-- la parte de arriba lo que se repite --}}
							<div class="d-flex align-items-stretch flex-shrink-0">
								<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
									<div class="cursor-pointer symbol symbol-140px symbol-md-140px"
										data-kt-menu-trigger="click" data-kt-menu-attach="parent"
										data-kt-menu-placement="bottom-end">
										<img src="{{ session('perfil') }}" alt="user" />
									</div>
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
										data-kt-menu="true">
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												<div class="symbol symbol-50px me-5">
													<img alt="Logo" src="{{ session('perfil') }}" />
												</div>
												<div class="d-flex flex-column">
													<div class="fw-bolder d-flex align-items-center fs-5">{{ucfirst(session('name'))}} {{ucfirst(session('paterno'))}}
														<span
															class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Activo</span>
													</div>
													<a href="#"
														class="fw-bold text-muted text-hover-primary fs-7">{{session('cargo')}}</a>
												</div>
											</div>
										</div>
										<div class="separator my-2"></div>
										<div class="menu-item px-5">
											<a href="{{url('/usuario/perfil/'.session('id')) }}" class="menu-link px-5">My
												Profile</a>
										</div>
									
										@if (session('cargo')=='Admin')
										@else
										<div class="menu-item px-5 my-1">
											<a href="{{url('/cambiar/password'.session('id')) }}"
												class="menu-link px-5">Cambiar Contraseña</a>
										</div>
										@endif
										<div class="separator my-2"></div>

										<div class="menu-item px-5">
											<a href="{{ route('logout') }}"
												class="menu-link px-5">Cerrar Sesion</a>
										</div>
										<div class="separator my-2"></div>
									
									</div>
								</div>
								
									
								
								<div class="d-flex align-items-center flex-shrink-0 user-info">
									<?php
									$id = session('id');
									$name = session('name');
									$paterno = session('paterno');
									$lugarDesignado = session('Lugar_Designado')/*  */;
									$cargo = session('cargo');
									?>
									
									 <div class="d-flex flex-column">
										<span class="fw-bold text-dark capitalize">&nbsp; {{$name}} {{$paterno}}</span>
										<small class="text-muted capitalize">&nbsp;
											<i class="fas fa-map-marker-alt me-1"></i>{{$lugarDesignado}}
										</small>
										<small class="text-muted capitalize">&nbsp;
											<i class="fas fa-briefcase me-1"></i>{{$cargo}}
										</small>
									</div>
									<style>
										.fw-bold {
										font-weight: bold;
									}

									.text-dark {
										color: #000;
									}

									.uppercase {
										text-transform: uppercase;
									}

									.capitalize {
										text-transform: capitalize;
									}

									.text-muted {
										color: #6c757d;
									}

									.me-1 {
										margin-right: 0.25rem;
									}

									</style>
									
								</div>
							</div>
							

						</div>
					</div>
				</div>
			
				{{-- todo el contenido que se tiene que cambiar --}}
					@yield('contenido')
				
			</div>
		</div>

	</div>			
	

	{{-- esta parte para poner los tutoriales --}}
	<div class="engage-toolbar d-flex position-fixed px-5 fw-bolder zindex-2 top-50 end-0 transform-90 mt-20 gap-2">
		{{-- <button id="kt_engage_demos_toggle"
			class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0"
			title="Como manejar el Sistema" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-dismiss="click"
			data-bs-trigger="hover">
			<span id="kt_engage_demos_label">Tutoriales</span>
		</button> --}}
		<button id="kt_help_toggle"
			class="engage-help-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm px-5 rounded-top-0"
			title="Learn &amp; Get Inspired" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-dismiss="click"
			data-bs-trigger="hover">Manual de Usuarios</button>
		
	</div>
	
<div class="page-loader flex-column bg-dark bg-opacity-25">
    <span class="spinner-border text-primary" role="status"></span>
    <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>
</div>
@include('layout.script')

</body>

</html>