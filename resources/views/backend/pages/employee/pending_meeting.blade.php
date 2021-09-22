@extends('backend.layouts.master')

    @section('content')

        <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive mb-4">
                                <h4>Pending Appointments</h4>
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
                                            <th class="text-center">Action</th>
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
                                                <td>
                                                    <div class="text-center">
                                                        <form action="{{ route('employee.declineMeeting') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="meeting_id" value="{{ $meeting->meeting_id }}">
                                                            <input type="submit" value="Decline" class="btn btn-danger">
                                                        </form>
                                                    </div>
                                                    
                                                    <div class="text-center">
                                                        <form action="{{ route('employee.approveMeeting') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="meeting_id" value="{{ $meeting->meeting_id }}">
                                                            <input type="submit" value="Approve" class="btn btn-success">
                                                        </form>
                                                    </div>

                                                    <div class="text-center">
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{$meeting->meeting_id}}" onclick="meeting_func(this)">
                                                        Re-schedule
                                                        </button>
                                                    </div>
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
                                                <h4 class="modal-heading mb-4 mt-2">Select another datetime</h4>
                                                
                                                <form action="{{ route('employee.rescheduleMeeting') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="meeting_id" id="this_meeting_id" value="">
                                                    
                                                    <input name="meeting_datetime" type="datetime-local" class="form-control">
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                <button type="submit" class="btn btn-primary">Save</button>

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
    
    <script>
        function meeting_func(id)
        {
            var meeting_id = id.getAttribute("data-id");
            document.getElementById("this_meeting_id").value = meeting_id;
        }
    </script>