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
                                
                                <table id="style-3" class="table style-3  table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Meeting ID</th>
                                            <th class="text-center">Visitor Name</th>
                                            <th class="text-center">Visitor Mobile</th>
                                            <th class="text-center">Visitor Organization</th>
                                            <th class="text-center">Visitor Designation</th>
                                            <th class="text-center">Host Name</th>
                                            <th class="text-center">Host mobile</th>
                                            <th class="text-center">Meeting Purpose</th>
                                            <th class="text-center">Description</th>
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
                                                <td class="text-center"> {{ $meeting->designation }} </td>
                                                <td class="text-center"> {{ $meeting->efname }} {{ $meeting->elname }}</td>
                                                <td class="text-center"> {{ $meeting->emobile }}</td>
                                                <td class="text-center"> {{ $meeting->purpose_name }}</td>
                                                <td class="text-center"> {{ $meeting->purpose_describe }}</td>
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
                                                <td class="btn btn-primary btn-sm">Action</td>
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
    
    