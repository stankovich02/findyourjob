<!DOCTYPE html>
<html lang="en">
<head>
    <title>Password Reset</title>
    <style>
body {
    font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
    max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
    color: #333;
}
        p {
    margin-bottom: 20px;
        }
        a {
    display: inline-block;
    padding: 10px 20px;
            background-color: #007bff;
            color: #fff!important;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
    background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Password Reset</h2>
    <p>Click the button to reset your password:</p>
    <p>
        <a href="{{ $resetLink }}">Reset password</a>
    </p>
</div>
</body>
</html>

