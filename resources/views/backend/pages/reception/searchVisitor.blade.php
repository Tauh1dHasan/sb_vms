@extends('backend.layouts.master')

    @section('content')

        <nav class="breadcrumb-one" aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('reception.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                <li class="breadcrumb-item"><a href="{{ route('reception.searchVisitor') }}">Searched Visitor List</a></li>
            </ol>
        </nav>
        
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
                                            <th class="text-center">Address</th>
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
                                                <td class="text-center"> {{ $visitor->address }} </td>
                                                <td class="text-center">
                                                    <a href="/reception/make-an-appointment/{{ $visitor->visitor_id }}" class="btn btn-success btn-sm mb-1">Make Appointment</a><br>
                                                    <a href="/reception/visitor-profile/{{ $visitor->visitor_id }}" class="btn btn-danger btn-sm">View Profile</a>
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
    
    