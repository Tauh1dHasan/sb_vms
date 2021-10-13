@extends('backend.layouts.master')

    @section('content')
        
    <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-md-12">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: none; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.receptionist.index') }}">Manage Receptionists</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>Edit Receptionist Info</span></li>
                        </ol>
                    </nav>
                    
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="widget widget-card-four" style="padding-left: 0"> 
                                <div class="w-header">
                                    <div class="w-info">
                                        <h6 class="value">Edit Receptionist Info</h6>
                                    </div>
                                </div>
                            </div>
                            @include('backend.partials.message')
                            <form class="" action="{{ route('admin.receptionist.update', $employee->employee_id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                
                                <input type="hidden" name="user_type_id" id="user_type_id" value="3">
                                <input type="hidden" name="old_photo" id="" value="{{ $employee->photo }}">

                                <div class="row"> 

                                    @if ($employee->photo)
                                    <div class="input-group mb-4 offset-md-4 col-md-6" style="padding-left: 20px;">
                                        <img src="{{ asset('backend/img/employees/' . $employee->photo)}}" alt="Profile Photo" style="max-height: 200px;">
                                    </div>
                                    @endif
                                    
                                    <div class="input-group mb-4 col-md-10" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Update Profile Photo</span>
                                        </div>
                                        <input class="form-control form-control-lg" name="photo" type="file" id="photo">
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">First Name</span>
                                        </div>
                                        <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" aria-label="First Name" value="{{ $employee->first_name }}" required>
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Last Name</span>
                                        </div>
                                        <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" aria-label="Last Name" value="{{ $employee->last_name }}" required>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Employee ID</span>
                                        </div>
                                        <input type="text" name="eid_no" class="form-control" placeholder="Enter Employee ID" aria-label="Employee ID" value="{{ $employee->eid_no }}" required>
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Date of Birth</span>
                                        </div>
                                        <input type="date" name="dob" class="form-control" placeholder="Enter Date of Birth" aria-label="Date of Birth" value="{{ $employee->dob }}" required>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Department Name</span>
                                        </div>

                                        <select class="form-control" name="dept_id" id="dept_id" required="">
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->dept_id }}" @if($department->dept_id == $employee->dept_id ? 'selected' : '') @endif>{{ $department->department_name }}</option>    
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Designations</span>
                                        </div>

                                        <select class="form-control" name="designation_id" id="designation_id" required="">
                                            <option value="{{ $employee->designation->designation_id }}">{{ $employee->designation->designation }}</option> 
                                        </select>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Mobile No.</span>
                                        </div>
                                        <input type="text" name="mobile_no" class="form-control" placeholder="Enter Mobile No." aria-label="Mobile No." value="{{ $employee->mobile_no }}" required>
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Email</span>
                                        </div>
                                        <input type="email" name="email" value="{{ $employee->email }}" class="form-control" placeholder="Enter Email" aria-label="Email" required>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Work Start Hour</span>
                                        </div>
                                        <input type="time" value="{{ $employee->start_hour }}" name="start_hour" class="form-control" placeholder="Enter Work Start Hour" aria-label="Work Start Hour" required>
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Work End Hour</span>
                                        </div>
                                        <input type="time" value="{{ $employee->end_hour }}" name="end_hour" class="form-control" placeholder="Enter Work End Hour" aria-label="Work End Hour" required>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Building</span>
                                        </div>

                                        <select class="form-control" name="building_no" id="building_no">
                                            <option value="{{ $employee->building_no }}">{{ $employee->building_no }}</option>  
                                            <option value="East Building">East Building</option>
                                            <option value="West Building">West Building</option>
                                            <option value="North Building">North Building</option>
                                            <option value="South Building">South Building</option>
                                        </select>
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Gate No.</span>
                                        </div>

                                        <select class="form-control" name="gate_no" id="gate_no">
                                            <option value="{{ $employee->gate_no }}">{{ $employee->gate_no }}</option>
                                            <option value="Gate 1">Gate 1</option>
                                            <option value="Gate 2">Gate 2</option>
                                            <option value="Gate 3">Gate 3</option>
                                            <option value="Gate 4">Gate 4</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Floor No</span>
                                        </div>

                                        <select class="form-control" name="floor_no" id="floor_no">
                                            <option value="{{ $employee->floor_no }}">{{ $employee->floor_no }}</option> 
                                            <option value="1st Floor">1st Floor</option>
                                            <option value="2nd Floor">2nd Floor</option>
                                            <option value="3rd Floor">3rd Floor</option>
                                            <option value="4th Floor">4th Floor</option>
                                        </select>
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Elevator No.</span>
                                        </div>

                                        <select class="form-control" name="elevator_no" id="elevator_no">
                                            <option value="{{ $employee->elevator_no }}">{{ $employee->elevator_no }}</option> 
                                            <option value="Elevator 1">Elevator 1</option>
                                            <option value="Elevator 2">Elevator 2</option>
                                            <option value="Elevator 3">Elevator 3</option>
                                            <option value="Elevator 4">Elevator 4</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Room No</span>
                                        </div>

                                        <select class="form-control" name="room_no" id="room_no">
                                            <option value="{{ $employee->room_no }}">{{ $employee->room_no }}</option>
                                            <option value="Room 1">Room 1</option>
                                            <option value="Room 2">Room 2</option>
                                            <option value="Room 3">Room 3</option>
                                            <option value="Room 4">Room 4</option>
                                        </select>
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Gender</span>
                                        </div>

                                        <div class="form-control"> 
                                            @if ($employee->gender == 1)
                                            <label class="new-control new-radio radio-classic-success">
                                                <input type="radio" class="new-control-input" name="gender" value="1" checked>
                                                <span class="new-control-indicator"></span>Male
                                            </label>
    
                                            <label class="new-control new-radio radio-classic-success">
                                                <input type="radio" class="new-control-input" name="gender" value="2">
                                                <span class="new-control-indicator"></span>Female
                                            </label>
                                            @elseif ($employee->gender == 2)
                                            <label class="new-control new-radio radio-classic-success">
                                                <input type="radio" class="new-control-input" name="gender" value="1">
                                                <span class="new-control-indicator"></span>Male
                                            </label>
    
                                            <label class="new-control new-radio radio-classic-success">
                                                <input type="radio" class="new-control-input" name="gender" value="2" checked>
                                                <span class="new-control-indicator"></span>Female
                                            </label>
                                            @else
                                            <label class="new-control new-radio radio-classic-success">
                                                <input type="radio" class="new-control-input" name="gender" value="1">
                                                <span class="new-control-indicator"></span>Male
                                            </label>
    
                                            <label class="new-control new-radio radio-classic-success">
                                                <input type="radio" class="new-control-input" name="gender" value="2">
                                                <span class="new-control-indicator"></span>Female
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">NID</span>
                                        </div>
                                        <input type="text" value="{{ $employee->nid_no }}" name="nid_no" class="form-control form-control-lg" placeholder="Enter NID" aria-label="NID">
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Passport</span>
                                        </div>
                                        <input type="text" value="{{ $employee->passport_no }}" name="passport_no" class="form-control form-control-lg" placeholder="Enter Passport ID" aria-label="Passport ID">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Driving License</span>
                                        </div>
                                        <input type="text" value="{{ $employee->driving_license_no }}" name="driving_license_no" class="form-control form-control-lg" placeholder="Enter Driving License" aria-label="Driving License">
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0; height: 45px">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Availability</span>
                                        </div>

                                        <select class="form-control" name="availability" id="availability">
                                            @if ($employee->availability == 1)
                                                <option value="1" selected>Available</option> 
                                                <option value="0">Absent</option>
                                            @elseif ($employee->availability == 0)
                                                <option value="1">Available</option> 
                                                <option value="0" selected>Absent</option> 
                                            @else
                                                <option value="1">Available</option> 
                                                <option value="0">Absent</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0; height: 45px">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Status</span>
                                        </div>

                                        <select class="form-control" name="status" id="status">
                                            @if ($employee->status == 0)
                                                <option value="0" selected>Pending</option> 
                                                <option value="1">Approved</option>
                                                <option value="2">Declined</option>
                                                <option value="3">Deleted</option>
                                            @elseif ($employee->status == 1)
                                                <option value="0">Pending</option> 
                                                <option value="1" selected>Approved</option>
                                                <option value="2">Declined</option>
                                                <option value="3">Deleted</option> 
                                            @elseif ($employee->status == 2)
                                                <option value="0">Pending</option> 
                                                <option value="1">Approved</option>
                                                <option value="2" selected>Declined</option>
                                                <option value="3">Deleted</option>
                                            @elseif ($employee->status == 3)
                                                <option value="0">Pending</option> 
                                                <option value="1">Approved</option>
                                                <option value="2">Declined</option>
                                                <option value="3" selected>Deleted</option>
                                            @else
                                                <option value="0">Pending</option> 
                                                <option value="1">Approved</option>
                                                <option value="2">Declined</option>
                                                <option value="3">Deleted</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="input-group mb-4 col-md-5" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Address</span>
                                        </div>
                                        <textarea type="text" row="3" name="address" class="form-control form-control-lg">{{ $employee->address }}</textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-2">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection