@extends('backend.layouts.master')

    @section('content')
        
    <div class="admin-data-content layout-top-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: none; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.receptionist.index') }}">Manage Receptionists</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>All Receptionists</span></li>
                        </ol>
                    </nav>

                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="widget widget-card-four" style="padding-left: 0"> 
                                <div class="w-header">
                                    <div class="w-info">
                                        <h6 class="value">All Receptionists</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive mb-4">
                                @include('backend.partials.message')
                                <table id="style-3" class="table style-3  table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Serial No.</th>
                                            <th class="text-center">EID </th>
                                            <th class="text-center">Profile Photo </th>
                                            <th class="text-center">Receptionist Name </th>
                                            <th class="text-center">Gender</th>
                                            <th class="text-center">Dept. & Designation</th>
                                            <th class="text-center">Mobile Number</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Work Hour</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $employee)
                                            <tr>
                                                <td class="text-center"> #{{ $loop->index + 1 }} </td>
                                                <td class="text-center"> #{{$employee->eid_no}} </td>
                                                @if($employee->photo)
                                                    <td class="text-center"> <img src="{{asset('backend/img/employees/' . $employee->photo)}}" alt="" style="max-height: 40px;"> </td>
                                                @else
                                                    <td class="text-center"> <img src="{{asset('backend/img/avatar.png')}}" alt="" style="max-height: 40px;"> </td>
                                                @endif
                                                <td class="text-center"> {{$employee->first_name}} {{$employee->last_name}}</td>
                                                <td class="text-center"> 
                                                    @if($employee->gender == 1)
                                                        {{ 'Male' }}
                                                    @elseif($employee->gender == 2)
                                                        {{ 'Female' }}
                                                    @endif
                                                </td>
                                                <td class="text-center"> {{$employee->designation}} <br> Dept: {{$employee->department_name}} </td>
                                                <td class="text-center"> {{$employee->mobile_no}} </td>
                                                <td class="text-center"> {{$employee->email}} </td>
                                                <td class="text-center"> <?php echo date("h:i a", strtotime($employee->start_hour)); ?> <br> to <br> <?php echo date("h:i a", strtotime($employee->end_hour)); ?></td>
                                                <td class="text-center"> 
                                                    @if($employee->status == 0)
                                                        <span class="shadow-none badge badge-primary">Pending</span>
                                                    @elseif($employee->status == 1)
                                                        <span class="shadow-none badge badge-success">Approved</span>
                                                    @elseif($employee->status == 2)
                                                        <span class="shadow-none badge badge-danger">Declined</span>
                                                    @endif
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