@extends('backend.layouts.master')

    @section('content')
        @if(session('loggedUserType') == 4)
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
                            <p class="text-success">{{ session('fail') }}</p> 
                        </div>
                    @endif
                    
                    <div class="widget widget-one">
                        <div class="widget-heading">
                            <h1 class="text-center pb-4">Welcome to VMS Visitor Panel</h1>
                            
                        </div>
                        <div class="w-chart">
                            
                            <div class="w-chart-section total-visits-content">
                                <div class="w-detail">
                                    <p class="w-title">Total Appointments</p>
                                    <p class="w-stats">40</p>
                                </div>
                                <div class="w-chart-render-one">
                                    
                                </div>
                            </div>
                            
                            
                            <div class="w-chart-section paid-visits-content">
                                <div class="w-detail">
                                    <p class="w-title">Today's Appointments</p>
                                    <p class="w-stats">4</p>
                                </div>
                                <div class="w-chart-render-one">
                                    
                                </div>
                            </div>

                            <div class="w-chart-section total-visits-content">
                                <div class="w-detail">
                                    <p class="w-title">Pending Appointments</p>
                                    <p class="w-stats">2</p>
                                </div>
                                <div class="w-chart-render-one">
                                    
                                </div>
                            </div>
                            
                            
                            <div class="w-chart-section paid-visits-content">
                                <div class="w-detail">
                                    <p class="w-title">Rejected Appointments</p>
                                    <p class="w-stats">5</p>
                                </div>
                                <div class="w-chart-render-one">
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                
            </div>
        </div>

        @elseif(session('loggedUserType') == 2)
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
                            <p class="text-success">{{ session('fail') }}</p> 
                        </div>
                    @endif
                    
                    <div class="widget widget-one">
                        <div class="widget-heading">
                            <h1 class="text-center pb-4">Welcome to VMS Host Panel</h1>
                            
                        </div>
                        <div class="w-chart">
                            
                            <div class="w-chart-section total-visits-content">
                                <div class="w-detail">
                                    <p class="w-title">Total Appointments</p>
                                    <p class="w-stats">40</p>
                                </div>
                                <div class="w-chart-render-one">
                                    
                                </div>
                            </div>
                            
                            
                            <div class="w-chart-section paid-visits-content">
                                <div class="w-detail">
                                    <p class="w-title">Today's Appointments</p>
                                    <p class="w-stats">4</p>
                                </div>
                                <div class="w-chart-render-one">
                                    
                                </div>
                            </div>

                            <div class="w-chart-section total-visits-content">
                                <div class="w-detail">
                                    <p class="w-title">Pending Appointments</p>
                                    <p class="w-stats">2</p>
                                </div>
                                <div class="w-chart-render-one">
                                    
                                </div>
                            </div>
                            
                            
                            <div class="w-chart-section paid-visits-content">
                                <div class="w-detail">
                                    <p class="w-title">Rejected Appointments</p>
                                    <p class="w-stats">5</p>
                                </div>
                                <div class="w-chart-render-one">
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                
            </div>
        </div>

        @else
        <div class="admin-data-content layout-top-spacing">
            <div class="row">
                
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-one">
                        <div class="widget-heading">
                            <h1 class="text-center pb-4">Welcome to VMS Admin Panel</h1>
                        </div>
                        <div class="w-chart">

                            <div class="w-chart-section total-visits-content">
                                <div class="w-detail">
                                    <p class="w-title">Total Appointments</p>
                                    <p class="w-stats">423,964</p>
                                </div>
                                <div class="w-chart-render-one">
                                    
                                </div>
                            </div>
                            
                            
                            <div class="w-chart-section paid-visits-content">
                                <div class="w-detail">
                                    <p class="w-title">Today's Appointments</p>
                                    <p class="w-stats">7,929</p>
                                </div>
                                <div class="w-chart-render-one">
                                    
                                </div>
                            </div>

                            <div class="w-chart-section total-visits-content">
                                <div class="w-detail">
                                    <p class="w-title">Pending Appointments</p>
                                    <p class="w-stats">423,964</p>
                                </div>
                                <div class="w-chart-render-one">
                                    
                                </div>
                            </div>
                            
                            
                            <div class="w-chart-section paid-visits-content">
                                <div class="w-detail">
                                    <p class="w-title">Rejected Appointments</p>
                                    <p class="w-stats">7,929</p>
                                </div>
                                <div class="w-chart-render-one">
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                
            </div>
        </div>

        @endif
    @endsection