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
        <h1>Greetings {{ $user->first_name}} {{ $user->last_name }}</h1>
        <p>Congratulations! Your account is approved by VMS Admin.</p>
        <p><a href="{{ route('index') }}" class="btn btn-success">Login</a> to your dashboard</p>
    </div>
</body>
</html>