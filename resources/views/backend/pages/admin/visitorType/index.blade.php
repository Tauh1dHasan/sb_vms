@extends('backend.layouts.master')

    @section('content')
        
    <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="widget widget-card-four" style="padding-left: 0"> 
                                <div class="w-header">
                                    <div class="w-info">
                                        <h6 class="value">All Visitor Types</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive mb-4">
                                @include('backend.partials.message')
                                <table id="style-3" class="table style-3  table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Serial No.</th>
                                            <th class="text-center">Visitor Type</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($visitor_types as $visitor_type)
                                            <tr>
                                                <td class="text-center"> #{{ $loop->index + 1 }} </td>
                                                <td class="text-center"> {{$visitor_type->visitor_type}}</td>
                                                <td class="text-center"> 
                                                    @if($visitor_type->visitor_type_status == 1)
                                                        <span class="inv-status badge badge-success">Active</span>
                                                    @elseif($visitor_type->visitor_type_status == 0)
                                                        <span class="inv-status badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2" style="will-change: transform;">
                                                            <a class="dropdown-item action-view" href="{{ route('admin.visitorType.show', $visitor_type->visitor_type_id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>View</a>
                                                            <a class="dropdown-item action-edit" href="{{ route('admin.visitorType.edit', $visitor_type->visitor_type_id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>Edit</a>
                                                            <a class="dropdown-item action-delete" href="{{ route('admin.visitorType.destroy', $visitor_type->visitor_type_id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection