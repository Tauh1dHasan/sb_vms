<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VMS - Appointment Canceled</title>
</head>
<body>

    <div class="register-mail text-center"> 
        <h1>Hello <br> {{ $visitor_meeting_cancel_email->efname}} {{ $visitor_meeting_cancel_email->elname }}</h1>
        <p>Your appointed meeting is canceled by {{$visitor_meeting_cancel_email->vfname}} {{$visitor_meeting_cancel_email->vlname}}. <br> Mobile Number: {{$visitor_meeting_cancel_email->mobile_no}}<br> Meeting Datetime:
            {{ date('M d, Y', strtotime($visitor_meeting_cancel_email->meeting_datetime)) }} <br>
            Cancel reason: {{ $visitor_meeting_cancel_email->cancel_reason }}    
        <br> Please check your pending appointment list. <br>Thank you</p>
    </div>
</body>
</html>