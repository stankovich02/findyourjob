<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Admin</title>
    <style>
       h4{
           margin-bottom: 10px;
           font-weight: 500;
       }
         #jobName{
              font-weight: bold;
         }
    </style>
</head>
<body>
@if($status == 'approved')
<h4>Dear {{$companyName}},</h4>
<h4>We hope this email finds you well.</h4>
<h4>We are pleased to inform you that your job submission for <span id="jobName">{{$jobName}}</span> position on our website has been successfully approved by the site administrator. Congratulations on this achievement!</h4>
<h4>Your job listing is now live and visible to our audience, which will help you attract potential candidates for the position.</h4>
<h4>Thank you for choosing our platform to post your job opportunity.</h4>
@endif
@if($status == 'rejected')
<h4>Dear {{$companyName}},</h4>
<h4>We hope this email finds you well.</h4>
<h4>We regret to inform you that your job submission for <span id="jobName">{{$jobName}}</span> position on our website has been rejected by the site administrator. We apologize for any inconvenience this may have caused.</h4>
<h4>Our team has reviewed your job listing and found that it does not meet our platform's requirements. We encourage you to review our guidelines and resubmit your job opportunity for approval.</h4>
<h4>Thank you for choosing our platform to post your job opportunity.</h4>
@endif
<h4>Best regards,</h4>
<h4>FindYourJob Team</h4>

</body>
</html>


