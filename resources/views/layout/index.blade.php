<?php


	if (empty(session()->get('id'))) {
      return redirect('/login'); 
	}
	
	?>

<!DOCTYPE html>
<html lang="en">
<head>
@include('layout.head')
</head>
<!--end::Head-->
<!--begin::Body-->


<body id="kt_body"

			

	class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
	style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
	<!--begin::Main-->
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="page d-flex flex-row flex-column-fluid">
			<!--begin::Aside-->
			<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true"
				data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
				data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
				data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
				<!--begin::Brand-->
				<div class="aside-logo flex-column-auto" id="kt_aside_logo">
					<!--begin::Logo-->
						
						{{-- 	<a href="/dashdetalles">
							<img alt="Logo" src="{{ asset('assets/media/logos/trace.svg') }}" class="h-70px logo loguito " />
							</a> --}}
							{{-- <div class="logo-container">
								<a href="/dashdetalles">
									<img alt="Logo" src="{{ asset('assets/media/logos/trace.svg') }}"  class="h-120px logo loguito " />
								</a>
							</div> --}}
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
					<!--end::Logo-->
					<!--begin::Aside toggler-->
					<div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
						data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
						data-kt-toggle-name="aside-minimize">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
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
						<!--end::Svg Icon-->
					</div>
					<!--end::Aside toggler-->
				</div>
				<!--end::Brand-->


				{{-- esta parte llama a lo que es el menu principal --}}
				@include('...layout.menu')

				
			</div>
			<!--end::Aside-->
			<!--begin::Wrapper-->
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<!--begin::Header-->
				<div id="kt_header" style="" class="header align-items-stretch">
					<!--begin::Container-->
					<div class="container-fluid d-flex align-items-stretch justify-content-between">
						<!--begin::Aside mobile toggle-->
						<div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
							<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
								id="kt_aside_mobile_toggle">
								<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
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
								<!--end::Svg Icon-->
							</div>
						</div>
						<!--end::Aside mobile toggle-->
						<!--begin::Mobile logo-->
						<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
							<a href="{{-- ../../demo1/dist/index.html --}}" class="d-lg-none">
								<img alt="Logo gamea" src="{{asset('assets/media/logos/gamea.svg')}}" class="h-40px" />
							</a>
							<style>
								.custom-h1 {
									font-size: 2rem; /* Tamaño de la fuente */
									font-weight: bold; /* Peso de la fuente */
									line-height: 1.2; /* Altura de línea para reducir el espacio */
									text-align: start; /* Centrar el texto */
									color: #131325; /* Color del texto */
									margin-bottom: 0.5rem; /* Margen inferior */
								}
							</style>
							<div>
								
								  <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
									<h1><strong>DIRECCION DE ALUMBRADO PUBLICO</strong></h1>
									<h1><strong> UNIDAD OPERATIVA DE ALUMBRADO PUBLICO</strong></h1>
							</div>
						</div>
						</div>
						<!--end::Mobile logo-->
						<!--begin::Wrapper-->
						<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
							<!--begin::Navbar-->
							<div class="d-flex align-items-stretch" id="kt_header_nav">
								<!--begin::Menu wrapper-->
								<div class="header-menu align-items-stretch" data-kt-drawer="true"
									data-kt-drawer-name="header-menu"
									data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
									data-kt-drawer-width="{default:'200px', '300px': '250px'}"
									data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle"
									data-kt-swapper="true" data-kt-swapper-mode="prepend"
									data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">

																<!--begin::Menu-->
								<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" {{-- menuprincipal --}}
								id="#kt_header_menu" data-kt-menu="true"> 

								{{-- la parte de arriba todo  --}}
								</div>
								<!--end::Menu-->
								</div>
								<!--end::Menu wrapper-->
							</div>
							<!--end::Navbar-->
							<!--begin::Toolbar wrapper-->

							{{-- la parte de arriba lo que se repite --}}
							<div class="d-flex align-items-stretch flex-shrink-0">
								<!--begin::User menu-->
								<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
									<!--begin::Menu wrapper-->
									<div class="cursor-pointer symbol symbol-140px symbol-md-140px"
										data-kt-menu-trigger="click" data-kt-menu-attach="parent"
										data-kt-menu-placement="bottom-end">
										<img src="{{ session('perfil') }}" alt="user" />
									</div>
									<!--begin::User account menu-->
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
										data-kt-menu="true">
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												<!--begin::Avatar-->
												<div class="symbol symbol-50px me-5">
													<img alt="Logo" src="{{ session('perfil') }}" />
												</div>
												<!--end::Avatar-->
												<!--begin::Username-->
												<div class="d-flex flex-column">
													<div class="fw-bolder d-flex align-items-center fs-5">{{ucfirst(session('name'))}} {{ucfirst(session('paterno'))}}
														<span
															class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Activo</span>
													</div>
													<a href="#"
														class="fw-bold text-muted text-hover-primary fs-7">{{session('cargo')}}</a>
												</div>
												<!--end::Username-->
											</div>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="{{url('/usuario/perfil/'.session('id')) }}" class="menu-link px-5">My
												Profile</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="../../demo1/dist/apps/projects/list.html" class="menu-link px-5">
												<span class="menu-text">My Projects</span>
												<span class="menu-badge">
													<span
														class="badge badge-light-danger badge-circle fw-bolder fs-7">3</span>
												</span>
											</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-5 my-1">
											<a href="../../demo1/dist/account/settings.html"
												class="menu-link px-5">Restablecer Contraseña</a>
										</div>
										<!--end::Menu item-->
										<div class="separator my-2"></div>

										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="{{ route('logout') }}"
												class="menu-link px-5">Cerrar Sesion</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
										<!--begin::Menu item-->

										{{-- para poner en modo oscuso  pero  esta desabilitado --}}
										{{-- <div class="menu-item px-5">
											<div class="menu-content px-5">
												<label
													class="form-check form-switch form-check-custom form-check-solid pulse pulse-success"
													for="kt_user_menu_dark_mode_toggle">
													<input class="form-check-input w-30px h-20px" type="checkbox"
														value="1" name="mode" id="kt_user_menu_dark_mode_toggle"
														data-kt-url="../../demo1/dist/index.html" />
													<span class="pulse-ring ms-n1"></span>
													<span class="form-check-label text-gray-600 fs-7">Dark Mode</span>
												</label>
											</div>
										</div> --}}
										<!--end::Menu item-->
									</div>
									<!--end::User account menu-->
									<!--end::Menu wrapper-->
								</div>
								<!--end::User menu-->
								<!--begin::Header menu toggle-->
								{{-- <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
									<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
										id="kt_header_menu_mobile_toggle">
										<!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
										<span class="svg-icon svg-icon-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
												viewBox="0 0 24 24" fill="none">
												<path
													d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z"
													fill="currentColor" />
												<path opacity="0.3"
													d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z"
													fill="currentColor" />
											</svg>
										</span>
										<!--end::Svg Icon-->
									</div>
								</div> --}}
								<!--end::Header menu toggle-->
									
								
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
						<!--end::Wrapper-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Header-->
				<!--begin::Content-->

				<!--begin::Content-->
				{{-- todo el contenido que se tiene que cambiar --}}
					@yield('contenido')
				
		</div>
					<!--end::Wrapper-->
	</div>

