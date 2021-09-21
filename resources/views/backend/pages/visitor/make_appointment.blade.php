@extends('backend.layouts.master')

    @section('content')


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

                                    <form action="{{ route('visitor.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="visitor_id" value="{{ $visitor->visitor_id }}">

                                        <div class="form-group mb-4">
                                            <!-- <select class="placeholder js-states form-control select2" name="employee_id">
                                                <div id="employees"></div>
                                            </select> -->

                                            <!-- <input name="employee_info" type="text" class="form-control" id="employee_id" placeholder="Type Employee Name"> -->
                                            <select name="employee_id" id="employee_id" class="form-control"> 
                                            </select>
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
                                            <input name="meeting_datetime" type="datetime-local" class="form-control">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="meeting_purpose_id">Do you have a vehicle ?</label>
                                            <select name="meeting_purpose_id" class="form-control" id="meeting_purpose_id" required>
                                                    <option value="">Select an Option</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                            </select>
                                        </div>
   
                                        <input type="submit" name="time" class="mt-4 mb-4 btn btn-primary">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
        @endsection