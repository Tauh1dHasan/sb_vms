@extends('backend.layouts.master')

    @section('content')
        
    <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: none; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.designation.index') }}">Designation</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>Edit Designation</span></li>
                        </ol>
                    </nav>

                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="widget widget-card-four" style="padding-left: 0"> 
                                <div class="w-header">
                                    <div class="w-info">
                                        <h6 class="value">Edit Designation</h6>
                                    </div>
                                </div>
                            </div>

                            <form class="" action="{{ route('admin.designation.update', $designation->designation_id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                
                                <div class="input-group mb-4 col-md-6" style="padding-left: 0;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Designation</span>
                                    </div>
                                    <input type="text" name="designation" class="form-control" value="{{ $designation->designation }}" placeholder="Enter Designation Name" aria-label="Designation Name" required>
                                </div>

                                <div class="input-group mb-4 col-md-6" style="padding-left: 0;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Designation Name</span>
                                    </div>
                                    <select class="form-control" name="dept_id" required>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->dept_id }}" {{ $designation->department->dept_id == $department->dept_id ? 'selected' : '' }}>{{ $department->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input-group mb-4 col-md-6" style="padding-left: 0;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Designation Status</span>
                                    </div>
                                    <select class="form-control" name="status" required>
                                        @if($designation->status == 1)
                                            <option value="1" selected="selected">Active</option>
                                            <option value="0">Inactive</option>
                                        @else
                                            <option value="0" selected="selected">Inactive</option>
                                            <option value="1">Active</option>
                                        @endif
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection