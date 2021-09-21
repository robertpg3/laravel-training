<!DOCTYPE html>
<html>
    <head>
        <title>Add category</title>
    </head>
    <body>
        <form action="/admin/categories/create" method="POST" class="form-container">
            @csrf
            <input type="text" placeholder="name" name="name">
            @error('name'){{$message}}@enderror
            <textarea name="briefing">Description...</textarea>
            @error('briefing'){{$message}}@enderror
            <button type="submit">Add</button>
        </form>
    </body>
</html>
