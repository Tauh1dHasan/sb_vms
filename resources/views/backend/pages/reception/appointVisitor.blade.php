@extends('backend.layouts.master')

    @section('content')

        <nav class="breadcrumb-one" aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('reception.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                <li class="breadcrumb-item"><a href="{{ route('reception.appointVisitor') }}">Appoint Visitor</a></li>
            </ol>
        </nav>

        <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            @include('backend.partials.message')
                            <div class="row visitor_type_div">
                                
                                <a class="card col-5 visitor_type_card_body_one" href="{{route('reception.visitorAndAppointment')}}">
                                    <div class="card-body">
                                        <h5 class="card-title text-center" style="margin-top: 20%; font-size: 3em;">New Visitor</h5>
                                    </div>
                                </a>

                                <a class="card col-5 ml-2 visitor_type_card_body_two" href="{{route('reception.visitorList')}}">
                                    <div class="card-body">
                                        <h5 class="card-title text-center" style="margin-top: 20%; font-size: 3em;">Existing Visitor</h5>
                                    </div>
                                </a>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    
    