@extends('backend.layouts.master')

    @section('content')
    <div class="admin-data-content layout-top-spacing">
        <div class="row">
            
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-one">

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
                    
                    <div class="widget-heading">
                        <h1 class="text-center pb-4">Welcome to VMS Employee Panel</h1>
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

            
        </div>
    </div>
    @endsection