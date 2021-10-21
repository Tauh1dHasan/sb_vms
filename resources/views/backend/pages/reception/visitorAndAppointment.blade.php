@extends('backend.layouts.master')

    @section('content')
        
    <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-md-12"> 
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: none; padding: 0;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('reception.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><span>New Visitor & Appointment</span></li>
                        </ol>
                    </nav>
                    
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="widget widget-card-four" style="padding-left: 0"> 
                                <div class="w-header">
                                    <div class="w-info">
                                        <h6 class="value">Add New Visitor & Appointment</h6>
                                    </div>
                                </div>
                            </div>
                            @include('backend.partials.message')

                            <form action="{{route('reception.visitorAndAppointmentStore')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">First Name <span style="color:red; padding-left:5px;">*</span></span>
                                        </div>
                                        <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" aria-label="First Name" value="{{ old('first_name') }}" required>
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Last Name <span style="color:red; padding-left:5px;">*</span></span>
                                        </div>
                                        <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" aria-label="Last Name" value="{{ old('last_name') }}" required>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend" style="height: 46px">
                                            <span class="input-group-text" id="basic-addon5">Visitor Type <span style="color:red; padding-left:5px;">*</span></span>
                                        </div>

                                        <select class="form-control" name="visitor_type" id="visitor_type" required>
                                            <option value="">--Select Visitor Type--</option>
                                            @foreach ($visitorTypes as $visitorType)
                                                <option value="{{$visitorType->visitor_type_id}}">{{$visitorType->visitor_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Profile Photo</span>
                                        </div>
                                        <input class="form-control form-control-lg" name="profile_photo" type="file" id="profile_photo">
                                    </div>

                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Organization Name <span style="color:red; padding-left:5px;">*</span></span>
                                        </div>
                                        <input type="text" name="organization" class="form-control" placeholder="Enter Organization Name" value="{{ old('organization') }}" required>
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Designation <span style="color:red; padding-left:5px;">*</span></span>
                                        </div>
                                        <input type="text" name="designation" class="form-control" placeholder="Enter Designation" value="{{ old('designation') }}" required>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Mobile No. <span style="color:red; padding-left:5px;">*</span></span>
                                        </div>
                                        <input type="text" name="mobile_no" class="form-control" placeholder="Enter Mobile No." aria-label="Mobile No." value="{{ old('mobile_no') }}" required>
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Email <span style="color:red; padding-left:5px;">*</span></span>
                                        </div>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter Email" aria-label="Email" required>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Password <span style="color:red; padding-left:5px;">*</span></span>
                                        </div>
                                        <input type="password" name="password" class="form-control" placeholder="at least 1 uppercase, 1 lowercase and 1 number" aria-label="Password" required>
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Confirm Password <span style="color:red; padding-left:5px;">*</span></span>
                                        </div>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Your Password" aria-label="Confirm Password" required>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Address</span>
                                        </div>
                                        <textarea type="text" row="1" name="address" class="form-control form-control-lg">{{ old('address') }}</textarea>
                                    </div>
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5" style="height: 51px;">NID</span>
                                        </div>
                                        <input type="text" value="{{ old('nid_no') }}" name="nid_no" class="form-control form-control-lg" placeholder="Enter NID" aria-label="NID">
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Passport</span>
                                        </div>
                                        <input type="text" value="{{ old('passport_no') }}" name="passport_no" class="form-control form-control-lg" placeholder="Enter Passport ID" aria-label="Passport ID">
                                    </div>
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Driving License</span>
                                        </div>
                                        <input type="text" value="{{ old('driving_license_no') }}" name="driving_license_no" class="form-control form-control-lg" placeholder="Enter Driving License" aria-label="Driving License">
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Date of Birth</span>
                                        </div>
                                        <input type="date" name="dob" class="form-control" placeholder="Enter Date of Birth" aria-label="Date of Birth" value="{{ old('dob') }}">
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Gender</span>
                                        </div>

                                        <div class="form-control"> 
                                            <label class="new-control new-radio radio-classic-success">
                                                <input type="radio" class="new-control-input" name="gender" value="1">
                                                <span class="new-control-indicator"></span>Male
                                            </label>

                                            <label class="new-control new-radio radio-classic-success">
                                                <input type="radio" class="new-control-input" name="gender" value="2">
                                                <span class="new-control-indicator"></span>Female
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend" style="height: 45px;">
                                            <span class="input-group-text" id="basic-addon5">Host Name <span style="color:red; padding-left:5px;">*</span></span>
                                        </div>
                                        <select class="form-control" name="employee_id" id="employee_id" style="width: 68% !important" required></select>
                                    </div>
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend" style="height: 45px;">
                                            <span class="input-group-text" id="basic-addon5">Select Meeting Purpose <span style="color:red; padding-left:5px;">*</span></span>
                                        </div>
                                        <select name="meeting_purpose_id" class="form-control" id="meeting_purpose_id" required>
                                            <option value="">--Select Meeting Purpose--</option>
                                            @foreach ($purposes as $item)
                                                <option value="{{ $item->purpose_id }}">{{ $item->purpose_name }}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Describe Purpose</span>
                                        </div>
                                        <textarea name="meeting_purpose_describe" class="form-control" id="meeting_purpose_describe"></textarea>
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5" style="height: 46px;">Meeting Datetime <span style="color:red; padding-left:5px;">*</span></span>
                                        </div>
                                        <input id="meeting_datetime" name="meeting_datetime" class="form-control" placeholder="Select Datetime" autocomplete="off" required>
                                    </div>

                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Number of Attendees <span style="color:red; padding-left:5px;">*</span></span>
                                        </div>
                                        <input type="number" value="{{ old('attendees_no') }}" name="attendees_no" class="form-control form-control-lg" placeholder="Total number of attendees" aria-label="attendees_no" required>
                                    </div>
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5" style="height: 46px;">Do you have a vehicle ? <span style="color:red; padding-left:3px;">*</span></span>
                                        </div>
                                        <select name="has_vehicle" class="form-control" id="has_vehicle" required>
                                            <option value="">Select an Option</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection