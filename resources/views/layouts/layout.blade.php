<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>VILLAMIN LARAVEL</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{
            background-color: #77ff77;
            }
        .container{
            background: #ff77ff;
            padding: 0.5%;
            }
        .topnav {
            background-color: #282A35;
            overflow: hidden;
            }
        .topnav a {
            float: left;
            color: #f1f1f1;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
            letter-spacing: 1px;
            }
        .topnav a:hover {
            background-color: #000000;
            color: #f1f1f1;
            }
        .topnav a.active {
            background-color: #4CAF50;
            color: white;
            }
        .topnav-right {
            float: right;
            color: #f1f1f1;
            letter-spacing: 1px;
            }
        .noHover{
            pointer-events: none;
            }
    </style>
    </head>
    <body>
            @yield('content')
        </div>
    </body>
</html>