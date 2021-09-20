<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2 style="color: red">Warning Anyone or you required new password . Dont provide this
        email for anyone
    </h2>
    <p>
        Your code: <b>{{ $code }}</b>
    </p>
    <p>Click this <a href="{{ url('/newpass/verify/'.$url) }}">Link</a> to enter your code to change your password</p>
</body>
</html>