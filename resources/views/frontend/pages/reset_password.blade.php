<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Reset Password</title>
    <link rel="icon" type="image/x-icon" href="{{asset('frontend/img/favicon.png')}}"/>
    <link href="{{asset('backend/assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('backend/assets/js/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="{{asset('backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/structure.css')}}" rel="stylesheet" type="text/css" class="structure" />
    <link href="{{asset('backend/assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/forms/switches.css')}}">
</head>
<body class="form">
    

    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Reset Password</h1>

                        @include('backend.partials.message')
                        
                        <form class="text-left" action="{{route('frontend.resetPasswordStore')}}" method="post">
                            @csrf
                            <div class="form">
                    
                                <div id="username-field" class="field-wrapper input">
                                    <label for="password">New Password</label>
                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Min 1 upper 1 lower & 8 character" autocomplete="off" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div id="username-field" class="field-wrapper input">
                                    <label for="password">Confirm Password</label>
                                    <input name="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Confirm your new password" autocomplete="off" required>
                                </div>
                                {{-- hidden data --}}
                                <input type="hidden" name="user_id" value="{{$user_id}}">
                                <input type="hidden" name="token" value="{{$token}}">

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">Reset Password</button>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('backend/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('backend/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('backend/assets/js/authentication/form-2.js')}}"></script>

</body>

</html>