<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VMS</title>
</head>
<body>

    <div class="register-mail text-center"> 
        <h1>Welcome to VMS <br> {{ $user->first_name}} {{ $user->last_name }}</h1>
        <p>Click <a href="{{route('frontend.user_verify', $user->user_id)}}" class="btn btn-success">verify</a> to Login to your dashboard</p>
    </div>
</body>
</html>