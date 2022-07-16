<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<body>
    <h1>Reset Password</h1>
    <p>Your token is <strong>{{$token}}</strong> </p>
    <p>Thanks</p>
    {{-- <p>
        You are receiving this email because we received a password reset request for your account.
    </p>
    <p>
        Please click the button below to reset your password.
    </p>
    <a href="{{ url('/reset-password/'.$token) }}">Reset Password</a> --}}
</body>
</html>