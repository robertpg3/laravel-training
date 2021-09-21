<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <form class="account-form" method="POST" action="/register">
        @csrf
        <input type="text" placeholder="name" name="name">
        <input type="text" placeholder="email" name="email">
        <input type="password" placeholder="password" name="password">
        <select name="role">
            <option value="admin">Admin</option>
            <option value="client">Client</option>
        </select>
        <button type="submit">Register</button>
    </form>
</body>
</html>
