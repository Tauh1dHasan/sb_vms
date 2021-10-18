@extends('backend.layouts.master')

    @section('content')
    <div class="admin-data-content layout-top-spacing">
        <div class="row">
            
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">

                <div class="widget widget-one">
                    <div class="widget-heading">
                        @include('backend.partials.message')
                        <h1 class="text-center pb-4">Welcome to VMS Reception Panel</h1>
                        {{-- <h4 class="text-center pb-4">{{ $user_name->first_name }} {{ $user_name->last_name }}</h4> --}}
                    </div>
                    <div class="w-chart">

                        <div class="w-chart-section total-visits-content">
                            <div class="w-detail">
                                <p class="w-title">Total Appointments</p>
                                <p class="w-stats">{{ $total_appopintment }}</p>
                            </div>
                            <div class="w-chart-render-one">
                                
                            </div>
                        </div>
                        
                        
                        <div class="w-chart-section paid-visits-content">
                            <div class="w-detail">
                                <p class="w-title">Today's Appointments</p>
                                <p class="w-stats">{{ $today_meeting }}</p>
                            </div>
                            <div class="w-chart-render-one">
                                
                            </div>
                        </div>

                        <div class="w-chart-section total-visits-content">
                            <div class="w-detail">
                                <p class="w-title">Pending Appointments</p>
                                <p class="w-stats">{{ $pending_meetings }}</p>
                            </div>
                            <div class="w-chart-render-one">
                                
                            </div>
                        </div>
                        
                        
                        <div class="w-chart-section paid-visits-content">
                            <div class="w-detail">
                                <p class="w-title">Rejected Appointments</p>
                                <p class="w-stats">{{ $rejected_meeting }}</p>
                            </div>
                            <div class="w-chart-render-one">
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    @endsection