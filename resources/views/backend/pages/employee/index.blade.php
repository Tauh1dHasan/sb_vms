@extends('backend.layouts.master')

    @section('content')
    <div class="admin-data-content layout-top-spacing">
        <div class="row">
            
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">

                @if (session('success'))
                    <div class="alert alert-light-success border-0 mb-4" role="alert"> 
                        <p class="text-success">{{ session('success') }}</p> 
                    </div>
                @endif
                @if (session('fail'))
                    <div class="alert alert-light-success border-0 mb-4" role="alert"> 
                        <p class="text-danger">{{ session('fail') }}</p> 
                    </div>
                @endif
                
                <div class="widget widget-one">
                    <div class="widget-heading">
                        <h2 class="text-center pb-4">Welcome to VMS Employee Panel</h2>
                        @if ($employee->availability == 1)
                            <p class="text-center">Availability Status: 
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#availabilityModal" data-id="{{$employee->employee_id}}" onclick="availabilityFunc(this)">Available</button>
                            </p>
                        @else
                            <p class="text-center">Availability Status: 
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#availabilityModal" data-id="{{$employee->employee_id}}" onclick="availabilityFunc(this)">Unavailable</button>
                            </p>
                        @endif
                    </div>

                    <div class="w-chart">

                        <div class="w-chart-section total-visits-content">
                            <div class="w-detail">
                                <p class="w-title">Total Appointments</p>
                                <p class="w-stats">{{$total_appointment}}</p>
                            </div>
                            <div class="w-chart-render-one">
                                
                            </div>
                        </div>
                        
                        
                        <div class="w-chart-section paid-visits-content">
                            <div class="w-detail">
                                <p class="w-title">Today's Appointments</p>
                                <p class="w-stats">{{$today_appointment}}</p>
                            </div>
                            <div class="w-chart-render-one">
                                
                            </div>
                        </div>

                        <div class="w-chart-section total-visits-content" style="background: #94d4c1">
                            <div class="w-detail">
                                <p class="w-title">Approved Appointments</p>
                                <p class="w-stats">{{$approved_appointment}}</p>
                            </div>
                            <div class="w-chart-render-one">
                                
                            </div>
                        </div>

                        <div class="w-chart-section total-visits-content">
                            <div class="w-detail">
                                <p class="w-title">Pending Appointments</p>
                                <p class="w-stats">{{$pending_appointment}}</p>
                            </div>
                            <div class="w-chart-render-one">
                                
                            </div>
                        </div>
                        
                        
                        <div class="w-chart-section paid-visits-content">
                            <div class="w-detail">
                                <p class="w-title">Rejected Appointments</p>
                                <p class="w-stats">{{$reject_appointment}}</p>
                            </div>
                            <div class="w-chart-render-one">
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>


            {{-- Modal --}}
            <div class="modal fade" id="availabilityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p style="font-size: 1.5em; font-weight: bold" class="modal-heading mb-4 mt-2">Are you sure, you want to change your availability status ?</p>
                            
                            <form action="{{route('employee.availabilityStatus')}}" method="POST">
                                @csrf
                                <input type="hidden" name="employee_id" id="this_employee_id" value="">
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>Cancel</button>
                            <button type="submit" class="btn btn-primary">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            
        </div>
    </div>
    @endsection

    <script>
        function availabilityFunc(id){
            var employee_id = id.getAttribute("data-id");
            document.getElementById("this_employee_id").value = employee_id;
        }
    </script>