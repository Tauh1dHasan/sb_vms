@extends('backend.layouts.master')

    @section('content')
        
    <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: none; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.appointment.index') }}">Manage Appointments</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>Today's Appointments</span></li>
                        </ol>
                    </nav>

                    <div class="statbox widget box box-shadow">

                        <div class="widget-content widget-content-area">
                            <div class="widget widget-card-four" style="padding-left: 0"> 
                                <div class="w-header">
                                    <div class="w-info">
                                        <h6 class="value">Today's Appointments</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive mb-4">
                                @include('backend.partials.message')
                                <table id="style-3" class="table style-3 table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Meeting ID</th>
                                            <th class="text-center">Visitor Name</th>
                                            <th class="text-center">Host Name</th>
                                            <th class="text-center">Meeting Purpose</th>
                                            <th class="text-center">Meeting Datetime</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($meetings as $meeting)
                                            <tr>
                                                <td class="text-center"> {{ $meeting->meeting_id }}</td>
                                                <td class="text-center"> {{ $meeting->vfname }} {{ $meeting->vlname }}</td>
                                                <td class="text-center"> {{ $meeting->efname }} {{ $meeting->elname }}</td>
                                                <td class="text-center"> {{ $meeting->purpose_name }}</td>
                                                <td class="text-center"> {{ date('d M, Y', strtotime($meeting->meeting_datetime)) }} at {{ date('h:i a', strtotime($meeting->meeting_datetime)) }}</td>
                                                <td class="text-center"> 
                                                    @if($meeting->meeting_status == 0)
                                                        <span class="inv-status badge badge-primary">Pending</span>
                                                    @elseif($meeting->meeting_status == 1)
                                                        <span class="inv-status badge badge-success">Approved</span>
                                                    @elseif($meeting->meeting_status == 2)
                                                        <span class="inv-status badge badge-danger">Declined</span>
                                                    @elseif($meeting->meeting_status == 3)
                                                        <span class="inv-status badge badge-info">Rescheduled</span>
                                                    @elseif($meeting->meeting_status == 4)
                                                        <span class="inv-status badge badge-danger">Canceled</span>
                                                    @elseif($meeting->meeting_status == 11)
                                                        <span class="inv-status badge badge-secondary">On Going</span>
                                                    @elseif($meeting->meeting_status == 12)
                                                        <span class="inv-status badge badge-dark">Meeting End</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2" style="will-change: transform; margin-top: 50px; margin-right: 20px;">

                                                            @if ($meeting->meeting_status == 0)
                                                                <a class="dropdown-item action-view text-center" href="{{ route('admin.approve.appointment', $meeting->meeting_id) }}">
                                                                    <span class="inv-status text-success">Approve</span>
                                                                </a>
                                                                <a class="dropdown-item action-view text-center" href="{{ route('admin.decline.appointment', $meeting->meeting_id) }}">
                                                                    <span class="inv-status text-danger">Decline</span>
                                                                </a>
                                                                <a class="dropdown-item action-view text-center">
                                                                    <button type="button" class="inv-status text-info" style="background: none;  border: none;" data-toggle="modal" data-target="#modalReschedule{{ $meeting->meeting_id }}">Reschedule</button>
                                                                </a>

                                                            @elseif ($meeting->meeting_status == 1)
                                                                <a class="dropdown-item action-view text-center" href="{{ route('admin.decline.appointment', $meeting->meeting_id) }}">
                                                                    <span class="inv-status text-danger">Decline</span>
                                                                </a>
                                                                <a class="dropdown-item action-view text-center">
                                                                    <button type="button" class="inv-status text-info" style="background: none;  border: none;" data-toggle="modal" data-target="#modalReschedule{{ $meeting->meeting_id }}">Reschedule</button>
                                                                </a>

                                                            @elseif ($meeting->meeting_status == 2)
                                                                <a class="dropdown-item action-view text-center" href="{{ route('admin.approve.appointment', $meeting->meeting_id) }}">
                                                                    <span class="inv-status text-success">Approve</span>
                                                                </a>
                                                                <a class="dropdown-item action-view text-center">
                                                                    <button type="button" class="inv-status text-info" style="background: none;  border: none;" data-toggle="modal" data-target="#modalReschedule{{ $meeting->meeting_id }}">Reschedule</button>
                                                                </a>

                                                            @elseif ($meeting->meeting_status == 3)
                                                                <a class="dropdown-item action-view text-center" href="{{ route('admin.decline.appointment', $meeting->meeting_id) }}">
                                                                    <span class="inv-status text-danger">Decline</span>
                                                                </a>

                                                            @elseif ($meeting->meeting_status == 4)
                                                                <a class="dropdown-item action-view text-center" href="#">
                                                                    <span class="inv-status text-danger">Meeting is canceled</span>
                                                                </a>

                                                            @elseif ($meeting->meeting_status == 11)
                                                                <a class="dropdown-item action-view text-center" href="#">
                                                                    <span class="inv-status text-danger">Meeting is ongoing</span>
                                                                </a>

                                                            @endif

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>


                                            {{-- reschedule modal --}}
                                            <div class="modal fade" id="modalReschedule{{ $meeting->meeting_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin.reschedule.appointment', $meeting->meeting_id)}}" method="post">
                                                                @csrf
                                                                @method('patch')

                                                                <div class="form-group">
                                                                    <label for="message-text" class="col-form-label">New Datetime: </label>
                                                                    <input id="meeting_datetime" name="meeting_datetime" class="form-control">
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <input type="submit" value="Submit" class="text-warning btn btn-primary">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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