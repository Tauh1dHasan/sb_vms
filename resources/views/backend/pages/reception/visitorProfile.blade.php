@extends('backend.layouts.master')

    @section('content')

        <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: none; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('reception.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('reception.visitorList') }}">Visitor List</a></li>
                            <li class="breadcrumb-item"><a href="#">{{$visitor->first_name}} {{$visitor->last_name}}</a></li>
                        </ol>
                    </nav>
                    <div class="offset-lg-3 col-lg-6">
                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">

                                <div class="d-flex justify-content-between">
                                    <h3 class="">{{ $visitor->first_name }} {{ $visitor->last_name }} Info</h3>
                                    <a href="{{ route('visitor.editProfile', $visitor->user_id) }}" class="mt-2 edit-profile" style="visibility:hidden;"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
                                            <path d="M12 20h9"></path>
                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                        </svg>
                                    </a>
                                </div>

                                <div class="user-info-list">
                                    <div class="">
                                        <ul class="contacts-block list-unstyled card-header" style="max-width: 100%; margin: 35px auto;">
                                            @if($visitor->profile_photo)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <div class="col-lg-12 text-center" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">
                                                            <img style="max-width: 400px" src="{{ asset('backend/img/visitors/' . $visitor->profile_photo) }}" alt="{{$visitor->first_name}} {{$visitor->last_name}}">
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                            
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Full Name: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $visitor->first_name }} {{ $visitor->last_name }} </label>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Visitor ID: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $visitor->visitor_id }} </label>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Visitor Type: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $visitor->visitor_type }} </label>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Organization: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $visitor->organization }} </label>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Designation: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $visitor->designation }} </label>
                                                    </div>
                                                </div>
                                            </li>

                                            @if($visitor->gender)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Gender: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="gender" class="col-form-label" style="font-size: 1.25rem;">
                                                            @if($visitor->gender == 1)
                                                                <span style="font-weight: 400">Male</span>
                                                            @elseif($visitor->gender == 2)
                                                                <span style="font-weight: 400">Female</span>
                                                            @else
                                                                <span style="font-weight: 400">Not Given</span>
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            @if($visitor->dob)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Date of Birth: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="dob" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ date('d M, Y', strtotime($visitor->dob)) }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Email: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $visitor->email }} </label>
                                                    </div>
                                                </div>
                                            </li>

                                            @if($visitor->address)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Address: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $visitor->address }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Mobile No: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $visitor->mobile_no }} </label>
                                                    </div>
                                                </div>
                                            </li>

                                            @if($visitor->nid_no)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">NID: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $visitor->nid_no }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            @if($visitor->passport_no)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Passport ID: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $visitor->passport_no }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            @if($visitor->driving_license_no)
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Driving License: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $visitor->driving_license_no }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="employee_status" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Visitor Status: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="employee_status" class="col-form-label" style="font-size: 1.25rem;">
                                                            @if($visitor->visitor_status == 1)
                                                                <span style="font-weight: 400">Approved</span>
                                                            @else
                                                                <span style="font-weight: 400">Declined</span>
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="entry_datetime" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Register Date: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="entry_datetime" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ date('d M, Y', strtotime($visitor->entry_datetime)) }} </label>
                                                    </div>
                                                </div>
                                            </li>
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