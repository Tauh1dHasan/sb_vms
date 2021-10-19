<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('frontend/vendor/bootstrap/css/bootstrap.min.css')}}">
    <title>VMS - Forgot Password</title>
</head>
<body>

    <div class="register-mail text-center"> 
        <h1>Dear User</h1>
        <p>We accept a request for password reset against your VMS account <br>
           please click the link bellow to reset your password.
        </p>
        <a href="{{ route('frontend.resetPassword', [$mailData['user_id'], $mailData['token']]) }}" class="btn btn-success">Reset Password</a>
    </div>
</body>
</html>