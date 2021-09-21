<!DOCTYPE html>
<html>
    <head>
        <title>Add product</title>
    </head>
    <body>
        <form action="/admin/products/create" method="POST" class="form-container">
            @csrf
            <input type="text" placeholder="name" name="name">
            @error('name'){{$message}}@enderror
            <textarea name="description">Description...</textarea>
            @error('description'){{$message}}@enderror
            <input name="price" type="number" placeholder="price" min="0" step="0.5">
            @error('price'){{$message}}@enderror
            <input name="units" type="number" placeholder="units" min="0" step="1">
            @error('units'){{$message}}@enderror
            <select name="category">
                <option value="" selected disabled hidden>Select category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category'){{$message}}@enderror
            <button type="submit">Add</button>
        </form>
    </body>
</html>
