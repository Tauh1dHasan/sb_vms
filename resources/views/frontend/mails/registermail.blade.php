<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <h1>Welcome {{ $user->first_name}} {{ $user->last_name }}</h1>
    <p>Your mail: {{ $user->email}}</p> -->

    <div class="register-mail text-center"> 
        <h1>Welcome to VMS <br> {{ $user->first_name}} {{ $user->last_name }}</h1>
        <p>Click the below link and Login to your dashboard</p>

        <!-- <a href="{{route('frontend.user_verify', $user->user_id)}}">Login</a> -->
    </div>
</body>
</html>