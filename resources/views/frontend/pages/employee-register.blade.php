@extends('frontend.layouts.master')

@section('content')

			<div role="main" class="main">

				<section class="bg-color-light-scale-1" style="padding: 20px 0;">
					<div class="container py-4">
						<div class="row justify-content-center text-center" style="border-bottom: 5px solid #006F99;">
							<h1 class="font-weight-bold" style="padding-bottom: 20px; font-size: 40px;margin-bottom: 0;">Employee Registration</h1>
						</div>

						<div class="row justify-content-center" style="padding-top: 30px;">

							@include('backend.partials.message')

							<div class="col-md-12 col-lg-12 mb-5 mb-lg-0">
								<form action="{{route('frontend.employee.store')}}" id="frmSignIn" method="post" class="needs-validation" style="margin-top: 10px;" enctype="multipart/form-data">
									@csrf

									<input type="hidden" value="4" name="user_type_id" class="form-control form-control-lg text-4">

									<div class="row">
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">First Name <span class="text-color-danger">*</span></label>
											<input type="text" value="{{old('first_name')}}" name="first_name" class="form-control form-control-lg text-4" required>
										</div>
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Last Name <span class="text-color-danger">*</span></label>
											<input type="text" value="{{old('last_name')}}" name="last_name" class="form-control form-control-lg text-4" required>
										</div>
									</div>

									<div class="row">
										<div class="form-group col-md-6">
											<label class="form-label mb-1 text-2">Employee Type <span class="text-color-danger">*</span></label>
											<select data-msg-required="Please enter the employee type." class="form-control text-3 h-auto py-2" name="user_type_id" id="user_type_id" required="">
												<option value="">--Select User Type--</option> 
												@foreach($user_types as $user_type)
													<option value="{{ $user_type->user_type_id }}">{{ $user_type->user_type_name }}</option>
												@endforeach
											</select>
										</div>

                                        <div class="form-group col-md-6">
											<label class="form-label text-color-dark text-3">Employee ID <span class="text-color-danger">*</span></label>
											<input type="text" value="{{old('eid_no')}}" name="eid_no" class="form-control form-control-lg text-4" required>
										</div>
									</div>

                                    <div class="row">
										<div class="form-group col-md-6">
											<label class="form-label mb-1 text-2">Department <span class="text-color-danger">*</span></label>
											<select data-msg-required="Please enter the department." class="form-control text-3 h-auto py-2" name="dept_id" id="dept_id" required="">
												<option value="">--Select Department--</option> 
												@foreach($departments as $department)
													<option value="{{ $department->dept_id }}">{{ $department->department_name }}</option>
												@endforeach
											</select>
										</div>

                                        <div class="form-group col-md-6">
											<label class="form-label mb-1 text-2">Designation <span class="text-color-danger">*</span></label>
											<select data-msg-required="Please enter the designation." class="form-control text-3 h-auto py-2" name="designation_id" id="designation_id" required="">
												<option value="">--Select Department First--</option> 
											</select>
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
											<input type="password" value="" name="password" class="form-control form-control-lg text-4" placeholder="at least 1 uppercase, 1 lowercase and 1 number character" required>
										</div>
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Confirm Password <span class="text-color-danger">*</span></label>
											<input type="password" value="" name="password_confirmation" class="form-control form-control-lg text-4">
										</div>
									</div>

                                    <div class="row">
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Work Start Hour <span class="text-color-danger">*</span></label>
											<input type="time" value="{{old('start_hour')}}" name="start_hour" class="form-control form-control-lg text-4" required>
										</div>
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Work End hour <span class="text-color-danger">*</span></label>
											<input type="time" value="{{old('end_hour')}}" name="end_hour" class="form-control form-control-lg text-4" required>
										</div>
									</div>

									<div class="row">
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Building (Optional)</label>
											<select data-msg-required="Please enter building no." class="form-control text-3 h-auto py-2" name="building_no" id="building_no">
												<option value="">--Select Building--</option> 
												<option value="East Building">East Building</option>
												<option value="West Building">West Building</option>
												<option value="North Building">North Building</option>
												<option value="South Building">South Building</option>
											</select>
										</div>
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Gate No (Optional)</label>
											<select data-msg-required="Please enter gate no." class="form-control text-3 h-auto py-2" name="gate_no" id="gate_no">
												<option value="">--Select Gate No--</option> 
												<option value="Gate 1">Gate 1</option>
												<option value="Gate 2">Gate 2</option>
												<option value="Gate 3">Gate 3</option>
												<option value="Gate 4">Gate 4</option>
											</select>
										</div>
									</div>

									<div class="row">
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Floor No (Optional)</label>
											<select data-msg-required="Please enter floor no." class="form-control text-3 h-auto py-2" name="floor_no" id="floor_no">
												<option value="">--Select Floor No--</option> 
												<option value="1st Floor">1st Floor</option>
												<option value="2nd Floor">2nd Floor</option>
												<option value="3rd Floor">3rd Floor</option>
												<option value="4th Floor">4th Floor</option>
											</select>
										</div>
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Elevator No (Optional)</label>
											<select data-msg-required="Please enter elevator no." class="form-control text-3 h-auto py-2" name="elevator_no" id="elevator_no">
												<option value="">--Select Elevator No--</option> 
												<option value="Elevator 1">Elevator 1</option>
												<option value="Elevator 2">Elevator 2</option>
												<option value="Elevator 3">Elevator 3</option>
												<option value="Elevator 4">Elevator 4</option>
											</select>
										</div>
									</div>

									<div class="row">
										<div class="form-group col-6">
											<label class="form-label text-color-dark text-3">Room No (Optional)</label>
											<select data-msg-required="Please enter room no." class="form-control text-3 h-auto py-2" name="room_no" id="room_no">
												<option value="">--Select Room No--</option> 
												<option value="Room 1">Room 1</option>
												<option value="Room 2">Room 2</option>
												<option value="Room 3">Room 3</option>
												<option value="Room 4">Room 4</option>
											</select>
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
                                        <div class="form-group col-md-6">
											<label class="form-label text-color-dark text-3">Profile Photo</label>
											<input class="form-control d-block" name="photo" type="file" id="photo">
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