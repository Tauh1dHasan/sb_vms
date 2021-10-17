@extends('backend.layouts.master')

    @section('content')
        
        <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: none; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.employee.index') }}">Manage Hosts</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>{{ $old_info->first_name }} {{ $old_info->last_name }}</span></li>
                        </ol>
                    </nav>
                    
                    <div class="layout-spacing">
                        <div class="widget-content widget-content-area">

                            <div class="justify-content-between mt-5">
                                <h3 class="">Profile Update Request Details</h3>
                            </div>

                            <div class="row mt-5">

                                <div class="col-lg-6">

                                    <div class="justify-content-between">
                                        <h5 class="mt-2" style="color: #888ea8">Previous Info</h5>
                                    </div>

                                    <div class="user-info-list">
                                        <div class="">
                                            <ul class="contacts-block list-unstyled card-header" style="max-width: 100%; margin: 35px auto;">
                                                
                                                @if($old_info->photo)
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <div class="col-lg-12 text-center" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400;"><img src="{{ asset('backend/img/employees/' . $old_info->photo) }}" alt="" style="max-height: 200px"></label>
                                                        </div>
                                                    </div>
                                                </li>
                                                @else
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <div class="col-lg-12 text-center" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400;"><img src="{{ asset('backend/assets/img/no.jpg') }}" alt="" style="max-height: 200px"></label>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endif
                                                
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Full Name: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $old_info->first_name }} {{ $old_info->last_name }} </label>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">EID: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $old_info->eid_no }} </label>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Department: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $old_info->department->department_name }} </label>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Designation: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $old_info->designation->designation }} </label>
                                                        </div>
                                                    </div>
                                                </li>

                                                
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Gender: </span></label>
                                                        @if($old_info->gender)
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="gender" class="col-form-label" style="font-size: 1.25rem;">
                                                                @if($old_info->gender == 1)
                                                                    <span style="font-weight: 400">Male</span>
                                                                @elseif($old_info->gender == 2)
                                                                    <span style="font-weight: 400">Female</span>
                                                                @else
                                                                    <span style="font-weight: 400">Not Given</span>
                                                                @endif
                                                            </label>
                                                        </div>
                                                        @else
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="gender" class="col-form-label" style="font-size: 1.25rem;">
                                                                <span style="font-weight: 400">Not Given</span>
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </li>

                                                
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Date of Birth: </span></label>
                                                        
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="dob" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ ($old_info->dob) ? date('d M, Y', strtotime($old_info->dob)) : 'Not Given' }}</label>
                                                        </div>
                                                    </div>
                                                </li>
                                                

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Email: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $old_info->email }} </label>
                                                        </div>
                                                    </div>
                                                </li>

                                                
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Address: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ ($old_info->address) ? $old_info->address : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>
                                                

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Mobile No: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $old_info->mobile_no }} </label>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Start Hour: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ date('h:i a', strtotime($old_info->start_hour)) }} </label>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">End Hour: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ date('h:i a', strtotime($old_info->end_hour)) }}</label>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">NID: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ ($old_info->nid_no) ? $old_info->nid_no : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Passport ID: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ ($old_info->passport_no) ? $old_info->passport_no : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Driving License: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ ($old_info->driving_license_no) ? $old_info->driving_license_no : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Building: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ ($old_info->building_no) ? $old_info->building_no : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Gate No: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ ($old_info->gate_no) ? $old_info->gate_no : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Floor No: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ ($old_info->floor_no) ? $old_info->floor_no : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Elevator No: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ ($old_info->elevator_no) ? $old_info->elevator_no : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Room No: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ ($old_info->room_no) ? $old_info->room_no : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Availability: </span></label>
                                                        @if($old_info->availability)
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            @if ($old_info->availability == 0)
                                                                <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">Absent </label>
                                                            @else 
                                                                <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">Available </label>
                                                            @endif
                                                        </div>
                                                        @endif
                                                    </div>
                                                </li>
                                                
                                            </ul>
                                        </div>                                    
                                    </div>
                                </div>


                                <div class="col-lg-6">

                                    <div class="justify-content-between">
                                        <h5 class="mt-2 text-danger">New Info</h5>
                                    </div>
            
                                    <div class="user-info-list">
                                        <div class="">
                                            <ul class="contacts-block list-unstyled card-header" style="max-width: 100%; margin: 35px auto;">
                                                
                                                @if($new_info->photo)
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <div class="col-lg-12 text-center" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400;"><img src="{{ asset('backend/img/employees/' . $new_info->photo) }}" alt="" style="max-height: 200px"></label>
                                                        </div>
                                                    </div>
                                                </li>
                                                @else
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <div class="col-lg-12 text-center" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400;"><img src="{{ asset('backend/assets/img/no.jpg') }}" alt="" style="max-height: 200px"></label>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endif
                                                
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Full Name: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ (($old_info->first_name != $new_info->first_name) || ($old_info->last_name != $new_info->last_name)) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ $new_info->first_name }} {{ $new_info->last_name }} </label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">EID: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $new_info->eid_no }} </label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Department: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ ($old_info->department_id != $new_info->department_id) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ $new_info->department->department_name }} </label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Designation: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ ($old_info->designation_id != $new_info->designation_id) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ $new_info->designation->designation }} </label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Gender: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            @if($new_info->gender)
                                                            <label for="gender" class="{{ ($old_info->gender != $new_info->gender) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem;">
                                                                @if($new_info->gender == 1)
                                                                    <span style="font-weight: 400">Male</span>
                                                                @elseif($new_info->gender == 2)
                                                                    <span style="font-weight: 400">Female</span>
                                                                @else
                                                                    <span style="font-weight: 400">Not Given</span>
                                                                @endif
                                                            </label>
                                                            @else
                                                            <label for="gender" class="{{ ($old_info->gender != $new_info->gender) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem;">
                                                                <span style="font-weight: 400">Not Given</span>
                                                            </label>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Date of Birth: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="dob" class="{{ ($old_info->dob != $new_info->dob) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ ($new_info->dob) ? date('d M, Y', strtotime($new_info->dob)) : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Email: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ ($old_info->email != $new_info->email) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ $new_info->email }} </label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Address: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ ($old_info->address != $new_info->address) ? 'col-form-label text-danger' : 'col-form-label'}}" style="font-size: 1.25rem; font-weight: 400">{{ ($new_info->address) ? $new_info->address : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Mobile No: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ ($old_info->mobile_no != $new_info->mobile_no) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ $new_info->mobile_no }} </label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Start Hour: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ ($old_info->start_hour != $new_info->start_hour) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ date('h:i a', strtotime($new_info->start_hour)) }} </label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">End Hour: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ ($old_info->end_hour != $new_info->end_hour) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ date('h:i a', strtotime($new_info->end_hour)) }}</label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">NID: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ ($old_info->nid_no != $new_info->nid_no) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ ($new_info->nid_no) ? $new_info->nid_no : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Passport ID: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ ($old_info->passport_no != $new_info->passport_no) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ ($new_info->passport_no) ? $new_info->passport_no : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Driving License: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ ($old_info->driving_license_no != $new_info->driving_license_no) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ ($new_info->driving_license_no) ? $new_info->driving_license_no : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Building: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ ($old_info->building_no != $new_info->building_no) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ ($new_info->building_no) ? $new_info->building_no : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Gate No: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ ($old_info->gate_no != $new_info->gate_no) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ ($new_info->gate_no) ? $new_info->gate_no : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Floor No: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ ($old_info->floor_no != $new_info->floor_no) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ ($new_info->floor_no) ? $new_info->floor_no : 'Not Given' }}</label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Elevator No: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ ($old_info->elevator_no != $new_info->elevator_no) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ ($new_info->elevator_no) ? $new_info->elevator_no : 'Not Given' }} </label>
                                                        </div>
                                                    </div>
                                                </li>
            
                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Room No: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            <label for="employee" class="{{ ($old_info->room_no != $new_info->room_no) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">{{ ($new_info->room_no) ? $new_info->room_no : 'Not Given' }}</label>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="contacts-block__item" style="margin: 5px 0;">
                                                    <div class="form-group row mb-4">
                                                        <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Availability: </span></label>
                                                        <div class="col-lg-8" style="padding-left: 0">
                                                            @if ($new_info->availability == 0)
                                                                <label for="employee" class="{{ ($old_info->availability != $new_info->availability) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">Absent </label>
                                                            @else 
                                                                <label for="employee" class="{{ ($old_info->availability != $new_info->availability) ? 'col-form-label text-danger' : 'col-form-label' }}" style="font-size: 1.25rem; font-weight: 400">Available </label>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>                                    
                                    </div>
                                </div>

                                <div class="col-lg-12"> 
                                    <div class="widget-content widget-content-area text-center split-buttons"> 
                                        <a href="{{route('admin.approve.pendingUpdate', $new_info->employee_id)}}" class="btn btn-lg btn-primary">Approve</a>
                                        <a href="{{route('admin.decline.pendingUpdate', $new_info->employee_id)}}" class="btn btn-lg btn-danger ml-4">Decline</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    @endsection