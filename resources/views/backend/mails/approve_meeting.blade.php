<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VMS - Appointment Approved</title>
</head>
<body>

    <div class="register-mail text-center"> 
        <h1>Hello <br> {{ $mail_data->v_fname }} {{ $mail_data->v_lname }}</h1>
        <p>Your appointed meeting is Approved by {{ $mail_data->e_fname }} {{ $mail_data->e_lname }}. <br> Meeting Datetime:
            {{ $mail_data->meeting_datetime }} <br>    
        Please check your all appointment list. <br>Thank you</p>
    </div>
</body>
</html>