<style>
    body#LoginForm {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        padding: 10px;
        background-color: #444444
    }

    .form-heading {
        color: #fff;
        font-size: 23px;
    }

    .panel h2 {
        color: #444444;
        font-size: 18px;
        margin: 0 0 8px 0;
    }

    .panel p {
        color: #777777;
        font-size: 14px;
        margin-bottom: 30px;
        line-height: 24px;
    }

    .login-form .form-control {
        background: #f7f7f7 none repeat scroll 0 0;
        border: 1px solid #d4d4d4;
        border-radius: 4px;
        font-size: 14px;
        height: 50px;
        line-height: 50px;
    }

    .main-div {
        background: #ffffff none repeat scroll 0 0;
        border-radius: 10px;
        margin: 10px auto 30px;
        max-width: 38%;
        padding: 50px 70px 70px 71px;
    }

    .login-form .form-group {
        margin-bottom: 10px;
    }

    .login-form {
        text-align: center;
    }

    .forgot a {
        color: #777777;
        font-size: 14px;
        text-decoration: underline;
    }

    .login-form .btn.btn-primary {
        background: #f0ad4e none repeat scroll 0 0;
        border-color: #f0ad4e;
        color: #ffffff;
        font-size: 14px;
        width: 100%;
        height: 50px;
        line-height: 50px;
        padding: 0;
    }

    .forgot {
        text-align: left;
        margin-bottom: 30px;
    }

    .botto-text {
        color: #ffffff;
        font-size: 14px;
        margin: auto;
    }

    .login-form .btn.btn-primary.reset {
        background: #ff9900 none repeat scroll 0 0;
    }

    .back {
        text-align: left;
        margin-top: 10px;
    }

    .back a {
        color: #444444;
        font-size: 13px;
        text-decoration: none;
    }
    .danger{
        color: red;
    }
    .forgot>a{
        text-decoration: none
    }
    li{
        list-style: none;
    }
</style>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<html>

<head>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>

<body id="LoginForm">
    <div class="container">
        <h1 class="form-heading">E-Commerce</h1>
        <div class="login-form">
            <div class="main-div">
                <div class="panel">
                    {{-- @if ($errors->any())
                    <ul>
                        {!! implode('', $errors->all('<li class="danger">:message</li>')) !!}
                    </ul>
                    @endif --}}
                    <h2>Sign Up!</h2>
                </div>
                <form id="Login" action="/store" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputName" placeholder="Username"name="username">
                            @if ($errors->has('username'))
                        <li class="danger">{{$errors->first('username')}}</li>
                            @endif
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email Address"
                            name="email">
                    @if ($errors->has('email'))
                    <li class="danger">{{$errors->first('email')}}</li>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password"
                            name="password">
                    @if ($errors->has('password'))
                    <li class="danger">{{$errors->first('password')}}</li>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="inputC_Password" placeholder="Confirm Password"
                            name="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                    <li class="danger my-9">{{$errors->first('password_confirmation')}}</li>
                        @endif
                    </div>
                    <div class="forgot">
                        <a href="{{ url('/login') }}">Already have a account?</a>

                    </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>

                </form>
            </div>
            <p class="botto-text"> Designed by Laravel</p>
        </div>
    </div>
    </div>


</body>

</html>
