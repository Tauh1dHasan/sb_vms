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
                                    <div class="col-lg-12 col-12 layout-spacing">
                                        <div class="statbox widget box box-shadow">
                                            <div class="widget-header">                                
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                        <h4>Update profile information</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content widget-content-area">
                                                <form action="{{ route('visitor.update-profile') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="form-group mb-4">
                                                        {{-- hidden old profile image --}}
                                                        <input type="hidden" name="old_photo" value="{{$visitor->profile_photo}}">
                                                        
                                                        <label for="new_photo">Update Profile Picture</label>
                                                        <input name="new_photo" type="file" class="form-control" id="new_photo">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="fname">First Name</label>
                                                        <input name="fname" type="text" class="form-control" id="fname" value="{{ $visitor->first_name }}" required>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="lname">Last Name</label>
                                                        <input name="lname" type="text" class="form-control" id="lname" value="{{ $visitor->last_name }}" required>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="email">Email address</label>
                                                        <input name="email" type="email" class="form-control" id="email" value="{{ $visitor->email }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="visitor_type">Visitor Type</label>
                                                        <select name="visitor_type" class="form-control" id="visitor_type" required>
                                                            <option value="">Select</option>
                                                            @foreach ($visitor_type as $item)
                                                                <option value="{{ $item->visitor_type_id }}">{{ $item->visitor_type }}</option>    
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="organization">Organization Name</label>
                                                        <input name="organization" type="text" class="form-control" id="organization" value="{{ $visitor->organization }}" required>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="designation">Designation</label>
                                                        <input name="designation" type="text" class="form-control" id="designation" value="{{ $visitor->designation }}" required>
                                                    </div>
                                                    
                                                    <div class="form-group mb-4">
                                                        <label for="address">Current Address</label>
                                                        <textarea name="address" class="form-control" id="address" rows="3">{{ $visitor->address }}</textarea>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="mobile_no">Mobile Number</label>
                                                        <input name="mobile_no" type="number" class="form-control" id="mobile_no" value="{{ $visitor->mobile_no }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="nid_no">NID Number</label>
                                                        <input name="nid_no" type="number" class="form-control" id="nid_no" value="{{ $visitor->nid_no }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="passport_no">Passport Number</label>
                                                        <input name="passport_no" type="number" class="form-control" id="passport_no" value="{{ $visitor->passport_no }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="driving_license_no">Driving License Number</label>
                                                        <input name="driving_license_no" type="number" class="form-control" id="driving_license_no" value="{{ $visitor->driving_license_no }}">
                                                    </div>
                                                    
                                                    {{-- hidden user_id --}}
                                                    <input name="user_id" type="hidden" value="{{ $visitor->user_id }}">
                                                    <input type="submit" name="submit" class="mt-4 mb-4 btn btn-primary">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                        </div>
                    
                    </div>
                </div>

                
            </div>
        </div>
        @endsection