@extends('backend.layouts.master')

    @section('content')


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
                                            $visitor_pass = "http://localhost:8000/visitor/gate-pass/{$meeting_id}";
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