<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Admin</title>
    <style>
        #details{
            display: flex;
        }
        #details h3{
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div id="details">
        <h3>{{ $name }}</h3> <h4>has contacted you. Here are the message details:</h4>
    </div>
    <br/>
    <h3>{{ $content }}</h3>
</body>
</html>


