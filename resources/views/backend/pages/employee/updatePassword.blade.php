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
                                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 text-center">
                                                        <h1>Update Your Password</h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content widget-content-area">
                                                <form action="{{ route('employee.updatePassword') }}" method="POST">
                                                    @csrf

                                                    <div class="form-group mb-4">
                                                        <label for="curr_password">Current Password</label>
                                                        <input name="curr_password" type="password" class="form-control" id="curr_password" placeholder="Please type your current password" required>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="new_password">New Password</label>
                                                        <input name="new_password" type="password" class="form-control" id="new_password" placeholder="Enter your new password" required>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="confirm_password">Confirm Password</label>
                                                        <input name="confirm_password" type="password" class="form-control" id="confirm_password" placeholder="Confirm your new password" required>
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