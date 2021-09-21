<!DOCTYPE html>
<html>
    <head>
        <title>Add user</title>
    </head>
    <body>
        <form class="account-form" method="POST" action="/admin/users/create">
            @csrf
            <input type="text" placeholder="name" name="name">
            @error('name'){{$message}}@enderror
            <input type="text" placeholder="email" name="email">
            @error('email'){{$message}}@enderror
            <input type="password" placeholder="password" name="password">
            @error('password'){{$message}}@enderror
            <select name="role">
                <option value="admin">Admin</option>
                <option value="client">Client</option>
            </select>
            <button type="submit">Add</button>
        </form>
    </body>
</html>
