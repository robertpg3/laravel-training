<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="{{asset('/css/additional-css.css')}}">

        <title>Login</title>
    </head>
    <body class="login-body">
        <div class="form-container">
            <form class="account-form" id="login-form" method="POST" action="/login">
                @csrf
                <input type="text" placeholder="email" name="email">
                <input type="password" placeholder="password" name="password">
            </form>
            <div class="buttons-container">
                <button type="submit" form="login-form">Login</button>
                <button onclick="window.location.href='/register'">Register</button>
                <button onclick="window.location.href='/forgot-password'">Forgot password</button>
                <button onclick="window.location.href='/change-password'">Reset password</button>
            </div>
        </div>
    </body>
</html>
