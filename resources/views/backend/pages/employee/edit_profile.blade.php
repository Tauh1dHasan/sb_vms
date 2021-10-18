@extends('backend.layouts.master')

    @section('content')

        <nav class="breadcrumb-one" aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('employee.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                <li class="breadcrumb-item"><a href="{{ route('employee.profile') }}">Profile</a></li>
                <li class="breadcrumb-item"><a href="{{ route('employee.editProfile', $employee->user_id) }}">Edit Profile</a></li>
            </ol>
        </nav>

        <div class="admin-data-content layout-top-spacing">
            <div class="row">
                
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    
                    <div class="row layout-spacing">

                        <!-- Content -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 layout-top-spacing offset-md-3 offset-xl-3 offset-lg-3">
                    
                            <div class="user-profile layout-spacing">
                                <div class="widget-content widget-content-area" style="padding: 40px">
                                    <div class="col-lg-12 col-12 layout-spacing">
                                        <div class="statbox widget box box-shadow">

                                            @include('backend.partials.message')
                                            
                                            <div class="widget-header">                                
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                        <h4>Update profile information</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content widget-content-area">
                                                <form action="{{ route('employee.updateProfile') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="user_type_id" id="user_type_id" value="{{ $employee->user_type_id }}">
                                                    
                                                    <div class="form-group mb-4">
                                                        <label for="new_photo">Update Profile Picture</label>
                                                        <input name="new_photo" type="file" class="form-control" id="new_photo">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="first_name">First Name</label>
                                                        <input name="first_name" type="text" class="form-control" id="first_name" value="{{ $employee->first_name }}" required>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="last_name">Last Name</label>
                                                        <input name="last_name" type="text" class="form-control" id="last_name" value="{{ $employee->last_name }}" required>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="dept_id">Department</label>
                                                        <select name="dept_id" class="form-control" id="dept_id" required>
                                                            @foreach ($departments as $department)
                                                                <option value="{{ $department->dept_id }}" @if($department->dept_id == $employee->dept_id ? 'selected' : '') @endif>{{ $department->department_name }}</option>    
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="designation_id">Designation</label>
                                                        <select class="form-control" name="designation_id" id="designation_id" required>
                                                            <option value="{{ $employee->designation_id }}">{{ $employee->designation }}</option> 
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="dob">Date of Birth</label>
                                                        <input name="dob" type="date" class="form-control" id="dob" value="{{ $employee->dob }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="gender">Gender</label>
                                                        <select name="gender" class="form-control" id="gender">
                                                            @if ($employee->gender == 1)
                                                                <option value="1">Male</option>
                                                                <option value="2">Female</option>
                                                            @elseif ($employee->gender == 2)
                                                                <option value="2">Female</option>
                                                                <option value="1">Male</option>
                                                            @else
                                                                <option value="">Select</option>
                                                                <option value="1">Male</option>
                                                                <option value="2">Female</option>
                                                            @endif
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="start_hour">Starting Office Hour</label>
                                                        <input name="start_hour" type="time" class="form-control" id="start_hour" value="{{ $employee->start_hour }}" required>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="end_hour">Ending Office Hour</label>
                                                        <input name="end_hour" type="time" class="form-control" id="end_hour" value="{{ $employee->end_hour }}" required>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="building_no">Building</label>
                                                        <input name="building_no" type="text" class="form-control" id="building_no" value="{{ $employee->building_no }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="gate_no">Gate</label>
                                                        <input name="gate_no" type="text" class="form-control" id="gate_no" value="{{ $employee->gate_no }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="floor_no">Floor No</label>
                                                        <input name="floor_no" type="text" class="form-control" id="floor_no" value="{{ $employee->floor_no }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="elevator_no">Elevator</label>
                                                        <input name="elevator_no" type="text" class="form-control" id="elevator_no" value="{{ $employee->elevator_no }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="room_no">Room No</label>
                                                        <input name="room_no" type="text" class="form-control" id="room_no" value="{{ $employee->room_no }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="email">Email address</label>
                                                        <input name="email" type="email" class="form-control" id="email" value="{{ $employee->email }}" required>
                                                    </div>
                                                    
                                                    <div class="form-group mb-4">
                                                        <label for="address">Current Address</label>
                                                        <textarea name="address" class="form-control" id="address" rows="3">{{ $employee->address }}</textarea>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="mobile_no">Mobile Number</label>
                                                        <input name="mobile_no" type="number" class="form-control" id="mobile_no" value="{{ $employee->mobile_no }}" required>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="nid_no">NID Number</label>
                                                        <input name="nid_no" type="number" class="form-control" id="nid_no" value="{{ $employee->nid_no }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="passport_no">Passport Number</label>
                                                        <input name="passport_no" type="number" class="form-control" id="passport_no" value="{{ $employee->passport_no }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="driving_license_no">Driving License Number</label>
                                                        <input name="driving_license_no" type="number" class="form-control" id="driving_license_no" value="{{ $employee->driving_license_no }}">
                                                    </div>

                                                    {{-- hidden data --}}
                                                    <input type="hidden" name="employee_id" value="{{ $employee->employee_id }}">
                                                    <input type="submit" name="submit" class="mt-4 mb-4 btn btn-primary">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                        </div>
                    
                    </div>
                </div>

                
            </div>
        </div>
        @endsection