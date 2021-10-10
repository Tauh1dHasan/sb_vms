@extends('backend.layouts.master')

    @section('content')
        
    <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-md-12"> 
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: none; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.employee.index') }}">Manage Host</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>Edit Host Password</span></li>
                        </ol>
                    </nav>
                    
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="widget widget-card-four" style="padding-left: 0"> 
                                <div class="w-header">
                                    <div class="w-info">
                                        <h6 class="value">Edit Host Password</h6>
                                    </div>
                                </div>
                            </div>
                            @include('backend.partials.message')
                            <form class="" action="{{ route('admin.employee.updatePassword', $employee->employee_id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row"> 
                                    <div class="input-group mb-4 col-md-10" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">New Password</span>
                                        </div>
                                        <input type="password" name="password" class="form-control" placeholder="at least 1 uppercase, 1 lowercase and 1 number" aria-label="Password" required>
                                    </div>

                                    <div class="input-group mb-4 col-md-10" style="padding-left: 0;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">Confirm New Password</span>
                                        </div>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Your Password" aria-label="Confirm Password" required>
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