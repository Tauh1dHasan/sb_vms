<!DOCTYPE html>
<html>
	
<head>
		
		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>VMS | Visitor Management System</title>	

		<meta name="keywords" content="" />
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Favicon -->
		<link rel="shortcut icon" href="{{asset('frontend/img/favicon.png')}}" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{asset('frontend/img/favicon.png')}}">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400&amp;display=swap" rel="stylesheet" type="text/css">

		@include('frontend.partials.css')

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.min.js"></script>

	</head>
	<body data-plugin-page-transition>

		<div class="body">
			<header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': false, 'stickyEnableOnMobile': false, 'stickyStartAt': 70, 'stickyChangeLogo': false, 'stickyHeaderContainerHeight': 70}">
				<div class="header-body border-top-0 box-shadow-none">
					<div class="header-container header-container-md container">
						<div class="header-row">
							<div class="header-column">
								<div class="header-row">
									<div class="header-logo">
										<a href="{{route('index')}}"><img alt="SEBPO" width="200" height="60" data-sticky-width="82" data-sticky-height="40" data-sticky-top="0" src="{{asset('frontend/img/logo.jpg')}}"></a>
									</div>
								</div>
							</div>
							<div class="header-column justify-content-end">
								<div class="header-row">
									<div class="header-nav header-nav-line header-nav-bottom-line header-nav-bottom-line-no-transform header-nav-bottom-line-active-text-dark header-nav-bottom-line-effect-1 order-2 order-lg-1">
										<div class="header-nav-main header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
											<nav class="collapse">
												<ul class="nav nav-pills" id="mainNav">
													<li class="">
														<a class="active" href="{{route('index')}}">
															Home
														</a>
													</li>
													<li class="">
														<a class="" href="{{route('frontend.about')}}">
															About Us
														</a>
													</li>
													<li class="">
														<a class="" href="{{route('frontend.contact')}}">
															Contact Us
														</a>
													</li>
												</ul>
											</nav>
										</div>
										<button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
											<i class="fas fa-bars"></i>
										</button>
									</div>
									<div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
										<div class="header-nav-feature header-nav-features-search d-inline-flex">
											<a href="{{route('index')}}" class="text-decoration-none" style="color: #212529;">Login</a>
										</div>
										<div class="header-nav-feature header-nav-features-search d-inline-flex ms-2">
											<a href="{{route('frontend.register')}}" class="text-decoration-none" style="color: #212529;">Register</a>
										</div>
									</div>
									<div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2" style="margin-left: 20px;">
										<div class="header-nav-feature header-nav-features-search d-inline-flex">
											<a href="{{route('frontend.employee.create')}}" class="text-decoration-none" style="color: #212529; font-weight: 600;">Employee Registration</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>