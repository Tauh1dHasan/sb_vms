@extends('backend.layouts.master')

    @section('content')
        
    <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: none; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.visitor.index') }}">Manage Visitor</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>All Visitor</span></li>
                        </ol>
                    </nav>

                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="widget widget-card-four" style="padding-left: 0"> 
                                <div class="w-header">
                                    <div class="w-info">
                                        <h6 class="value">All Visitor</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive mb-4">
                                @include('backend.partials.message')
                                <table id="style-3" class="table style-3  table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Visitor ID</th>
                                            <th class="text-center">Profile Photo </th>
                                            <th class="text-center">Visitor Name</th>
                                            <th class="text-center">Visitor Type</th>
                                            <th class="text-center">Gender</th>
                                            <th class="text-center">Organization & Designation</th>
                                            <th class="text-center">Mobile Number</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($visitors as $visitor)
                                            <tr>
                                                <td class="text-center"> {{$visitor->visitor_id}} </td>

                                                @if($visitor->profile_photo)
                                                    <td class="text-center"> <img src="{{asset('backend/img/visitors/' . $visitor->profile_photo)}}" alt="{{$visitor->first_name}} {{$visitor->last_name}}" style="max-width: 100px;"> </td>
                                                @else
                                                    <td class="text-center"> <img src="{{asset('backend/img/avatar.png')}}" alt="{{$visitor->first_name}} {{$visitor->last_name}}" style="max-width: 100px;"> </td>
                                                @endif

                                                <td class="text-center"> {{$visitor->first_name}} {{$visitor->last_name}}</td>

                                                <td class="text-center"> {{$visitor->visitor_type}}</td>

                                                <td class="text-center"> 
                                                    @if($visitor->gender == 1)
                                                        {{ 'Male' }}
                                                    @elseif($visitor->gender == 2)
                                                        {{ 'Female' }}
                                                    @else
                                                        {{ 'Not Given' }}
                                                    @endif
                                                </td>

                                                <td class="text-center"> {{$visitor->organization}} <br> Desig: {{$visitor->designation}} </td>

                                                <td class="text-center"> {{$visitor->mobile_no}} </td>
                                                
                                                <td class="text-center"> {{$visitor->email}} </td>

                                                <td class="text-center"> 
                                                    @if($visitor->visitor_status == 0)
                                                        <span class="shadow-none badge badge-primary">Pending</span>
                                                    @elseif($visitor->visitor_status == 1)
                                                        <span class="shadow-none badge badge-success">Approved</span>
                                                    @elseif($visitor->visitor_status == 2)
                                                        <span class="shadow-none badge badge-danger">Declined</span>
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2" style="will-change: transform;">
                                                            <a class="dropdown-item action-view" href="{{ route('admin.visitor.show', $visitor->visitor_id) }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>View
                                                            </a>

                                                            <a class="dropdown-item action-edit" href="#">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>Edit
                                                            </a>

                                                            <a class="dropdown-item action-delete" onclick="return confirm('Are you sure want to delete?')" href="#">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>Delete
                                                            </a>
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