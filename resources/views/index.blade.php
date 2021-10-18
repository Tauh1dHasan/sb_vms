@extends('frontend.layouts.master')

@section('content')

			<div role="main" class="main">

				<section class="bg-color-light-scale-1" style="padding: 20px 0;">
					<div class="container py-4">
						<div class="row justify-content-center text-center" style="border-bottom: 5px solid #006F99;">
							<h1 class="font-weight-bold" style="padding-bottom: 20px; font-size: 40px;margin-bottom: 0;">Welcome to VMS</h1>
						</div>

						<div class="row justify-content-center" style="padding-top: 30px;">
							<div class="col-md-6 col-lg-5 mb-5 mb-lg-0">
								<p class="text-justify">SEBPO, formerly known as ServicEngineBPO, is a leading global outsourcing partner to many of the world’s largest advertising, media, and technology companies. The company specializes in ad operations, creative services, data solutions, media planning, and quality assurance. SEBPO offers industry expertise and process governance so organizations can scale, innovate, and control costs.

									SEBPO has been consistently recognized as one of the “5000 Fastest-Growing Private Companies in America” by Inc., and as a Top Global Outsourcing Company (GO100) by the International Association of Outsourcing Professionals (IAOP) since 2014.
									
									Founded in 2006, SEBPO is based in New Jersey with delivery centers in Bangladesh and El Salvador. 
									
									SEBPO’s Mission: Help businesses grow by delivering superior outsourcing services. Attract and retain top talent by creating an exceptional work experience for SEBPO employees.
								</p>
							</div>

							<div class="col-md-6 col-lg-7 mb-5 mb-lg-0" style="padding-left: 40px;">
								@include('backend.partials.message')
								<h2 class="font-weight-bold text-7 mb-0">Login</h2>
								
								<form action="{{route('frontend.user_login')}}" id="frmSignIn" method="post" class="needs-validation" style="margin-top: 10px;">
									@csrf
									<div class="row">
										<div class="form-group col">
											<label class="form-label text-color-dark text-3">Email or Mobile No <span class="text-color-danger">*</span></label>
											<input type="text" value="" name="username" class="form-control form-control-lg text-4" required>
										</div>
									</div>
									<div class="row">
										<div class="form-group col">
											<label class="form-label text-color-dark text-3">Password <span class="text-color-danger">*</span></label>
											<input type="password" value="" name="password" class="form-control form-control-lg text-4" required>
										</div>
									</div>
									<div class="row justify-content-between">
										<div class="form-group col-md-auto">
											<a class="text-decoration-none text-color-dark text-color-hover-primary font-weight-semibold text-2" href="{{ route('frontend.forgotPassword') }}">Forgot Password?</a>
										</div>
									</div>
									<div class="row mt-3">
										<div class="form-group col">
											<button type="submit" class="btn btn-dark btn-modern w-100 text-uppercase rounded-0 font-weight-bold text-3 py-3" data-loading-text="Loading...">Login</button>
										</div>
									</div>
									<div class="row"> 
										<div class="form-group col text-center">
											<p>Don't Have an Account? <a href="{{route('frontend.register')}}" style="color: #212529">Register Here!!!</a></p>
										</div>
									</div>
								</form>
							</div>
						</div>
	
					</div>
				</section>

			</div>

@endsection