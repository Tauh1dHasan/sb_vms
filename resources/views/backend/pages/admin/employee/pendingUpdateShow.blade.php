@extends('backend.layouts.master')

    @section('content')
        
        <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: none; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.employee.index') }}">Manage Hosts</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>{{ $employee->first_name }} {{ $employee->last_name }}</span></li>
                        </ol>
                    </nav>
                    
                    <div class="offset-lg-3 col-lg-6">
                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">

                                <div class="d-flex justify-content-between">
                                    <h3 class="">Profile Update Request Details</h3>
                                </div>

                                <div class="user-info-list">
                                    <div class="">
                                        <ul class="contacts-block list-unstyled card-header" style="max-width: 100%; margin: 35px auto;">
                                            
                                            @if($employee->photo)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <div class="col-lg-12 text-center" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400"><img src="{{ asset('backend/img/employees/' . $employee->photo) }}" alt=""></label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                            
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Full Name: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->first_name }} {{ $employee->last_name }} </label>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">EID: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->eid_no }} </label>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Department: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->department->department_name }} </label>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Designation: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->designation->designation }} </label>
                                                    </div>
                                                </div>
                                            </li>

                                            @if($employee->gender)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Gender: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="gender" class="col-form-label" style="font-size: 1.25rem;">
                                                            @if($employee->gender == 1)
                                                                <span style="font-weight: 400">Male</span>
                                                            @elseif($employee->gender == 2)
                                                                <span style="font-weight: 400">Female</span>
                                                            @else
                                                                <span style="font-weight: 400">Not Given</span>
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            @if($employee->dob)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Date of Birth: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="dob" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ date('d M, Y', strtotime($employee->dob)) }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Email: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->email }} </label>
                                                    </div>
                                                </div>
                                            </li>

                                            @if($employee->address)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Address: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->address }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Mobile No: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->mobile_no }} </label>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Start Hour: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ date('h:i a', strtotime($employee->start_hour)) }} </label>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">End Hour: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ date('h:i a', strtotime($employee->end_hour)) }}</label>
                                                    </div>
                                                </div>
                                            </li>

                                            @if($employee->nid_no)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">NID: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->nid_no }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            @if($employee->passport_no)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Passport ID: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->passport_no }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            @if($employee->driving_license_no)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Driving License: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->driving_license_no }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            @if($employee->building_no)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Building: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->building_no }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            @if($employee->gate_no)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Gate No: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->gate_no }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            @if($employee->floor_no)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Floor No: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->floor_no }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            @if($employee->elevator_no)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Elevator No: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->elevator_no }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            @if($employee->room_no)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Room No: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->room_no }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            @if($employee->availability)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Availability: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $employee->availability }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection