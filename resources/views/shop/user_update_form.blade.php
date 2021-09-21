<!DOCTYPE html>
<html>
<head>
    <title>Edit user</title>
</head>
<body>
<form class="account-form" method="POST" action="/admin/users/edit">
    @csrf
    {{ method_field('PUT') }}

    <input type="text" placeholder="name" name="name" value="{{ $user->name }}">
    @error('name'){{$message}}@enderror
    <input type="text" placeholder="email" name="email" value="{{ $user->email }}">
    @error('email'){{$message}}@enderror
    <button type="submit">Update</button>
</form>
</body>
</html>
