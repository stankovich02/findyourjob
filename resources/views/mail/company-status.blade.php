<!DOCTYPE html>
<html lang="en">
<head>
    <title>Company status</title>
    <style>
        h4{
            margin-bottom: 10px;
            font-weight: 500;
        }
    </style>
</head>
<body>
<h4>Dear {{$companyName}},</h4>
<h4>We hope this email finds you well.</h4>
@if($status == 'approved')
    <h4>We are pleased to inform you that your company submission on our website has been successfully approved by the site administrator. Congratulations on this achievement!</h4>
    <h4>Your company is now live and visible to our audience, which will help you attract potential candidates for the positions you offer.</h4>
@endif
@if($status == 'rejected')
    <h4>We regret to inform you that your company submission on our website has been rejected by the site administrator. We apologize for any inconvenience this may have caused.</h4>
    <h4>Our team has reviewed your company and found that it does not meet our platform's requirements. We encourage you to review our guidelines and resubmit your company for approval.</h4>
@endif
<h4>Thank you for choosing our platform to find the best candidates for your company.</h4>
<h4>Best regards,</h4>
<h4>FindYourJob Team</h4>
</body>
</html>



