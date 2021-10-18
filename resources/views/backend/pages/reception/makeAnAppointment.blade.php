@extends('backend.layouts.master')

    @section('content')

    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb" style="background: none; padding: 0;">
            <li class="breadcrumb-item"><a href="{{ route('reception.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
            <li class="breadcrumb-item"><a href="{{ route('reception.appointVisitor') }}">Appoint Visitor</a></li>
            <li class="breadcrumb-item"><a href="{{ route('reception.makeAnAppointment', $visitor_id) }}">Make An Appointment</a></li>
        </ol>
    </nav>

        <div class="admin-data-content layout-top-spacing">
            <div class="row">
                
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-one">
                        <div class="widget-heading">
                            <h1 class="text-center pb-4">Make your appointment</h1>
                        </div>
                        <div class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                
                                <div class="widget-content widget-content-area">

                                    <form action="{{ route('reception.placeAnAppointment') }}" method="post">
                                        @csrf
                                        {{-- needed hidden field --}}
                                        <input type="hidden" name="visitor_id" value="{{ $visitor_id }}">

                                        <div class="form-group mb-4">
                                            <select name="employee_id" id="employee_id" class="form-control"></select>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="meeting_purpose_id">Select Meeting Purpose</label>
                                            <select name="meeting_purpose_id" class="form-control" id="meeting_purpose_id" required>
                                                    <option value="">Select</option>
                                                    @foreach ($purpose as $item)
                                                        <option value="{{ $item->purpose_id }}">{{ $item->purpose_name }}</option>    
                                                    @endforeach
                                            </select>
                                        </div>


                                        <div class="form-group mb-4">
                                            <label for="meeting_purpose_describe">Describe your meeting purpose</label>
                                            <textarea name="meeting_purpose_describe" class="form-control" id="meeting_purpose_describe" rows="3"></textarea>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="meeting_datetime">Meeting Datetime</label>
                                            <input id="meeting_datetime" name="meeting_datetime" class="form-control" placeholder="Select Datetime" autocomplete="off" required>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="attendees_no">Number of Attendees</label>
                                            <input type="number" id="attendees_no" name="attendees_no" class="form-control" placeholder="Total number of attendees" autocomplete="off" required>
                                        </div>

                                        <div class="form-group mbhas_vehicle-4">
                                            <label for="has_vehicle">Do you have a vehicle ?</label>
                                            <select name="has_vehicle" class="form-control" id="has_vehicle" required>
                                                    <option value="">Select an Option</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                            </select>
                                        </div>
   
                                        <input type="submit" name="submit" class="mt-4 mb-4 btn btn-primary">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
        @endsection