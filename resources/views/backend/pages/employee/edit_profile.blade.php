@extends('backend.layouts.master')

    @section('content')


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
                                            <div class="widget-header">                                
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                        <h4>Update profile information</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content widget-content-area">
                                                <form action="{{ route('employee.updateProfile') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group mb-4">
                                                        <label for="fname">First Name</label>
                                                        <input name="fname" type="text" class="form-control" id="fname" value="{{ $employee->first_name }}" required>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="lname">Last Name</label>
                                                        <input name="lname" type="text" class="form-control" id="lname" value="{{ $employee->last_name }}" required>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="availability">Availability</label>
                                                        <select name="availability" class="form-control" id="availability" required>
                                                            <option value="">Select</option>
                                                            <option value="0">Not Available</option>
                                                            <option value="1">Available</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="department">Department</label>
                                                        <select name="department" class="form-control" id="department" required>
                                                            <option value="{{ $employee->dept_id }}">{{ $employee->department_name }}</option>
                                                            @foreach ($department as $item)
                                                                <option value="{{ $item->dept_id }}">{{ $item->department_name }}</option>    
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="designation">Designation</label>
                                                        <select name="designation" class="form-control" id="designation" required>
                                                            <option value="{{ $employee->designation_id }}">{{ $employee->designation }}</option>
                                                            @foreach ($designation as $item)
                                                                <option value="{{ $item->designation_id }}">{{ $item->designation }}</option>    
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="eid">EID Number</label>
                                                        <input name="eid" type="number" class="form-control" id="eid" value="{{ $employee->eid_no }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="start_hour">Starting Office Hour</label>
                                                        <input name="start_hour" type="time" class="form-control" id="start_hour" value="{{ $employee->start_hour }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="end_hour">Ending Office Hour</label>
                                                        <input name="end_hour" type="time" class="form-control" id="end_hour" value="{{ $employee->end_hour }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="email">Email address</label>
                                                        <input name="email" type="email" class="form-control" id="email" value="{{ $employee->email }}">
                                                    </div>
                                                    
                                                    <div class="form-group mb-4">
                                                        <label for="address">Current Address</label>
                                                        <textarea name="address" class="form-control" id="address" rows="3">{{ $employee->address }}</textarea>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="mobile_no">Mobile Number</label>
                                                        <input name="mobile_no" type="number" class="form-control" id="mobile_no" value="0{{ $employee->mobile_no }}">
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
                                                    
                                                    {{-- hidden user_id --}}
                                                    <input name="user_id" type="hidden" value="{{ $employee->user_id }}">
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