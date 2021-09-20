@extends('backend.layouts.master')

    @section('content')


    <div class="admin-data-content layout-top-spacing">
        <div class="row layout-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive mb-4">
                            <table id="style-3" class="table style-3  table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center"> Meeting ID </th>
                                        <th class="text-center">Employee Info</th>
                                        <th class="text-center">Meeting Purpose</th>
                                        <th class="text-center">Meeting Date</th>
                                        <th class="text-center">Meeting Time</th>
                                        <th class="text-center">Has Vehicle</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($meetings as $meeting)
                                        <tr>
                                            <td class="text-center"> {{$meeting->meeting_id}} </td>
                                            <td class="text-center"> {{$meeting->employee_info}} </td>
                                            <td class="text-center"> {{$meeting->purpose_name}} </td>
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
                                            
                                            <td class="text-center">
                                                <ul class="table-controls">
                                                    <li><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                                    <li><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                                                </ul>
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