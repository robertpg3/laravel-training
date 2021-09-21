<!DOCTYPE html>
<html>
<head>
    <title>Recover password</title>
</head>
    <body>
        <form class="account-form" method="POST" action="/reset-password-action">
            @csrf
            <input type="password" placeholder="new password" name="newPassword">
            <button type="submit">Update password</button>
        </form>
    </body>
</html>
