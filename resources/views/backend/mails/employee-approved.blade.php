<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VMS</title>
</head>
<body>
    <!-- <h1>Welcome {{ $user->first_name}} {{ $user->last_name }}</h1>
    <p>Your mail: {{ $user->email}}</p> -->

    <div class="register-mail text-center"> 
        <h1>Hello <br> {{ $user->first_name}} {{ $user->last_name }}</h1>
        <p>Your account is approved by VMS Admin. Login to your dashboard <a href="{{route('index')}}" class="btn btn-success">Login</a></p>
    </div>
</body>
</html>