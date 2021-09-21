<!DOCTYPE html>
<html>
<head>
    <title>Edit product</title>
</head>
<body>
<form action="/admin/categories/edit/{{ $category->id }}" method="POST" class="form-container">
    @csrf
    {{ method_field('PUT') }}

    <input type="text" placeholder="name" name="name" value="{{ $category->name }}">
    @error('name'){{$message}}@enderror
    <textarea name="briefing">{{ $category->briefing }}</textarea>
    @error('briefing'){{$message}}@enderror
    <button type="submit">Update</button>
</form>
</body>
</html>
