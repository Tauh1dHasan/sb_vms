@extends('backend.layouts.master')

    @section('content')
        
    <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: none; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.visitorType.index') }}">Visitor Types</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>Edit Visitor Type</span></li>
                        </ol>
                    </nav>

                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="widget widget-card-four" style="padding-left: 0"> 
                                <div class="w-header">
                                    <div class="w-info">
                                        <h6 class="value">Edit Visitor Type</h6>
                                    </div>
                                </div>
                            </div>

                            <form class="" action="{{ route('admin.visitorType.update', $visitor_type->visitor_type_id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                
                                <div class="input-group mb-4 col-md-6" style="padding-left: 0;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Visitor Type</span>
                                    </div>
                                    <input type="text" name="visitor_type" class="form-control" value="{{ $visitor_type->visitor_type }}" placeholder="Enter Visitor Type" aria-label="Visitor Type" required>
                                </div>

                                <div class="input-group mb-4 col-md-6" style="padding-left: 0;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Visitor Type Status</span>
                                    </div>
                                    <select class="form-control" name="visitor_type_status" required>
                                        @if($visitor_type->visitor_type_status == 1)
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