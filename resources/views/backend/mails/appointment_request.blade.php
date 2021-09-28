<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VMS - Appointment Request</title>
</head>
<body>

    <div class="register-mail text-center"> 
        <h1>Hello <br> {{ $employee_mail->efname}} {{ $employee_mail->elname }}</h1>
        <p>Your have an appointment request, From {{$employee_mail->vfname}} {{$employee_mail->vlname}}. <br> Meeting Datetime:
            {{ date('M d, Y', strtotime($employee_mail->meeting_datetime)) }}    
        <br> Please check your pending appointment list. <br>Thank you</p>
    </div>
</body>
</html>