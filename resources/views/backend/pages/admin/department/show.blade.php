@extends('backend.layouts.master')

    @section('content')
        
    <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: none; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.department.index') }}">Departments</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>{{ $department->department_name }}</span></li>
                        </ol>
                    </nav>
                    <div class="offset-lg-3 col-lg-6">
                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">

                                <div class="d-flex justify-content-between">
                                    <h3 class="">{{ $department->department_name }} Department Details</h3>
                                    <a href="{{ route('admin.department.edit', $department->dept_id) }}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                                </div>
                                <div class="user-info-list">
                
                                    <div class="">
                                        <ul class="contacts-block list-unstyled card-header" style="max-width: 100%; margin: 35px auto;">
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="department_name" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Department Name: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="department_name" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ $department->department_name }} </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="status" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Department Status: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="status" class="col-form-label" style="font-size: 1.25rem;">
                                                            @if($department->status == 1)
                                                                <span style="font-weight: 400">Active</span>
                                                            @else
                                                                <span style="font-weight: 400">Deactivated</span>
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="contacts-block__item" style="margin: 5px 0;">
                                                <div class="form-group row mb-4">
                                                    <label for="entry_datetime" class="col-lg-4 col-form-label text-right"><span style="font-weight: 800; font-size: 1.25rem; color: #3b3f5c;">Created Date: </span></label>
                                                    <div class="col-lg-8" style="padding-left: 0">
                                                        <label for="entry_datetime" class="col-form-label" style="font-size: 1.25rem; font-weight: 400">{{ date('d M, Y', strtotime($department->entry_datetime)) }} </label>
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