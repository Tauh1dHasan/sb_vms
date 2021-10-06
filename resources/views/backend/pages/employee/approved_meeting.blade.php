@extends('backend.layouts.master')

    @section('content')

        <nav class="breadcrumb-one" aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('employee.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                <li class="breadcrumb-item"><a href="{{ route('employee.approvedMeetings') }}">Approved Appointments</a></li>
            </ol>
        </nav>

        <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive mb-4">
                                <h4>Approved Appointments</h4>
                                @if (session('success'))
                                    <div class="alert alert-light-success border-0 mb-4" role="alert"> 
                                        <p class="text-success">{{ session('success') }}</p> 
                                    </div>
                                @endif
                                @if (session('fail'))
                                    <div class="alert alert-light-success border-0 mb-4" role="alert"> 
                                        <p class="text-success">{{ session('success') }}</p> 
                                    </div>
                                @endif
                                
                                <table id="style-3" class="table style-3  table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Meeting ID </th>
                                            <th class="text-center">Visitor Name</th>
                                            <th class="text-center">Meeting Purpose</th>
                                            <th class="text-center">Purpose Description</th>
                                            <th class="text-center">Meeting Date</th>
                                            <th class="text-center">Meeting Time</th>
                                            <th class="text-center">Has Vehicle</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($meetings as $meeting)
                                            <tr>
                                                <td class="text-center"> {{$meeting->meeting_id}} </td>
                                                <td class="text-center"> {{$meeting->first_name}} {{$meeting->last_name}} </td>
                                                <td class="text-center"> {{$meeting->purpose_name}} </td>
                                                <td class="text-center"> {{$meeting->purpose_describe}} </td>
                                                <td class="text-center"> <?php echo date("d M, Y", strtotime($meeting->meeting_datetime)); ?> </td>
                                                <td class="text-center"> <?php echo date("h:i a", strtotime($meeting->meeting_datetime)); ?> </td>
                                                <td class="text-center"> 
                                                    @if($meeting->has_vehicle == 1)
                                                        <?php echo 'Yes'?>
                                                    @else
                                                        <?php echo 'No'?>
                                                    @endif
                                                </td>
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
                                                        <span class="shadow-none badge badge-warning">Canceled</span>
                                                    @elseif($meeting->meeting_status == 11)
                                                        <span class="shadow-none badge badge-info">On Going</span>
                                                    @elseif($meeting->meeting_status == 12)
                                                        <span class="shadow-none badge badge-dark">Meeting End</span>
                                                    @endif
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
    
    