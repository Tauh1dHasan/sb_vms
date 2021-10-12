@extends('backend.layouts.master')

    @section('content')
        
    <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: none; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.appointment.index') }}">Manage Appointments</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>All Appointments</span></li>
                        </ol>
                    </nav>

                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="widget widget-card-four" style="padding-left: 0"> 
                                <div class="w-info">
                                    <form action="{{ route('admin.search.appointment')}}" method="get"> 
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-6 col-xl-6">
                                                <label for="visitor_id">Visitor Name</label>
                                                <select name="visitor_id" id="" class="form-control select2">
                                                    <option value="">--Select Visitor--</option> 
                                                    @foreach ($visitors as $visitor)
                                                        <option value="{{ $visitor->visitor_id }}">{{ $visitor->first_name }} {{ $visitor->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-xl-6">
                                                <label for="employee_id">Employee Name</label>
                                                <select name="employee_id" id="" class="form-control select2">
                                                    <option value="">--Select Employee--</option> 
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->employee_id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{-- <div class="col-md-4 col-xl-4">
                                                <label for="to_date">Department</label>
                                                <select name="dept_id" id="" class="form-control">
                                                    <option value="">--Select Department--</option> 
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->visitor_id }}">{{ $department->department_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div> --}}
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5 col-xl-5">
                                                <label for="from_date">From Date</label>
                                                <input type="date" class="form-control" name="from_date" id="from_date">
                                            </div>
                                            <div class="col-md-5 col-xl-5">
                                                <label for="to_date">To Date</label>
                                                <input type="date" class="form-control" name="to_date" id="to_date">
                                            </div>
                                            <div class="col-md-2 col-xl-2">
                                                <button type="submit" class="form-control btn btn-primary" style="margin-top: 30px">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content widget-content-area">
                            <div class="widget widget-card-four" style="padding-left: 0"> 
                                <div class="w-header">
                                    <div class="w-info">
                                        <h6 class="value">All Appointments</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive mb-4">
                                @include('backend.partials.message')
                                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Serial No.</th>
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
                                        @foreach($appointments as $appointment)
                                            <tr>
                                                <td class="text-center"> #{{ $loop->index + 1 }} </td>
                                                <td class="text-center"> {{ $appointment->meeting_id }}</td>
                                                <td class="text-center"> {{ $appointment->visitor->first_name }} {{ $appointment->visitor->last_name }}</td>
                                                <td class="text-center"> {{ $appointment->employee->first_name }} {{ $appointment->employee->last_name }}</td>
                                                <td class="text-center"> {{ $appointment->meeting_purpose->purpose_name }}</td>
                                                <td class="text-center"> {{ date('d M, Y', strtotime($appointment->meeting_datetime)) }} at {{ date('h:i a', strtotime($appointment->meeting_datetime)) }}</td>
                                                <td class="text-center"> 
                                                    @if($appointment->meeting_status == 0)
                                                        <span class="inv-status badge badge-primary">Pending</span>
                                                    @elseif($appointment->meeting_status == 1)
                                                        <span class="inv-status badge badge-success">Approved</span>
                                                    @elseif($appointment->meeting_status == 2)
                                                        <span class="inv-status badge badge-danger">Declined</span>
                                                    @elseif($appointment->meeting_status == 3)
                                                        <span class="inv-status badge badge-info">Rescheduled</span>
                                                    @elseif($appointment->meeting_status == 4)
                                                        <span class="inv-status badge badge-warning">Canceled</span>
                                                    @elseif($appointment->meeting_status == 11)
                                                        <span class="inv-status badge badge-secondary">On Going</span>
                                                    @elseif($appointment->meeting_status == 12)
                                                        <span class="inv-status badge badge-dark">Meeting End</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2" style="will-change: transform;">

                                                            @if ($appointment->meeting_status == 0)
                                                            <a class="dropdown-item action-view text-center" href="{{ route('admin.approve.appointment', $appointment->meeting_id) }}">
                                                                <span class="inv-status text-success">Approve</span>
                                                            </a>
                                                            <a class="dropdown-item action-view text-center" href="{{ route('admin.decline.appointment', $appointment->meeting_id) }}">
                                                                <span class="inv-status text-danger">Decline</span>
                                                            </a>
                                                            <a class="dropdown-item action-view text-center">
                                                                <button type="button" class="inv-status text-info" style="background: none;  border: none;" data-toggle="modal" data-target="#modalReschedule{{ $appointment->meeting_id }}">Reschedule</button>
                                                            </a>

                                                            @elseif ($appointment->meeting_status == 1)
                                                            <a class="dropdown-item action-view text-center" href="{{ route('admin.decline.appointment', $appointment->meeting_id) }}">
                                                                <span class="inv-status text-danger">Decline</span>
                                                            </a>
                                                            <a class="dropdown-item action-view text-center">
                                                                <button type="button" class="inv-status text-info" style="background: none;  border: none;" data-toggle="modal" data-target="#modalReschedule{{ $appointment->meeting_id }}">Reschedule</button>
                                                            </a>

                                                            @elseif ($appointment->meeting_status == 2)
                                                            <a class="dropdown-item action-view text-center" href="{{ route('admin.approve.appointment', $appointment->meeting_id) }}">
                                                                <span class="inv-status text-success">Approve</span>
                                                            </a>
                                                            <a class="dropdown-item action-view text-center">
                                                                <button type="button" class="inv-status text-info" style="background: none;  border: none;" data-toggle="modal" data-target="#modalReschedule{{ $appointment->meeting_id }}">Reschedule</button>
                                                            </a>

                                                            @elseif ($appointment->meeting_status == 3)
                                                            <a class="dropdown-item action-view text-center" href="{{ route('admin.decline.appointment', $appointment->meeting_id) }}">
                                                                <span class="inv-status text-danger">Decline</span>
                                                            </a>

                                                            @elseif ($appointment->meeting_status == 4)
                                                            <a class="dropdown-item action-view text-center">
                                                                <button type="button" class="inv-status text-info" style="background: none;  border: none;" data-toggle="modal" data-target="#modalReschedule{{ $appointment->meeting_id }}">Reschedule</button>
                                                            </a>

                                                            @endif

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            {{-- reschedule modal --}}
                                            <div class="modal fade" id="modalReschedule{{ $appointment->meeting_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin.reschedule.appointment', $appointment->meeting_id)}}" method="post">
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