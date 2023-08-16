<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>

<body>
    <h2>Hello Good to see you again !</h2>
    <h3>Forget Password Email</h3>
    You can reset password from below link:
    <a href="{{ route('reset.password.get', $token) }}">Reset Password</a>
    <footer>
        <h5>Thank you for choosing E-Commerce</h5>
        <img src="{{asset('images/footer.jpg') }}" alt="footer" height="100px" width="100%">
    </footer>
</body>
</html>
