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
        <h1>Greetings!!! {{ $data1['first_name'] }} {{ $data1['last_name'] }}</h1>
        <p>Your account is created by VMS Admin. </p>
        <p>Login using your mobile number: {{ $data1['mobile_no'] }} or email: {{ $data1['email'] }}</p>
        <p>And Password: {{ $data1['password'] }}</p>
        <p><a href="{{route('index')}}" class="btn btn-success">Login</a> to your dashboard</p>
    </div>
</body>
</html>