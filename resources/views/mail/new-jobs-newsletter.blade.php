<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Jobs Newsletter</title>
    <style>
        body{
            font-family: Arial, sans-serif;
        }
        #container{
          background-color:#f2f7ff;
        }
        .job{
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 500px;
            margin: 15px auto;
        }
        h1{
            padding: 40px 0;
            font-size: 30px!important;
            text-align: center;
            color: #000000;
        }
        .job h3{
            margin: 0;
            font-size: 20px!important;
        }
        .job p{
            margin: 5px 0!important;
            font-size: 17px!important;
        }
        a{
            text-decoration: none;
            color: #000;
        }
        img{
            width: 100px;
            height: 100px;
            margin-top: 20px;
        }
        #footer{
            padding: 20px;
            text-align: center;
        }
        .link{
            text-decoration: underline;
            font-weight: bold;
            color: #000;
        }
    </style>
</head>
<body>
<div id="container">
    <h1>New Jobs Available:</h1>
    @foreach($jobs as $job)
        <div class="job">
            <a href="http://127.0.0.1:8000/jobs/{{$job->id}}"><h3>{{$job->name}}</h3></a>
            <p>{{$job->company->name}}</p>
            <p>{{$job->city->name}}</p>
        </div>
    @endforeach
    <div id="footer">
        <p>If you have additional questions, write to us at <a href="mailto:findyourrjob@gmail.com" class="link">findyourrjob@gmail.com</a></p>
            © {{now()->year . " "}}<a href="http://127.0.0.1:8000/" class="link">Find Your Job</a>
        <p>This email has ended up in your inbox due to the application of the newsletter feature on our website.</p>
    </div>
</div>
</body>
</html>
