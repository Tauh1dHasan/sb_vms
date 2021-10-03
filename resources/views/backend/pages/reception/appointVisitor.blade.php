@extends('backend.layouts.master')

    @section('content')

        <form action="{{route('reception.searchVisitor')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-5 col-xl-5">
                    <label for="data">Search Visitor</label>
                    <input type="text" class="form-control" name="data" id="data" placeholder="Search Visitor by Name or Mobile Number" required>
                </div>
                
                <div class="col-md-2 col-xl-2">
                    <button type="submit" class="form-control" class="btn btn-primary" style="margin-top: 30px">Submit</button>
                </div>
            </div>
        </form>


        <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive mb-4">
                                <h4>Visitor List</h4>
                                
                                <table id="style-3" class="table style-3  table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Visitor ID</th>
                                            <th class="text-center">Visitor Photo</th>
                                            <th class="text-center">Visitor Name</th>
                                            <th class="text-center">Organization</th>
                                            <th class="text-center">Designation</th>
                                            <th class="text-center">Mobile</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($visitors as $visitor)
                                            <tr>
                                                <td class="text-center"> {{ $visitor->visitor_id }} </td>
                                                <td class="text-center">
                                                    <img style="max-width: 100px" src="{{ asset('backend/img/visitors/').'/'.$visitor->profile_photo }}" alt="{{ $visitor->first_name }} {{ $visitor->last_name }}">
                                                </td>
                                                <td class="text-center"> {{ $visitor->first_name }} {{ $visitor->last_name }} </td>
                                                <td class="text-center"> {{ $visitor->organization }} </td>
                                                <td class="text-center"> {{ $visitor->designation }} </td>
                                                <td class="text-center"> {{ $visitor->mobile_no }} </td>
                                                <td class="text-center"> {{ $visitor->email }} </td>
                                                <td class="text-center mt-4">
                                                    <a href="/reception/make-an-appointment/{{ $visitor->visitor_id }}" class="btn btn-success btn-sm">Make Appointment</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    
    