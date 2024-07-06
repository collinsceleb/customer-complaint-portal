<!DOCTYPE html>
<html lang="en">

<head>
    <title>Account Created</title>
</head>

<body>
    <h1>Hello {{ $customer->first_name }} {{ $customer->last_name }}</h1>
    <p>Your account has been created successfully. Here are your login details:</p>
    <p>Email: {{ $customer->email }}</p>
    <p>Password: {{ $password }}</p>
    <p>Please log in and change your password as soon as possible.</p>
    <p>Thank you!</p>
</body>

</html>
