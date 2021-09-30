@extends('frontend.layouts.master')

@section('content')

			<div role="main" class="main">

				<section class="bg-color-light-scale-1" style="padding: 20px 0;">
					<div class="container py-4">
						<div class="row justify-content-center text-center" style="border-bottom: 5px solid #006F99;">
							<h1 class="font-weight-bold" style="padding-bottom: 20px; font-size: 40px;margin-bottom: 0;">Registration</h1>
						</div>

						<div class="row justify-content-center" style="padding-top: 30px;">

							@include('backend.partials.message')

							<div class="col-md-12 col-lg-12 mb-5 mb-lg-0">
								<form action="{{route('frontend.user_registration')}}" id="frmSignIn" method="post" class="needs-validation" style="margin-top: 10px;" enctype="multipart/form-data" name="frmSignIn">
									{{csrf_field()}}

									<input type="hidden" value="4" name="user_type_id" class="form-control form-control-lg text-4">

									<div class="row">
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">First Name <span class="text-color-danger">*</span></label>
											<input type="text" value="{{old('first_name')}}" name="first_name" class="form-control form-control-lg text-4" required="">
										</div>
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Last Name <span class="text-color-danger">*</span></label>
											<input type="text" value="{{old('last_name')}}" name="last_name" class="form-control form-control-lg text-4" required>
										</div>
									</div>

									<div class="row">
										<div class="form-group col-md-6">
											<label class="form-label mb-1 text-2">Visitor Type <span class="text-color-danger">*</span></label>
											<select data-msg-required="Please enter the visitor_type." class="form-control text-3 h-auto py-2" name="visitor_type" id="visitor_type" required="">
												<option value="">--Select Visitor Type--</option> 
												@foreach($visitor_types as $visitor_type)
													<option value="{{ $visitor_type->visitor_type_id }}">{{ $visitor_type->visitor_type }}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group col-md-6">
											<label class="form-label text-color-dark text-3">Profile Photo</label>
											<input class="form-control d-block" name="profile_photo" type="file" id="profile_photo">
										</div>
									</div>

									<div class="row">
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Organization Name <span class="text-color-danger">*</span></label>
											<input type="text" value="{{old('organization')}}" name="organization" class="form-control form-control-lg text-4" required>
										</div>
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Designation</label>
											<input type="text" value="{{old('designation')}}" name="designation" class="form-control form-control-lg text-4">
										</div>
									</div>

									<div class="row">
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Mobile No <span class="text-color-danger">*</span></label>
											<input type="text" value="{{old('mobile_no')}}" name="mobile_no" class="form-control form-control-lg text-4" required>
										</div>
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Email <span class="text-color-danger">*</span></label>
											<input type="email" value="{{old('email')}}" name="email" class="form-control form-control-lg text-4" required>
										</div>
									</div>

									<div class="row">
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Password <span class="text-color-danger">*</span></label>
											<input type="password" value="" placeholder="at least 1 uppercase, 1 lowercase and 1 number character" name="password" class="form-control form-control-lg text-4" required>
										</div>
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Confirm Password <span class="text-color-danger">*</span></label>
											<input type="password" value="" name="password_confirmation" class="form-control form-control-lg text-4">
										</div>
									</div>

									<div class="row">
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Address</label>
											<textarea type="text" row="3" name="address" class="form-control form-control-lg text-4">{{old('address')}}</textarea>
										</div>
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">NID (Optional)</label>
											<textarea type="text" row="3" name="nid_no" class="form-control form-control-lg text-4">{{old('nid_no')}}</textarea>
										</div>
									</div>

									<div class="row">
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Driving License (Optional)</label>
											<input type="text" value="{{old('driving_license_no')}}" name="driving_license_no" class="form-control form-control-lg text-4">
										</div>
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Passport (Optional)</label>
											<input type="text" value="{{old('passport_no')}}" name="passport_no" class="form-control form-control-lg text-4">
										</div>
									</div>

									<div class="row">
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Date of Birth</label>
											<input type="date" value="{{old('dob')}}" name="dob" class="form-control form-control-lg text-4">
										</div>
										<div class="form-group col-6">
											<p class="form-label text-color-dark text-3">Gender</p>
											<div class="form-check form-check-inline">
												<label class="form-check-label">
													<input class="form-check-input" type="radio" name="gender" data-msg-required="Please select at least one option." id="inlineRadio1" value="1"> Male
												</label>
											</div>
											<div class="form-check form-check-inline">
												<label class="form-check-label">
													<input class="form-check-input" type="radio" name="gender" data-msg-required="Please select at least one option." id="inlineRadio2" value="2"> Female
												</label>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group col-12">
											<label class="form-label text-color-dark text-3">Solve The Problem <span class="text-color-danger">*</span>:</label> <span style="margin-left: 5px; font-size: 1.4em; font-weight: 600; line-height: 27px; color: #212529">{!!getCaptchaQuestion()!!}</span>
											<input name="_answer" type="number" class="form-control form-control-lg text-4">
										</div>
									</div>

									<div class="row">
										<div class="form-group col-12">
											<p class="text-3 mt-3" style="margin-bottom: 0;"><input type="checkbox" class="form-check-input" id="checkbox" style="margin-right: 8px" data-msg-required="Please accept terms and conditions." required name="agree"> Creating an account means you are accepting our <a href="#">Terms and Services</a> and <a href="#">Privacy Policy</a>.</p>
											{{-- <span id="errorContent" class="text-2 text-danger hidden">Please accept our terms and conditions !!!</span> --}}
										</div>
									</div>

									<div class="row mt-4">
										<div class="form-group col">
											<button type="submit" class="btn btn-primary btn-modern w-100 text-uppercase rounded-0 font-weight-bold text-3 py-3" data-loading-text="Loading...">Submit</button>
										</div>
									</div>
								</form>
							</div>
						</div>
	
					</div>
				</section>

			</div>

@endsection