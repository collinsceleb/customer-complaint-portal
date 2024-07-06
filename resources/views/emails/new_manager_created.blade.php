<!DOCTYPE html>
<html lang="en">

<head>
    <title>Account Created</title>
</head>

<body>
    <p>Dear {{ $user->name }},</p>

    <p>Your manager account has been created. Here are your login details:</p>

    <p>Email: {{ $user->email }}</p>
    <p>Password: {{ $password }}</p>

    <p>Please login and change your password as soon as possible.</p>

    <p>Thank you!</p>
</body>

</html>
