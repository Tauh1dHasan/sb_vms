@extends('backend.layouts.master')

    @section('content')
        
    <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background: none; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.visitorType.index') }}">Visitor Types</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>Add Visitor Type</span></li>
                    </ol>
                </nav>

                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="widget widget-card-four" style="padding-left: 0"> 
                                <div class="w-header">
                                    <div class="w-info">
                                        <h6 class="value">Add Visitor Type</h6>
                                    </div>
                                </div>
                            </div>

                            <form class="" action="{{ route('admin.visitorType.store') }}" method="post">
                                @csrf
                                <div class="input-group mb-4 col-md-6" style="padding-left: 0;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Visitor Type</span>
                                    </div>
                                    <input type="text" name="visitor_type" class="form-control" placeholder="Enter Visitor Type" aria-label="Visitor Type" required>
                                </div>

                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection