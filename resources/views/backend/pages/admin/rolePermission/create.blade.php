@extends('backend.layouts.master')

    @section('content')
        
    <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: none; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.rolePermission.index') }}">Roles Permissions</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>Assign Permission to Role</span></li>
                        </ol>
                    </nav>
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="widget widget-card-four" style="padding-left: 0"> 
                                <div class="w-header">
                                    <div class="w-info">
                                        <h6 class="value">Assign Permission to Role</h6>
                                    </div>
                                </div>
                            </div>

                            <form class="" action="{{ route('admin.rolePermission.store') }}" method="post">
                                @csrf

                                <div class="input-group mb-4 col-md-6" style="padding-left: 0;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Role Name</span>
                                    </div>
                                    
                                    <select class="form-control" name="user_type_id">
                                        <option value="">---Select Role---</option>

                                        @foreach($roles as $role)
                                            <option value="{{ $role->user_type_id }}">{{ $role->user_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input-group mb-4 col-md-6" style="padding-left: 0;">

                                    @foreach($permissions as $permission)
                                    <div class="col-md-12" style="padding-left: 0;">
                                        <div class="n-chk">
                                            <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                                
                                                <input type="checkbox" name="permission_id[]" class="new-control-input" value="{{ $permission->permission_id }}">
                                                <span class="new-control-indicator"></span><span class="new-chk-content">{{ $permission->permission_title }}</span>
                                                
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection