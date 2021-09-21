<!DOCTYPE html>
<html>
    <head>
        <title>Forgot password</title>
    </head>
    <body>
        <form class="account-form" method="POST" action="/forgot-password">
            @csrf
            <input type="text" placeholder="email" name="email">
            <button type="submit">Recover password</button>
        </form>
    </body>
</html>
