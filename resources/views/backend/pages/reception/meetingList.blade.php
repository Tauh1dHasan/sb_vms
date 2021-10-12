@extends('backend.layouts.master')

    @section('content')

        <nav class="breadcrumb-one" aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('reception.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                <li class="breadcrumb-item"><a href="{{ route('reception.meetingList') }}">Appointment List</a></li>
            </ol>
        </nav>
        
        <form action="{{route('reception.searchMeeting')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-5 col-xl-5">
                    <label for="data">Search Meeting</label>
                    <input type="text" class="form-control" name="data" id="data" placeholder="Search Meeting by Meeting ID/Visitor Name/Visitor Mobile" required>
                </div>
                
                <div class="col-md-2 col-xl-2">
                    <button type="submit" class="form-control" class="btn btn-primary" style="margin-top: 30px">Submit</button>
                </div>
            </div>
        </form>


        <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive mb-4">

                                @include('backend.partials.message')

                                <table id="style-3" class="table style-3  table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Meeting ID</th>
                                            <th class="text-center">Visitor Name</th>
                                            <th class="text-center">Visitor Mobile</th>
                                            <th class="text-center">Visitor Organization</th>
                                            {{-- <th class="text-center">Visitor Designation</th> --}}
                                            <th class="text-center">Host Name</th>
                                            {{-- <th class="text-center">Host mobile</th> --}}
                                            <th class="text-center">Meeting Purpose</th>
                                            {{-- <th class="text-center">Description</th> --}}
                                            <th class="text-center">Meeting Datetime</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($meetings as $meeting)
                                            <tr>
                                                <td class="text-center"> {{ $meeting->meeting_id }} </td>
                                                <td class="text-center"> {{ $meeting->vfname }} {{ $meeting->vlname }} </td>
                                                <td class="text-center"> {{ $meeting->vmobile }} </td>
                                                <td class="text-center"> {{ $meeting->organization }} </td>
                                                {{-- <td class="text-center"> {{ $meeting->designation }} </td> --}}
                                                <td class="text-center"> {{ $meeting->efname }} {{ $meeting->elname }}</td>
                                                {{-- <td class="text-center"> {{ $meeting->emobile }}</td> --}}
                                                <td class="text-center"> {{ $meeting->purpose_name }}</td>
                                                {{-- <td class="text-center"> {{ $meeting->purpose_describe }}</td> --}}
                                                <td class="text-center"> {{ $meeting->meeting_datetime }}</td>
                                                <td class="text-center">
                                                    @if($meeting->meeting_status == 0)
                                                        <span class="shadow-none badge badge-primary">Pending</span>
                                                    @elseif($meeting->meeting_status == 1)
                                                        <span class="shadow-none badge badge-success">Approved</span>
                                                    @elseif($meeting->meeting_status == 2)
                                                        <span class="shadow-none badge badge-danger">Declined</span>
                                                    @elseif($meeting->meeting_status == 3)
                                                        <span class="shadow-none badge badge-warning">Rescheduled</span>
                                                    @elseif($meeting->meeting_status == 4)
                                                        <span class="shadow-none badge badge-danger">Canceled</span>
                                                    @elseif($meeting->meeting_status == 11)
                                                        <span class="shadow-none badge badge-info">On Going</span>
                                                    @elseif($meeting->meeting_status == 12)
                                                        <span class="shadow-none badge badge-dark">Meeting End</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">

                                                    @if (($meeting->meeting_status == 1 || $meeting->meeting_status == 3) && ($meeting->checkin_status == 0))
                                                        <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                                                                    <circle cx="12" cy="12" r="1"></circle>
                                                                    <circle cx="19" cy="12" r="1"></circle>
                                                                    <circle cx="5" cy="12" r="1"></circle>
                                                                </svg>
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2" style="will-change: transform; margin-right: 50px;">
                                                                <a class="dropdown-item action-view" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{$meeting->meeting_id}}" onclick="meeting_func(this)">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
                                                                        <circle cx="12" cy="12" r="10"></circle>
                                                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                                                        <line x1="12" y1="16" x2="12" y2="16"></line>
                                                                    </svg>
                                                                    Check-in
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @elseif (($meeting->meeting_status == 1 || $meeting->meeting_status == 3) && ($meeting->checkin_status == 1))
                                                        <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                                                                    <circle cx="12" cy="12" r="1"></circle>
                                                                    <circle cx="19" cy="12" r="1"></circle>
                                                                    <circle cx="5" cy="12" r="1"></circle>
                                                                </svg>
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2" style="will-change: transform; margin-right: 50px;">
                                                                <a class="dropdown-item action-delete" href="{{ route('reception.checkOut', $meeting->meeting_id) }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                                    </svg>
                                                                    Check-out
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @elseif ($meeting->meeting_status != 1 || $meeting->meeting_status != 3)
                                                        <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                                                                    <circle cx="12" cy="12" r="1"></circle>
                                                                    <circle cx="19" cy="12" r="1"></circle>
                                                                    <circle cx="5" cy="12" r="1"></circle>
                                                                </svg>
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2" style="will-change: transform; margin-right: 50px;">
                                                                <a class="dropdown-item action-delete" href="#">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                                    </svg>
                                                                    Check-in not allowed
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif


                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                                {{-- Modal --}}
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 class="modal-heading mb-4 mt-2">Gate Pass Information</h4>
                                            
                                            <form action="{{route('reception.checkIn')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="meeting_id" id="gatePassMeetingID" value="">
                                                

                                                <label for="card_no">Card Number: </label>
                                                <input type="text" name="card_no" id="card_no" style="width: 70%" placeholder="Please type card number" required>
                                                
                                                <div id="camera"></div>
                                                <a onclick="take_snapshot()" style="margin-left: 38%" id="photo_button" class="btn btn-success btn-sm">Take Picture</a>

                                                <input type="hidden" name="visitor_photo" id="visitor_photo">
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                            <button class="btn btn-primary">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    
    