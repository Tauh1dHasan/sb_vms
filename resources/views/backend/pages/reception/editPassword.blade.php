@extends('backend.layouts.master')

    @section('content')

    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb" style="background: none; padding: 0;">
            <li class="breadcrumb-item"><a href="{{ route('reception.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
            <li class="breadcrumb-item"><a href="{{ route('reception.editPassword') }}">Update Password</a></li>
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
                                    <div class="col-lg-12 col-12 layout-spacing">
                                        <div class="statbox widget box box-shadow">
                                            <div class="widget-header">                                
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 text-center">
                                                        <h1>Update Your Password</h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content widget-content-area">
                                                <form action="{{ route('reception.updatePassword') }}" method="POST">
                                                    @csrf

                                                    <div class="form-group mb-4">
                                                        <label for="curr_password">Current Password</label>
                                                        <input name="curr_password" type="password" class="form-control" id="curr_password" placeholder="Please type your current password" required>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="password">New Password</label>
                                                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter your new password" autocomplete="off" required>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="password">Confirm Password</label>
                                                        <input name="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Confirm your new password" autocomplete="off" required>
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
                </div>

                
            </div>
        </div>
        @endsection