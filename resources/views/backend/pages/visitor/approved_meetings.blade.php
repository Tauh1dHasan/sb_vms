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
                                                        <li>
                                                            <form action="{{ route('visitor.visitorPass') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="meeting_id" value="{{$meeting->meeting_id}}">
                                                                <input type="hidden" name="user_id" value="{{$meeting->user_id}}">
                                                                <input type="submit" value="Generate Visitor Pass" class="btn btn-success">
                                                            </form>
                                                        </li>
                                                    </ul>
                                                    <ul class="table-controls">
                                                        <li>
                                                            <div class="text-center">
                                                                <!-- Button trigger modal -->
                                                                <button type="button" class="btn btn-danger mb-2 mr-2" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{$meeting->meeting_id}}" onclick="meeting_func(this)">
                                                                Cancel
                                                                </button>
                                                            </div>
                                                        </li>
                                                    </ul>
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
                                                <h4 class="modal-heading mb-4 mt-2">Appointment Cancel Reason</h4>
                                                
                                                <form action="{{ route('visitor.cancel-meeting') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="meeting_id" id="this_meeting_id" value="">
                                                    <textarea name="cancel_reason" cols="63" rows="5" placeholder="Please describe appointment cancel reason" required></textarea>
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
            function meeting_func(id){
                var meeting_id = id.getAttribute("data-id");
                document.getElementById("this_meeting_id").value = meeting_id;
            }
        </script>