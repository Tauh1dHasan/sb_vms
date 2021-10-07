@extends('backend.layouts.master')

    @section('content')

    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb" style="background: none; padding: 0;">
            <li class="breadcrumb-item"><a href="{{ route('visitor.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
            <li class="breadcrumb-item"><a href="{{ route('visitor.visitorPass', $meeting->meeting_id) }}">Visitor Pass</a></li>
        </ol>
    </nav>

        <div class="admin-data-content layout-top-spacing">
            <div class="row">
                
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    
                    <div class="row layout-spacing">

                        <!-- Content -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 layout-top-spacing offset-md-3 offset-xl-3 offset-lg-3">
                    
                            <div class="user-profile layout-spacing">
                                <div class="widget-content widget-content-area" style="padding: 40px">
                                    <p>
                                        @php
                                            $meetingInfo = "Appointment ID: {{$meeting->meeting_id}} <br> Visitor ID: {{$meeting->visitor_id}} <br> Employee ID: {{$meeting->employee_id}} <br> Appointment Status: {{$meeting->meeting_status}}";

                                            $visitor_pass = route('visitor.gatePass', $meeting->meeting_id);
                                        @endphp
                                    </p>
                                    <div class="text-center user-info">
                                        <h2 class="text-center" style="margin-bottom: 7%">Visitor Pass</h2>
                                        <div class="visible-print text-center" style="margin-bottom: 7%">
                                            {!! QrCode::size(200)->generate($visitor_pass); !!}
                                        </div>
                                        <p>Please show this QR code at reception to get a Gate Pass</p>
                                    </div>

                                </div>
                            </div>
                    
                        </div>
                    
                    </div>
                </div>

                
            </div>
        </div>
        @endsection