</div>
					<!--end::Root-->
					<!--begin::Drawers-->
					<!--begin::Activities drawer-->
	<div id="kt_activities" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="activities"
		data-kt-drawer-activate="true" data-kt-drawer-overlay="true"
		data-kt-drawer-width="{default:'300px', 'lg': '900px'}" data-kt-drawer-direction="end"
		data-kt-drawer-toggle="#kt_activities_toggle" data-kt-drawer-close="#kt_activities_close">
		<div class="card shadow-none rounded-0">
			<!--begin::Header-->
			<div class="card-header" id="kt_activities_header">
				<h3 class="card-title fw-bolder text-dark">Activity Logs</h3>
				<div class="card-toolbar">
					<button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5"
						id="kt_activities_close">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
						<span class="svg-icon svg-icon-1">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
								fill="none">
								<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
									transform="rotate(-45 6 17.3137)" fill="currentColor" />
								<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
									fill="currentColor" />
							</svg>
						</span>
						<!--end::Svg Icon-->
					</button>
				</div>
			</div>
			<!--end::Header-->
			<!--begin::Body-->
			<div class="card-body position-relative" id="kt_activities_body">
				<!--begin::Content-->
				<div id="kt_activities_scroll" class="position-relative scroll-y me-n5 pe-5" data-kt-scroll="true"
					data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_activities_body"
					data-kt-scroll-dependencies="#kt_activities_header, #kt_activities_footer"
					data-kt-scroll-offset="5px">
					<!--begin::Timeline items-->
					
				</div>
				<!--end::Content-->
			</div>
			<!--end::Body-->
			<!--begin::Footer-->
			<div class="card-footer py-5 text-center" id="kt_activities_footer">
				<a href="../../demo1/dist/pages/user-profile/activity.html" class="btn btn-bg-body text-primary">View
					All Activities
					<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
					<span class="svg-icon svg-icon-3 svg-icon-primary">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
								transform="rotate(-180 18 13)" fill="currentColor" />
							<path
								d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
								fill="currentColor" />
						</svg>
					</span>
					<!--end::Svg Icon--></a>
			</div>
			<!--end::Footer-->
		</div>
	</div>


	{{-- esta parte para poner los tutoriales --}}
	<div class="engage-toolbar d-flex position-fixed px-5 fw-bolder zindex-2 top-50 end-0 transform-90 mt-20 gap-2">
		<!--begin::Demos drawer toggle-->
		<button id="kt_engage_demos_toggle"
			class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0"
			title="Como manejar el Sistema" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-dismiss="click"
			data-bs-trigger="hover">
			<span id="kt_engage_demos_label">Tutoriales</span>
		</button>
		<!--end::Demos drawer toggle-->
		<!--begin::Help drawer toggle-->
		<button id="kt_help_toggle"
			class="engage-help-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm px-5 rounded-top-0"
			title="Learn &amp; Get Inspired" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-dismiss="click"
			data-bs-trigger="hover">Manual de Usuarios</button>
		<!--end::Help drawer toggle-->
		<!--begin::Purchase link-->
		{{-- <a href="https://1.envato.market/EA4JP" target="_blank"
			class="engage-purchase-link btn btn-color-gray-700 bg-body btn-active-color-gray-900' btn-flex h-35px px-5 shadow-sm rounded-top-0">Detalles</a> --}}
		<!--end::Purchase link-->
	</div>
	<!--end::Engage toolbar-->
	<!--begin::Scrolltop-->
	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
		<span class="svg-icon">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
					fill="currentColor" />
				<path
					d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
					fill="currentColor" />
			</svg>
		</span>
		<!--end::Svg Icon-->
	</div>
	<!--end::Scrolltop-->
	
	@include('layout.script')
	<!--begin::Page loading(append to body)-->
<div class="page-loader flex-column bg-dark bg-opacity-25">
    <span class="spinner-border text-primary" role="status"></span>
    <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>
</div>
<!--end::Page loading-->
</body>
<!--end::Body-->

</html>