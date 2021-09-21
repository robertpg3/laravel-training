<!DOCTYPE html>
<html>
    <head>
        <title>Reset password</title>
    </head>
    <body>
        <form class="account-form" method="POST" action="/change-password">
            @csrf
            <input type="text" placeholder="email" name="email">
            <input type="text" placeholder="old password" name="password">
            <input type="text" placeholder="new password" name="newPassword">
            <button type="submit">Recover password</button>
        </form>
    </body>
</html>
